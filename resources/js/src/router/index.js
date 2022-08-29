import { createRouter, createWebHashHistory } from "vue-router";

const routes = [
  {
    path: "/",
    name: "form",
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/FormView.vue")
  },
  {
    path: "/login",
    name: "login",
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/LoginView.vue")
  },
  {
    path: "/cadastro",
    name: "cadastro",
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/RegisterView.vue")
  }
];

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

export default router;
