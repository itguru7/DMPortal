import Vue from 'vue';
import Vuex from 'vuex';

import * as getters from './getters';
import * as mutations from './mutations';
import * as actions from './actions';

Vue.use(Vuex);

export const store = new Vuex.Store({
  state: {
    vendor: '',
    years: [],
    year: '',
    makes: [],
    make: '',
    models: [],
    model: '',
    products: [],
    product: '',
    engines: [],
    engine: '',
  },
  getters: {
    vendor: state => {
      return state.vendor;
    }
  },
  mutations: {
    setVendor: (state, payload) => {
      state.vendor = payload;
    },
    setMakes: (state, payload) => {
      state.makes = payload;
    }
  },
  actions: {
    setVendor: ({commit}, vendor) => {
      commit('setVendor', vendor);
    },
    fetchMakes: ({commit}) => {
      var url = SERVER_URL + '/fetchFilters';
      var formData = {
        'input': {},
        'output': ['Make']
      }
      axios.post(url, formData)
        .then(res  => {
          commit('setMakes', res.data);
        })
    }
  },
  modules: {
  }
});
