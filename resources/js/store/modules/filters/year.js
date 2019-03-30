const state = {
  years: [],
  selectedYear: '',
}

const getters = {
  years: state => {
    return state.years;
  },
  selectedYear: state => {
    return state.selectedYear;
  },
}

const mutations = {
  updateYears: (state, payload) => {
    state.years = payload;
  },
  selectYear: (state, payload) => {
    state.selectedYear = payload;
  },
}

const actions = {
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
  selectYear: (context, payload) => {
    context.commit('selectYear', payload);
    context.dispatch('fetchEngines');
  },
}

export default {
  state,
  getters,
  mutations,
  actions
}
