const state = {
  models: [],
  selectedModel: '',
}

const getters = {
  models: state => {
    return state.models;
  },
  selectedModel: state => {
    return state.selectedModel;
  },
}

const mutations = {
  updateModels: (state, payload) => {
    state.models = payload;
  },
  selectModel: (state, payload) => {
    state.selectedModel = payload;
  },
}

const actions = {
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
  selectModel: (context, payload) => {
    context.commit('selectModel', payload);
    context.dispatch('fetchYears');
    context.commit('updateEngines', []);
  },
}

export default {
  state,
  getters,
  mutations,
  actions
}
