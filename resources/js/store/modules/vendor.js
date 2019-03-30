const state = {
  vendor: '',
}

const getters = {
  vendor: state => {
    return state.vendor;
  },
}

const mutations = {
  updateVendor: (state, payload) => {
    state.vendor = payload;
  },
}

const actions = {
  updateVendor: (context, payload) => {
    context.commit('updateVendor', payload);
  },
}

export default {
  state,
  getters,
  mutations,
  actions
}
