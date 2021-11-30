$(function() {
  $(".scrollable-table").mousewheel(function(event, delta) {
      this.scrollLeft -= (delta * 100);

      event.preventDefault();
  });

  document.getElementById('calendarBtn').onclick = function() {
      document.getElementById('datepicker').click();
  };
  
  $("body .collapse-all").click(function() {
      if ($(this).hasClass('collapsed')) {
          $(".dint_collapse").removeClass("collapsed");
          $(".main-collapse").removeClass("collapsed");
      } else {
          $(".dint_collapse").addClass("collapsed");
          $(".main-collapse").addClass("collapsed");
      }
      $(this).toggleClass("collapsed");
  });
  $(`body .main-collapse`).click(function() {
      $(`.dint-collapse-${$(this).data('pid')}`).toggleClass("collapsed");
      $(this).toggleClass("collapsed");
  });
});

function calenderSide() {
  $(".calendar-side-wrapper").addClass("open");
  $(".calendar-content-wrapper").addClass("open");
};

function calenderSideClose() {
  $(".calendar-side-wrapper").removeClass("open");
  $(".calendar-content-wrapper").removeClass("open");
};

$(function() {
  $("#datepicker").datepicker();
});

var calendarApp = new Vue({
  el: '#partner_calendar',
  data: {
      currentPropertyId: currentPropertyId,
      propertiesData: propertiesData,
      allRoomsData: allRoomsData,
      dates: dates,
      pricing: {},
      is_searched_room: {
          id: null,
          value: null
      }
  },
  mounted: function() {
      var inner = $('#inner_main_scrolltable_container');
      var elem = $('#main_scrolltable_container');
      elem.scroll(function() {
          if(elem.scrollLeft() + elem.width() >= (inner.width())) {
              calendarApp.addMonthToCalendar();
          }

          if (elem.scrollLeft() + elem.width() == elem.width()) {
              calendarApp.addPreMonthToCalendar();
          }
      });
      this.dateToMoment();
      this.fillReservationData();
  },
  methods: {
      searchRoom() {
          console.log('value');
          $(".dint_collapse").removeClass("collapsed");
          $(".main-collapse").removeClass("collapsed");
          $(".collapse-all").removeClass("collapsed");
          this.is_searched_room.id = this.is_searched_room.value;
          return false;
      },

      dateToMoment() {
          this.dates.startDate = moment(this.dates.startDate, 'YYYY-MM-DD');
          this.dates.endDate = moment(this.dates.endDate, 'YYYY-MM-DD');
      },

      getCalendarData() {
          data = {
              dates: {
                  'startDate' : this.dates.startDate.format('YYYY-MM-DD'),
                  'endDate' : this.dates.endDate.format('YYYY-MM-DD'),
              },
              property_id :this.currentPropertyId
          };

          return axios.post('/partner/calendar/get-calendar-data', data);
      },

      addPreMonthToCalendar(bypass) {
          this.dates.startDate = moment(this.dates.startDate).subtract(1, 'months').startOf('month');
          var promises = [];

          getCalendarData_promise = this.getCalendarData();

          promises.push(getCalendarData_promise);

          var self = this;

          Promise.all(promises).then(function(responses) {
              if (responses[0].data.data) {
                  self.propertiesData = responses[0].data.data.propertiesData;
                  self.allRoomsData = responses[0].data.data.allRoomsData;
                  self.dates = responses[0].data.data.dates;
                  self.dateToMoment();
                  self.fillReservationData();
              }
          });

      },

      addMonthToCalendar(bypass) {
          this.dates.endDate = moment(this.dates.endDate).add(1, 'months').endOf('month');
          var promises = [];

          getCalendarData_promise = this.getCalendarData();

          promises.push(getCalendarData_promise);

          var self = this;

          Promise.all(promises).then(function(responses) {
              if (responses[0].data.data) {
                  self.propertiesData = responses[0].data.data.propertiesData;
                  self.allRoomsData = responses[0].data.data.allRoomsData;
                  self.dates = responses[0].data.data.dates;
                  self.dateToMoment();
                  self.fillReservationData();
              }
          });
      },

      getReservations() {
        data = {
          dates: {
              'startDate' : this.dates.startDate.format('YYYY-MM-DD'),
              'endDate' : this.dates.endDate.format('YYYY-MM-DD'),
          },
          property_id :this.currentPropertyId
        };
        return axios.post('/partner/calendar/get-calendar-reservation-data', data);
      },

      fillReservationData() {
        this.reservationData = this.getReservations();
        console.log(this.reservationData);
      }
  }
})