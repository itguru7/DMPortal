const state = {
  activePage: null,
  activePartPage: null,

  visibleApplicationsTable: false,
  visiblePartsTable: false,
  visibleInterchangesTable: false,

  partNumber: '',
  selectedPartNumber: null,
  xRef: '',
}

const getters = {
}

const mutations = {
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

  updateSelectedPartNumber: (state, payload) => {
    state.selectedPartNumber = payload;
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
  updateSelectedPartNumber: (context, payload) => {
    context.commit('updateSelectedPartNumber', null);
    setTimeout(function() {
      context.commit('updateSelectedPartNumber', payload);
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
