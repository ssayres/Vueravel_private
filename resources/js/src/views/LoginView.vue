<template>
  <!-- A div abaixo page container é a div principal da página, dentro dela é tudo rendenizado; -->
  <div class="page-container">
    <!-- A div com a classe row row-cols-12 é o sistema de GRID da nossa página;-->
    <div class="row rows-cols-12">
      <NavBarMolecule class="mb-4" />

      <div class="col-3"></div>
      <div class="col-6">
        <LoginOrganism />
      </div>
      <div class="col-3"></div>

    </div>
  </div>
</template>

<script>
import NavBarMolecule from "../components/molecules/NavBarMolecule.vue";
import LoginOrganism from "../components/organisms/LoginOrganism.vue";

export default {
  name: "LoginView",
  components: {
    NavBarMolecule,
    LoginOrganism
  }
};
</script>

<style lang="scss" scoped>
* {
  margin: 0;
  padding: 0;
}

body {
  width: 100%;
  height: 100%;
}

.page-container {
  position: absolute;
  min-height: 100vh;
  min-width: 100vw;
}
</style>
