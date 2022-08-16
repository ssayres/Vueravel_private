import { createRouter, createWebHashHistory } from "vue-router";

const routes = [
  {
    path: "/",
    name: "form",
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/FormView.vue")
  }
];

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

export default router;
