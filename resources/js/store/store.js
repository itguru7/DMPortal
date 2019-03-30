import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import filters from './modules/filters'

export const store = new Vuex.Store({
  state: {
    vendor: '',
  },
  getters: {
    vendor: state => {
      return state.vendor;
    },
  },
  mutations: {
    updateVendor: (state, payload) => {
      state.vendor = payload;
    },
  },
  actions: {
    updateVendor: (context, payload) => {
      context.commit('updateVendor', payload);
    },
  },
  modules: {
    filters
  }
});
