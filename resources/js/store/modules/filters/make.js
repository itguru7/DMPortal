const state = {
  makes: [],
  selectedMake: '',
}

const getters = {
  makes: state => {
    return state.makes;
  },
  selectedMake: state => {
    return state.selectedMake;
  },
}

const mutations = {
  updateMakes: (state, payload) => {
    state.makes = payload;
  },
  selectMake: (state, payload) => {
    state.selectedMake = payload;
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
        // context.commit('selectMake', '');
      })
  },
  selectMake: (context, payload) => {
    context.commit('selectMake', payload);
    context.dispatch('fetchModels');
    context.commit('updateYears', []);
    context.commit('updateEngines', []);
  },
}

export default {
  state,
  getters,
  mutations,
  actions
}
