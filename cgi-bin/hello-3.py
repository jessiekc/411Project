#! /usr/bin/python
# #coding=utf-8
import sys
from bs4 import BeautifulSoup
import requests
from requests.exceptions import ConnectionError
import re
import json


def main_func(original_city, target_city, date):
    year = date.split('-')[0]
    month = date.split('-')[1]
    day = int(date.split('-')[2])
    
    payload = {'key1': 'value1', 'key2': ['value2', 'value3']}
    r = requests.get('http://httpbin.org/get', params=payload)
    r.encoding = 'ISO-8859-1'

    HEADERS = {'user-agent': ('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5)'
                              'AppleWebKit/537.36 (KHTML, like Gecko)'
                              'Chrome/45.0.2454.101 Safari/537.36'),
                              'referer': 'http://stats.nba.com/scores/'}
    list_of_list = []
    best_list = []
    date_list = []
    for i in range(-5,6):
        url = "https://www.expedia.com/Flights-Search?trip=oneway&leg1=from%3A{0}%2Cto%3A{1}%2Cdeparture%3A{2}%2F{3}%2F{4}TANYT&passengers=adults%3A1%2Cchildren%3A0%2Cseniors%3A0%2Cinfantinlap%3AY&options=cabinclass%3Aeconomy&mode=search&origref=www.expedia.com".format(original_city, target_city, month, day + i, year)
        date_temp = str(year)+'-'+str(month)+'-'+str(day+i)
        date_list.append(date_temp)
        try:
            r = requests.get(url,headers = HEADERS)
        except ConnectionError:
            time.sleep(1)
            r = requests.get(url,headers = HEADERS)
                
        soup = BeautifulSoup(r.content, "html.parser")
    
        departure_lis = []
        arrival_lis = []
        prices_lis = []
        airline_lis = []
        stop_lis = []
    
        departure_data = soup.find_all("span", attrs= {"data-test-id": "departure-time"})
        arrival_data = soup.find_all("span", attrs= {"data-test-id": "arrival-time"})
        prices_data = soup.find_all("span", attrs= {"class":"full-bold no-wrap"})
        airline_div = soup.find_all("div", attrs= {"class": "secondary-content overflow-ellipsis inline-children"})
        stop_div = soup.find_all("div", attrs= {"class":"uitk-col tablet-col-1-2 desktop-col-1-2 all-col-fill"})
    
        for i in departure_data:
            departure_lis.append(i.text)   
    
        for i in arrival_data:
            arrival_lis.append(i.text)
            
        for i in prices_data:
            prices_lis.append(i.text)
                
        for i in airline_div:
            airline_lis.append(i.text.lstrip().rstrip())
            
        for i in stop_div:
            stop_lis.append(i.find("span").text.lstrip().rstrip())
    
        # print(departure_lis)
        # print(arrival_lis)
        # print(prices_lis)
        # print(airline_lis)
        # print(stop_lis)
        attraction_rating_list = []
        flag = 1
        for d_time,a_time, p, a, s in zip(departure_lis, arrival_lis, prices_lis, airline_lis, stop_lis):
            aaaaa = {
                'departure_time' : d_time,
                'arrival_time': a_time,
                'price' : int(p[1:]),
                'airline' : a,
                'stop' : s
            }
            if(flag):
                best_list.append(aaaaa)
                flag = 0;
            
            attraction_rating_list.append(aaaaa)
        list_of_list.append(attraction_rating_list);
        
    # with open('woriQQQ.json') as data_file:
    #     data = json.load(data_file)
    
    # for element in data:
    #     del element
    
    

    with open('tickets_info.json', 'w') as f:
        json.dump(best_list, f)
    with open('xinwenjian.json', 'w') as f:
        json.dump(list_of_list, f)
    with open('date.json', 'w') as f:
        json.dump(date_list, f)
# if __name__ == "__main__":
main_func(sys.argv[1], sys.argv[2], sys.argv[3])





# import json

# data = {"name": "Jane", "age": 17}

# with open('friends.json', 'w') as f:
    
#     json.dump(data, f)