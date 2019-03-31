const state = {
  vendor: '',

  makes: [],
  models: [],
  years: [],
  engines: [],

  selectedMake: null,
  selectedModel: null,
  selectedYear: null,
  selectedEngine: null,

  visiblePartsTable: false,
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

  visiblePartsTable: state => {
    return state.visiblePartsTable;
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

  updatePartsTableVisibility: (state, payload) => {
    state.visiblePartsTable = payload;
  },
}

const actions = {
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
      })
  },

  updatePartsTableVisibility: (context, payload) => {
    if (!payload) {
      context.commit('updatePartsTableVisibility', payload);
    } else {
      if (context.state.visiblePartsTable) {
        context.commit('updatePartsTableVisibility', false);
      }
      setTimeout(function() {
        context.commit('updatePartsTableVisibility', true);
      }, 100);
    }
  },
}

export default {
  state,
  getters,
  mutations,
  actions
}
