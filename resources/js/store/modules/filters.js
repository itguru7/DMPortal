const state = {
  vendor: '',

  makes: [],
  models: [],
  years: [],
  engines: [],

  selectedMake: '',
  selectedModel: '',
  selectedYear: '',
  selectedEngine: '',
}

const getters = {
  vendor: state => {
    return state.vendor;
  },

  makes: state => {
    return state.makes;
  },
  models: state => {
    return state.models;
  },
  years: state => {
    return state.years;
  },
  engines: state => {
    return state.engines;
  },

  selectedMake: state => {
    return state.selectedMake;
  },
  selectedModel: state => {
    return state.selectedModel;
  },
  selectedYear: state => {
    return state.selectedYear;
  },
  selectedEngine: state => {
    return state.selectedEngine;
  },
}

const mutations = {
  updateVendor: (state, payload) => {
    state.vendor = payload;
  },

  updateMakes: (state, payload) => {
    state.makes = payload;
  },
  updateModels: (state, payload) => {
    state.models = payload;
  },
  updateYears: (state, payload) => {
    state.years = payload;
  },
  updateEngines: (state, payload) => {
    state.engines = payload;
  },

  selectMake: (state, payload) => {
    state.selectedMake = payload;
  },
  selectModel: (state, payload) => {
    state.selectedModel = payload;
  },
  selectYear: (state, payload) => {
    state.selectedYear = payload;
  },
  selectEngine: (state, payload) => {
    state.selectedEngine = payload;
  },
}

const actions = {
  updateVendor: (context, payload) => {
    context.commit('updateVendor', payload);
  },

  fetchMakes: (context) => {
    var url = SERVER_URL + '/fetchFilters';
    var formData = {
      'input': {
        // 'Vendor': context.state.vendor
      },
      'output': ['Make']
    }
    axios.post(url, formData)
      .then(res  => {
        context.commit('updateMakes', res.data['Make']);
        // context.commit('selectMake', '');
      })
  },
  fetchModels: (context) => {
    var url = SERVER_URL + '/fetchFilters';
    var formData = {
      'input': {
        // 'Vendor': context.state.vendor,
        'Make': context.state.selectedMake
      },
      'output': ['Model']
    }
    axios.post(url, formData)
      .then(res  => {
        context.commit('updateModels', res.data['Model']);
        // context.commit('selectModel', '');
      })
  },
  fetchYears: (context) => {
    var url = SERVER_URL + '/fetchFilters';
    var formData = {
      'input': {
        // 'Vendor': context.state.vendor,
        'Make': context.state.selectedMake,
        'Model': context.state.selectedModel
      },
      'output': ['Year']
    }
    axios.post(url, formData)
      .then(res  => {
        context.commit('updateYears', res.data['Year']);
        // context.commit('selectYear', '');
      })
  },
  fetchEngines: (context) => {
    var url = SERVER_URL + '/fetchFilters';
    var formData = {
      'input': {
        // 'Vendor': context.state.vendor,
        'Make': context.state.selectedMake,
        'Model': context.state.selectedModel,
        'Year': context.state.selectedYear
      },
      'output': ['Engine_Info']
    }
    axios.post(url, formData)
      .then(res  => {
        context.commit('updateEngines', res.data['Engine_Info']);
        // context.commit('selectEngine', '');
      })
  },

  selectMake: (context, payload) => {
    context.commit('selectMake', payload);
    context.dispatch('fetchModels');
    context.commit('updateYears', []);
    context.commit('updateEngines', []);
  },
  selectModel: (context, payload) => {
    context.commit('selectModel', payload);
    context.dispatch('fetchYears');
    context.commit('updateEngines', []);
  },
  selectYear: (context, payload) => {
    context.commit('selectYear', payload);
    context.dispatch('fetchEngines');
  },
  selectEngine: (context, payload) => {
    context.commit('selectEngine', payload);
  },
}

export default {
  state,
  getters,
  mutations,
  actions
}
