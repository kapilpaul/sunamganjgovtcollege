import Vue from "vue";
import Vuex from "vuex";
import {
  commonStore
} from "./modules/common";

Vue.use(Vuex);

export const store = new Vuex.Store({
  state: {
    elements: []
  },
  getters: {
    elements: state => {
      return state.elements;
    }
  },
  mutations: {
    setElements: (state, payload) => {
      if (typeof payload.data !== "undefined") {
        state.elements = payload.data;
      } else {
        state.elements.push(payload);
      }
    }
  },
  actions: {
    setElements: ({
      commit
    }, payload) => {
      commit("setElements", payload);
    }
  },
  modules: {
    commonStore
  }
});