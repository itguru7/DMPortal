const state = {
  engines: [],
  selectedEngine: '',
}

const getters = {
  engines: state => {
    return state.engines;
  },
  selectedEngine: state => {
    return state.selectedEngine;
  }
}

const mutations = {
  updateEngines: (state, payload) => {
    state.engines = payload;
  },
  selectEngine: (state, payload) => {
    state.selectedEngine = payload;
  }
}

const actions = {
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
  selectEngine: (context, payload) => {
    context.commit('selectEngine', payload);
  }
}

export default {
  state,
  getters,
  mutations,
  actions
}
