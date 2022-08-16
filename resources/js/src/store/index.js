import { createStore } from "vuex";

const reciver = {
  state: {
    reciver: {}
  },
  getters: {
    $reciver(state) {
      return state.reciver;
    }
  },
  mutations: {
    SET_RECIVER(state, payload) {
      state.reciver = payload;
      localStorage.setItem("reciver", JSON.stringify(state.reciver));
    },
    RESET_RECIVER(state) {
      state.reciver = {};
      localStorage.setItem("reciver", JSON.stringify({}));
    }
  },
  actions: {
    setReciver({ commit }, payload) {
      commit("SET_RECIVER", payload);
    },
    loadReciver({ commit }) {
      if (localStorage.getItem("reciver") !== null) {
        commit(
          "SET_RECIVER",
          JSON.parse(localStorage.getItem("reciver") || "{}")
        );
      }
    },
    resetReciver({ commit }) {
      return commit("RESET_RECIVER");
    }
  }
};

const sender = {
  state: {
    sender: {}
  },
  getters: {
    $sender(state) {
      return state.sender;
    }
  },
  mutations: {
    SET_SENDER(state, payload) {
      state.sender = payload;
      localStorage.setItem("sender", JSON.stringify(state.sender));
    },
    RESET_SENDER(state) {
      state.sender = {};
      localStorage.setItem("sender", JSON.stringify({}));
    }
  },
  actions: {
    setSender({ commit }, payload) {
      commit("SET_SENDER", payload);
    },
    loadSender({ commit }) {
      if (localStorage.getItem("sender") !== null) {
        commit("SET_SENDER", JSON.parse(localStorage.getItem("sender") || {}));
      }
    },
    resetSender({ commit }) {
      commit("RESET_SENDER");
    }
  }
};

const product = {
  state: {
    products: []
  },
  getters: {
    $products(state) {
      return state.products;
    }
  },
  mutations: {
    ADD_PRODUCT(state, payload) {
      state.products.push(payload);
      localStorage.setItem("products", JSON.stringify(state.products));
    },
    REMOVE_PRODUCT(state, payload) {
      let updatedProducts = state.products.filter(
        (element) => element.name != payload.name
      );

      state.products = updatedProducts;
      localStorage.setItem("products", JSON.stringify(state.products));
    },
    RESET_PRODUCTS(state) {
      state.products = [];

      localStorage.setItem("products", JSON.stringify(state.products));
    },
    SET_PRODUCTS(state, payload) {
      state.products = payload;
      localStorage.setItem("products", JSON.stringify(state.products));
    }
  },
  actions: {
    addProduct({ commit }, payload) {
      commit("ADD_PRODUCT", payload);
    },
    removeProduct({ commit }, payload) {
      commit("REMOVE_PRODUCT", payload);
    },
    resetProducts({ commit }) {
      commit("RESET_PRODUCTS");
    },
    loadProducts({ commit }) {
      if (localStorage.getItem("products") !== null) {
        commit(
          "SET_PRODUCTS",
          JSON.parse(localStorage.getItem("products") || {})
        );
      }
    }
  }
};

const paginate = {
  state: {
    principalPage: true,
    contentPage: false
  },
  getters: {
    $contentPage(state) {
      return state.contentPage;
    },
    $principalPage(state) {
      return state.principalPage;
    }
  },
  mutations: {
    DISPLAY_CONTENT_PAGE(state) {
      state.principalPage = false;
      state.contentPage = true;
    },
    DISPLAY_PRINCIPAL_PAGE(state) {
      state.principalPage = true;
      state.contentPage = false;
    }
  },
  actions: {
    displayContentPage({ commit }) {
      commit("DISPLAY_CONTENT_PAGE");
    },
    displayPrincipalPage({ commit }) {
      commit("DISPLAY_PRINCIPAL_PAGE");
    }
  }
};

const saveFormButton = {
  state: {
    switchSender: false,
    switchReciver: false
  },
  getters: {
    $stateSwitchSender(state) {
      return state.switchSender;
    },
    $stateSwitchReciver(state) {
      return state.switchReciver;
    }
  },
  mutations: {
    ALTER_SWITCH_SENDER(state) {
      state.switchSender = !state.switchSender;
      localStorage.setItem("switchSender", state.switchSender);
    },
    ALTER_SWITCH_RECIVER(state) {
      state.switchReciver = !state.switchReciver;
      localStorage.setItem("switchReciver", state.switchSender);
    },
    LOAD_SWITCH_SENDER_STATE(state, payload) {
      state.switchSender = payload;

      localStorage.setItem("switchSender", JSON.stringify(state.switchSender));
    },
    LOAD_SWITCH_RECIVER_STATE(state, payload) {
      state.switchReciver = payload;

      localStorage.setItem(
        "switchReciver",
        JSON.stringify(state.switchReciver)
      );
    }
  },
  actions: {
    alterSwitchSender({ commit }) {
      commit("ALTER_SWITCH_SENDER");
    },
    alterSwitchReciver({ commit }) {
      commit("ALTER_SWITCH_RECIVER");
    },
    loadSwitchSenderState({ commit }) {
      if (localStorage.getItem("switchSender") !== null) {
        commit(
          "LOAD_SWITCH_SENDER_STATE",
          JSON.parse(localStorage.getItem("switchSender") || {})
        );
      }
    },
    loadSwitchReciverState({ commit }) {
      if (localStorage.getItem("switchReciver") !== null) {
        commit(
          "LOAD_SWITCH_RECIVER_STATE",
          JSON.parse(localStorage.getItem("switchReciver") || {})
        );
      }
    }
  }
};

const store = createStore({
  modules: {
    reciver,
    sender,
    product,
    paginate,
    saveFormButton
  }
});

export default store;
