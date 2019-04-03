const state = {
  makes: [],
  models: [],
  years: [],
  engines: [],

  selectedMake: null,
  selectedModel: null,
  selectedYear: null,
  selectedEngine: null,
}

const getters = {
}

const mutations = {
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
  fetchMakes: (context) => {
    var url = SERVER_URL + '/fetchFilters';
    var formData = {
      'input': {
        'Subdomain_ID': context.rootState.global.subdomainID
      },
      'output': ['Make']
    }
    axios.post(url, formData)
      .then(res  => {
        context.commit('updateMakes', res.data['data']['Make']);
      })
  },
  fetchModels: (context) => {
    var url = SERVER_URL + '/fetchFilters';
    var formData = {
      'input': {
        'Subdomain_ID': context.rootState.global.subdomainID,
        'Make': context.state.selectedMake
      },
      'output': ['Model']
    }
    axios.post(url, formData)
      .then(res  => {
        context.commit('updateModels', res.data['data']['Model']);
      })
  },
  fetchYears: (context) => {
    var url = SERVER_URL + '/fetchFilters';
    var formData = {
      'input': {
        'Subdomain_ID': context.rootState.global.subdomainID,
        'Make': context.state.selectedMake,
        'Model': context.state.selectedModel
      },
      'output': ['Year']
    }
    axios.post(url, formData)
      .then(res  => {
        context.commit('updateYears', res.data['data']['Year']);
      })
  },
  fetchEngines: (context) => {
    var url = SERVER_URL + '/fetchFilters';
    var formData = {
      'input': {
        'Subdomain_ID': context.rootState.global.subdomainID,
        'Make': context.state.selectedMake,
        'Model': context.state.selectedModel,
        'Year': context.state.selectedYear
      },
      'output': ['Engine_Info']
    }
    axios.post(url, formData)
      .then(res  => {
        context.commit('updateEngines', res.data['data']['Engine_Info']);
      })
  },
}

export default {
  state,
  getters,
  mutations,
  actions
}
