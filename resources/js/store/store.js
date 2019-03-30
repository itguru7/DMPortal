import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import global   from './modules/global';
import filters  from './modules/filters';

export const store = new Vuex.Store({
  modules: {
    global,
    filters,
  }
});
