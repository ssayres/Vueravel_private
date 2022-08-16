<template>
  <div class="page-container">
    <div class="row rows-cols-12">
      
      <div class="col-2"></div>
      <div class="col-8">
        <ButtonHeaderMolecule />
      </div>
      <div class="col-2"></div>

      <div class="col-2"></div>
      <div v-if="$displayPrincipalPage" class="col-8">
        <FormOrganism />
      </div>

      <div v-if="$displayContentPage" class="col-8">
        <ContentOrganism />
      </div>
      <div class="col-2"></div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import FormOrganism from "../components/organisms/FormOrganism.vue";
import ContentOrganism from "../components/organisms/ContentOrganism.vue";
import ButtonHeaderMolecule from "../components/molecules/ButtonHeaderMolecule.vue";

export default {
  name: "HomeView",
  components: {
    FormOrganism,
    ContentOrganism,
    ButtonHeaderMolecule
  },
  computed: {
    $displayPrincipalPage() {
      return this.$store.getters.$principalPage;
    },
    $displayContentPage() {
      return this.$store.getters.$contentPage;
    }
  }
};
</script>

<style scoped>
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
