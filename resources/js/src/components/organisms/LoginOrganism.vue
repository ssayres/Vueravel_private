<template>
  <!-- A lógica representante nesse documento HTML designa que a cada doze colunas utilizadas teremos uma linha. -->
  <div class="row row-cols-12 g-0 login-organim-container marginclasse">
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
  components: {
    FormLeftLoginMolecule,
    FormRightLoginMolecule
  }
};
</script>

<style lang="scss" scoped>
.row {
  filter: drop-shadow(2px 2px 5.5px rgba(44, 44, 44, 0.5));
}

.col-6 {
  background-color: white;
}

.login-organim-container {
  background-color: #e98b00;

  border-radius: 10px;

  padding-bottom: 20px;
}

.marginclasse {
  margin-top: 100px;
}
</style>
