const state = {
  subdomainID: 0,
  subdomain: '',

  activePage: null,
  activePartPage: null,

  visibleApplicationsTable: false,
  visiblePartsTable: false,
  visibleInterchangesTable: false,

  partNumber: '',

  selectedPartID: null,
  selectedPartNumber: '',

  xRef: '',
}

const getters = {
}

const mutations = {
  updateSubdomain: (state, payload) => {
    state.subdomain = payload;
  },
  updateSubdomainID: (state, payload) => {
    state.subdomainID = payload;
  },

  updateActivePage: (state, payload) => {
    state.activePage = payload;
  },
  updateActivePartPage: (state, payload) => {
    state.activePartPage = payload;
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

  updateSelectedPart: (state, payload) => {
    if (payload) {
      state.selectedPartNumber = payload.partNumber;
      state.selectedPartID = payload.partID;
    } else {
      state.selectedPartID = null;
      state.selectedPartNumber = '';
    }
  },
}

const actions = {
  fetchSubdomainID: (context) => {
    var url = SERVER_URL + '/fetchSubdomainID';
    var formData = {
      'Vendor': context.state.subdomain,
    }
    axios.post(url, formData)
      .then(res  => {
        context.commit('updateSubdomainID', res.data['data']);
      })
  },

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
  updateSelectedPart: (context, payload) => {
    context.commit('updateSelectedPart', null);
    setTimeout(function() {
      context.commit('updateSelectedPart', payload);
    }, 100);
    context.commit('updateActivePartPage', 0);
  },
}

export default {
  state,
  getters,
  mutations,
  actions
}
