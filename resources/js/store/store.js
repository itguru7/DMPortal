import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import vendor   from './modules/vendor';
import make     from './modules/filters/make';
import model    from './modules/filters/model';
import year     from './modules/filters/year';
import engine   from './modules/filters/engine';

export const store = new Vuex.Store({
  modules: {
    vendor,
    make,
    model,
    year,
    engine
  }
});
