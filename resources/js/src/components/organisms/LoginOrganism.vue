<template>
  <!-- A lógica representante nesse documento HTML designa que a cada doze colunas utilizadas teremos uma linha. -->
  <div class="row row-cols-12">
    <!-- Essas duas divs representam uma linha pois estamos somando seis colunas com outras seis, totalizando doze. -->
    <div class="col-6">
      <FormLeftLoginMolecule />
    </div>
    <div class="col-6">
      <FormRightLoginMolecule />
    </div>
  </div>
</template>

<script>
import FormLeftLoginMolecule from "../molecules/FormLeftLoginMolecule.vue";
import FormRightLoginMolecule from "../molecules/FormRightLoginMolecule.vue";

export default {
  name: "LoginOrganism",
  components: [FormLeftLoginMolecule, FormRightLoginMolecule]
};
</script>

<style lang="scss" scoped></style>
