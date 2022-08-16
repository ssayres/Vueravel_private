import { createApp } from "vue";
import App from "./src/App.vue";
import router from "./src/router";
import store from "./src/store";
import VueTheMask from "vue-the-mask";

import Toast, { POSITION } from "vue-toastification";
import "vue-toastification/dist/index.css";

require("./bootstrap");

createApp(App)
  .use(VueTheMask)
  .use(Toast, {
    position: POSITION.TOP_LEFT
  })
  .use(store)
  .use(router)
  .use({
    methods: {},
    install(app) {
      app.config.globalProperties.$externalMethods = {
        set: (method, func) => (this.methods[method] = func),
        call: (method, ...args) => this.methods[method](...args)
      };
    }
  })
  .mount("#app");
