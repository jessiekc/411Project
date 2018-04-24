url = 'https://www.tripadvisor.com/Attractions-g255060-Activities-Sydney_New_South_Wales.html#FILTERED_LIST'

from bs4 import BeautifulSoup
import requests
from requests.exceptions import ConnectionError
import json



payload = {'key1': 'value1', 'key2': ['value2', 'value3']}
r = requests.get('http://httpbin.org/get', params=payload)
r.encoding = 'ISO-8859-1'

HEADERS = {'user-agent': ('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5)'
                          'AppleWebKit/537.36 (KHTML, like Gecko)'
                          'Chrome/45.0.2454.101 Safari/537.36'),
                          'referer': 'http://stats.nba.com/scores/'}



try:
    wd_data = requests.get(url,headers = HEADERS)
except ConnectionError:
    time.sleep(1)
    wd_data = requests.get(url,headers = HEADERS)
        
wd_data.encoding = 'ISO-8859-1'
soup = BeautifulSoup(wd_data.text,"lxml")
page_list = soup.find_all("div", {"class":"pageNumbers"})
for page in page_list:
    page = page.find_all("a")
total_page_number = int(page[-1].get('data-page-number'))
titles = soup.select("div.listing_title > a[target='_blank']")
imgs = soup.select('img[width="180"]')
cates = soup.select('div.p13n_reasoning_v2')
ratings = soup.find_all("div", {"class":"rs rating"})
types = soup.find_all("div", {"class":"p13n_reasoning_v2"})

# for item in types:
#     print(item.span.text)
attraction_rating_list = []

for title,rating in zip(titles,ratings):
    data = {
        'tourist_attraction':title.get_text(),
#         'img':img.get('src'), 
        'rating':rating.span["alt"]

    }
    attraction_rating_list.append(data)
# print(url)



urls = []
for page_number in range(total_page_number-1):
    urls.append('https://www.tripadvisor.com/Attractions-g255060-Activities-oa'+str(page_number*30 + 30)+'-Sydney_New_South_Wales.html#FILTERED_LIST')
for url in urls:
    try:
        wd_data = requests.get(url,headers = HEADERS)
    except ConnectionError:
        time.sleep(1)
        wd_data = requests.get(url,headers = HEADERS)
        
    wd_data.encoding = 'ISO-8859-1'
    soup = BeautifulSoup(wd_data.text,"lxml")
    
    titles = soup.select("div.listing_title > a[target='_blank']")
#     imgs = soup.select('img[width="180"]')
    cates = soup.select('div.p13n_reasoning_v2')
    ratings = soup.find_all("div", {"class":"rs rating"})
#     types = soup.find_all("div", {"class":"p13n_reasoning_v2"})
    
#     for element in soup.find_all("div", {"class":"rs rating"}):
#     print(element.span["alt"])

    
    for title,rating in zip(titles,ratings):
        data = {
            'tourist_attraction':title.get_text(), 
#             'img':img.get('src'), 
            'rating':rating.span["alt"]
#             'type':item.span.text
        }
        attraction_rating_list.append(data)
        
        
        
tourist_attraction_list1 = []
rating_list = []
for i in attraction_rating_list:
    tourist_attraction_list1.append(i['tourist_attraction'])
    rating_list.append(i['rating'])
rating_list_df = pd.DataFrame(rating_list,columns =['ratings'])




from bs4 import BeautifulSoup
import requests
from requests.exceptions import ConnectionError
import pandas as pd



payload = {'key1': 'value1', 'key2': ['value2', 'value3']}
r = requests.get('http://httpbin.org/get', params=payload)
r.encoding = 'ISO-8859-1'

HEADERS = {'user-agent': ('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5)'
                          'AppleWebKit/537.36 (KHTML, like Gecko)'
                          'Chrome/45.0.2454.101 Safari/537.36'),
                          'referer': 'http://stats.nba.com/scores/'}



try:
    wd_data = requests.get(url,headers = HEADERS)
except ConnectionError:
    time.sleep(1)
    wd_data = requests.get(url,headers = HEADERS)
        
wd_data.encoding = 'ISO-8859-1'
soup = BeautifulSoup(wd_data.text,"lxml")
page_list = soup.find_all("div", {"class":"pageNumbers"})
for page in page_list:
    page = page.find_all("a")
total_page_number = int(page[-1].get('data-page-number'))
titles = soup.select("div.listing_title > a[target='_blank']")
imgs = soup.select('img[width="180"]')
cates = soup.select('div.p13n_reasoning_v2')
ratings = soup.find_all("div", {"class":"rs rating"})
types = soup.find_all("div", {"class":"p13n_reasoning_v2"})

# for item in types:
#     print(item.span.text)
attraction_type_list = []

for title,typ in zip(titles,types):
    try:
        t = typ.span.text
    except:
        t = None
    data = {
        'tourist_attraction':title.get_text(),
#         'img':img.get('src'), 
        'type':t


    }
    attraction_type_list.append(data)
# print(url)



urls = []
for page_number in range(total_page_number-1):
    urls.append('https://www.tripadvisor.com/Attractions-g255060-Activities-oa'+str(page_number*30 + 30)+'-Sydney_New_South_Wales.html#FILTERED_LIST')
for url in urls:
    try:
        wd_data = requests.get(url,headers = HEADERS)
    except ConnectionError:
        time.sleep(1)
        wd_data = requests.get(url,headers = HEADERS)
        
    wd_data.encoding = 'ISO-8859-1'
    soup = BeautifulSoup(wd_data.text,"lxml")
    
    titles = soup.select("div.listing_title > a[target='_blank']")
    cates = soup.select('div.p13n_reasoning_v2')
    ratings = soup.find_all("div", {"class":"rs rating"})
    types = soup.find_all("div", {"class":"p13n_reasoning_v2"})

    for title,typ in zip(titles,types):
        try:
            t = typ.span.text
        except:
            t = None
        
        
        data = {
            'tourist_attraction':title.get_text(), 
#             'img':img.get('src'), 
#             'rating':rating.span["alt"]
            'type':t

        }
        attraction_type_list.append(data)




tourist_attraction_list2 = []
type_list = []
for i in attraction_type_list:
    tourist_attraction_list2.append(i['tourist_attraction'])
    type_list.append(i['type'])
    
tourist_attraction_list_df = pd.DataFrame(tourist_attraction_list2, columns =['tourist_attraction'])
type_list_df = pd.DataFrame(type_list, columns =['types'])




temp = pd.concat([tourist_attraction_list_df, rating_list_df, type_list_df], axis=1) 
# new = pd.concat([temp,type_list_df], axis=1)
temp.to_csv("Sydney.csv", index=False)