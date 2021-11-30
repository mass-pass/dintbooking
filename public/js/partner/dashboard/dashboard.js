/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/partner/dashboard/dashboard.js":
/*!*****************************************************!*\
  !*** ./resources/js/partner/dashboard/dashboard.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var dashboardController = new Vue({
  el: '#dashboardController',
  data: {
    currentPropertyId: current_property_id,
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
        total_revenue: []
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
  mounted: function mounted() {
    this.setReservationData();
    this.setActivityData();
    this.setFourtenDateData();
  },
  methods: {
    printWindow: function printWindow() {
      $("header").addClass("d-none");
      window.print();
      setTimeout(function () {
        $("header").removeClass("d-none");
      }, 1000);
    },
    reservationTabChange: function reservationTabChange(index) {
      if (this.reservation.activeTab != index) {
        this.reservation.activeTab = index;
        this.setReservationData();
      }
    },
    getReservationTabData: function getReservationTabData() {
      data = {
        tab: this.reservation.activeTab,
        currentPropertyId: this.currentPropertyId
      };
      return axios.post('/partner/properties-reservation', data);
    },
    setReservationData: function setReservationData() {
      this.reservation.showLoader = true;
      var self = this;
      this.getReservationTabData().then(function (res) {
        self.reservation.data = res.data.data;
        self.reservation.showLoader = false;
      });
    },
    activityTabChange: function activityTabChange(index) {
      if (this.activity.activeTab != index) {
        this.activity.activeTab = index;
        this.setActivityData();
      }
    },
    getActivityData: function getActivityData() {
      data = {
        tab: this.activity.activeTab,
        currentPropertyId: this.currentPropertyId
      };
      return axios.post('/partner/properties-today-activity', data);
    },
    setActivityData: function setActivityData() {
      this.activity.showLoader = true;
      var self = this;
      this.getActivityData().then(function (res) {
        self.activity.data = res.data.data;
        self.activity.showLoader = false;
      });
    },
    getFourtenDateData: function getFourtenDateData(next) {
      data = {
        rooms: rooms,
        ids: properties_ids,
        selected_date: this.fourtenDate.selectedDate,
        next: next,
        currentPropertyId: this.currentPropertyId
      };
      return axios.post('/partner/properties-calendar-days', data);
    },
    setFourtenDateData: function setFourtenDateData(next) {
      this.fourtenDate.showLoader = true;

      if (next == 1) {
        this.fourtenDate.selectedDate = this.fourtenDate.data && this.fourtenDate.data.end_date ? this.fourtenDate.data.end_date : this.fourtenDate.selectedDate;
      } else {
        this.fourtenDate.selectedDate = this.fourtenDate.data && this.fourtenDate.data.start_date ? this.fourtenDate.data.start_date : this.fourtenDate.selectedDate;
      }

      var self = this;
      this.getFourtenDateData(next).then(function (res) {
        self.fourtenDate.data = res.data.data;
        self.fourtenDate.showLoader = false;
      });
    }
  }
});

/***/ }),

/***/ 4:
/*!***********************************************************!*\
  !*** multi ./resources/js/partner/dashboard/dashboard.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/xampp/xamppfiles/htdocs/dint/resources/js/partner/dashboard/dashboard.js */"./resources/js/partner/dashboard/dashboard.js");


/***/ })

/******/ });