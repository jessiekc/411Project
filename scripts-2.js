// // Make your own here: https://eternicode.github.io/bootstrap-datepicker

// var dateSelect     = $('#flight-datepicker');
// var dateDepart     = $('#start-date');
// var dateReturn     = $('#end-date');
// var spanDepart     = $('.date-depart');
// var spanReturn     = $('.date-return');
// var spanDateFormat = 'ddd, MMMM D yyyy';

// dateSelect.datepicker({
//   autoclose: true,
//   format: "mm/dd",
//   maxViewMode: 0,
//   startDate: "now"
// }).on('change', function() {
//   var start = $.format.date(dateDepart.datepicker('getDate'), spanDateFormat);
//   var end = $.format.date(dateReturn.datepicker('getDate'), spanDateFormat);
//   spanDepart.text(start);
//   spanReturn.text(end);
// });


$(document).ready(function() {

  var guestAmount = $('#guestNo');

  $('#cnt-up').click(function() {
    guestAmount.val(Math.min(parseInt($('#guestNo').val()) + 1, 20));
  });
  $('#cnt-down').click(function() {
    guestAmount.val(Math.max(parseInt($('#guestNo').val()) - 1, 1));
  });

  $('.btn').click(function() {

    var $btn = $('.btn');

    $btn.toggleClass('booked');
    $('.diamond').toggleClass('windup');
    $('form').slideToggle(300);
    $('.linkbox').toggle(200);

    if ($btn.text() === "BOOK NOW") {
      $btn.text("BOOKED!");
    } else {
      $btn.text("BOOK NOW");
    }
  });
});