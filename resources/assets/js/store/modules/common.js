export const commonStore = {
  state: {
    validationErrors: [],
    submitted: false,
    items: [],
    page: 1,
    pageCount: 2,
    token: null,
    psid: "",
    bulkSelected: []
  },
  getters: {
    validationErrors: state => {
      return state.validationErrors;
    },
    submitted: state => {
      return state.submitted;
    },
    items: state => {
      return state.items;
    },
    page: state => {
      return state.page;
    },
    pageCount: state => {
      return state.pageCount;
    },
    psid: state => {
      return state.psid;
    },
    bulkSelected: state => {
      return state.bulkSelected;
    }
  },
  mutations: {
    setValidationErrors: (state, payload) => {
      state.validationErrors = payload;
    },
    setSubmitted: (state, payload) => {
      state.submitted = payload;
    },
    setItems: (state, payload) => {
      state.items = payload;
    },
    setPage: (state, payload) => {
      state.page = payload;
    },
    setPageCount: (state, payload) => {
      state.pageCount = payload;
    },
    setToken: state => {
      var token = localStorage.getItem("token");
      var expiration = localStorage.getItem("expiration");

      if (!token || !expiration) return null;

      if (Date.now() > parseInt(expiration)) {
        this.destroyToken();
      } else {
        state.token = token;
      }
    },
    destroyToken() {
      localStorage.removeItem("token");
      localStorage.removeItem("expiration");
      state.token = null;
    },
    setPSID(state, payload) {
      state.psid = payload;
    },
    setBulkSelected(state, payload) {
      if (payload.deselectAll) {
        Vue.set(state, "bulkSelected", []);
      } else {
        state.bulkSelected.push(payload);
      }
    },
    removeFromBulkSelected(state, payload) {
      let index = state.bulkSelected.indexOf(payload);

      state.bulkSelected.splice(index, 1);
    }
  },
  actions: {
    setValidationErrors: ({ commit }, payload) => {
      commit("setValidationErrors", payload);
    },
    setSubmitted: ({ commit }, payload) => {
      commit("setSubmitted", payload);
    },
    setItems: ({ commit }, payload) => {
      axios.get(payload.url, Vue.auth.getHeader()).then(response => {
        commit("setItems", response.data);
      });
    },
    setPage: ({ commit }, payload) => {
      commit("setPage", payload);
    },
    setPageCount: ({ commit }, payload) => {
      commit("setPageCount", payload);
    },
    SET_PSID: ({ commit }, payload) => {
      commit("setPSID", payload);
    },
    SET_BULK_SELECTED: ({ commit }, payload) => {
      if (payload.checked) {
        commit("setBulkSelected", payload.index);
      } else if (payload.deselectAll) {
        commit("setBulkSelected", { deselectAll: payload.deselectAll });
      } else {
        commit("removeFromBulkSelected", payload.index);
      }
    }
  }
};
