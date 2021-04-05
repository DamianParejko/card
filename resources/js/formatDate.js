import Vue from 'vue';
import Moment from 'moment';

Vue.filter("shortDate", function (value) {
    return Moment(value).format("YYYY-MM-DD, HH:mm");
  });
