var dashboardController = new Vue({
  el: '#dashboardController',
  data: {
      currentPropertyId : current_property_id,
      reservation: {
          showLoader: true,
          activeTab: 1,
          data: {
              bookingsToday: [],
              bookingsTomorrow: [],
              guests: []
          }
      },
      activity: {
          showLoader: true,
          activeTab: 1,
          data: {
              bookings: [],
              today_booked: [],
              list: [],
              total_nights: [],
              total_revenue: [],
          }
      },
      fourtenDate: {
          showLoader: true,
          data: {
              selectedDate: moment().format('MMMM D,Y'),
              displayStartDate: '',
              end_date: '',
              totalPer: 0,
              bookings: []
          }
      }
  },
  mounted: function () {
      this.setReservationData();
      this.setActivityData();
      this.setFourtenDateData();
  },
  methods: {
      printWindow() {
          $("header").addClass("d-none");
              window.print();
              setTimeout(function(){
              $("header").removeClass("d-none");
          },1000)
      },

      reservationTabChange(index) {
          if (this.reservation.activeTab != index) {
              this.reservation.activeTab = index;
              this.setReservationData();
          }
      },

      getReservationTabData() {
          data = {
              tab: this.reservation.activeTab,
              currentPropertyId: this.currentPropertyId
          };

          return axios.post('/partner/properties-reservation', data);
      },

      setReservationData() {
          this.reservation.showLoader = true;
          var self = this;
          this.getReservationTabData().then(function(res) {
              self.reservation.data = res.data.data;
              self.reservation.showLoader = false;
          });
      },

      activityTabChange(index) {
          if (this.activity.activeTab != index) {
              this.activity.activeTab = index;
              this.setActivityData();
          }
      },

      getActivityData() {
          data = {
              tab: this.activity.activeTab,
              currentPropertyId: this.currentPropertyId
          };

          return axios.post('/partner/properties-today-activity', data);
      },

      setActivityData() {
          this.activity.showLoader = true;
          var self = this;
          this.getActivityData().then(function(res) {
              self.activity.data = res.data.data;
              self.activity.showLoader = false;
          });
      },

      getFourtenDateData(next) {
          data = {
              rooms: rooms,
              ids: properties_ids,
              selected_date: this.fourtenDate.selectedDate,
              next: next,
              currentPropertyId: this.currentPropertyId
          };

          return axios.post('/partner/properties-calendar-days', data);
      },

      setFourtenDateData(next) {
          this.fourtenDate.showLoader = true;
          if (next == 1) {
              this.fourtenDate.selectedDate = (this.fourtenDate.data && this.fourtenDate.data.end_date ) ? this.fourtenDate.data.end_date : this.fourtenDate.selectedDate;
          } else {
              this.fourtenDate.selectedDate = (this.fourtenDate.data && this.fourtenDate.data.start_date ) ? this.fourtenDate.data.start_date : this.fourtenDate.selectedDate;
          }
          var self = this;
          this.getFourtenDateData(next).then(function(res) {
              self.fourtenDate.data = res.data.data;
              self.fourtenDate.showLoader = false;
          });
      }

  }
})