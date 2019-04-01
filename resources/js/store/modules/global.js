const state = {
  activePage: null,

  visibleApplicationsTable: false,
  visiblePartsTable: false,
  visibleInterchangesTable: false,

  partNumber: '',
  xRef: '',
}

const getters = {
}

const mutations = {
  updateActivePage: (state, payload) => {
    state.activePage = payload;
  },

  updatePartNumber: (state, payload) => {
    state.partNumber = payload;
  },
  updateXRef: (state, payload) => {
    state.xRef = payload;
  },

  updateApplicationsTableVisibility: (state, payload) => {
    state.visibleApplicationsTable = payload;
  },
  updatePartsTableVisibility: (state, payload) => {
    state.visiblePartsTable = payload;
  },
  updateInterchangesTableVisibility: (state, payload) => {
    state.visibleInterchangesTable = payload;
  },
}

const actions = {
  updateApplicationsTableVisibility: (context, payload) => {
    if (!payload) {
      context.commit('updateApplicationsTableVisibility', payload);
    } else {
      if (context.state.visibleApplicationsTable) {
        context.commit('updateApplicationsTableVisibility', false);
      }
      setTimeout(function() {
        context.commit('updateApplicationsTableVisibility', true);
      }, 100);
    }
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
  updateInterchangesTableVisibility: (context, payload) => {
    if (!payload) {
      context.commit('updateInterchangesTableVisibility', payload);
    } else {
      if (context.state.visibleInterchangesTable) {
        context.commit('updateInterchangesTableVisibility', false);
      }
      setTimeout(function() {
        context.commit('updateInterchangesTableVisibility', true);
      }, 100);
    }
  },
  fetchPart: (context, payload = null) => {
    if (!payload) {
      payload = context.state.partNumber
    }
    var url = SERVER_URL + '/fetchParts';
    var formData = {
      'filters': {
        // 'Vendor': context.rootState.filters.vendor,
        // 'Make': context.rootState.filters.selectedMake,
        // 'Model': context.rootState.filters.selectedModel,
        // 'Year': context.rootState.filters.selectedYear,
        // 'Engine_Info': context.rootState.filters.selectedEngine,
        'Part_Number': payload,
      },
      'limit': {
        'offset': (params.page_number - 1) * params.page_length,
        'count': params.page_length,
      }
    }
    axios.post(url, formData)
      .then(res  => {
      })
  }
}

export default {
  state,
  getters,
  mutations,
  actions
}
