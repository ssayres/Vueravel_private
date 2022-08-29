<template>
  <!-- A lógica representante nesse documento HTML designa que a cada doze colunas utilizadas teremos uma linha. -->
  <div class="row row-cols-12 g-0 regis-organim-container marginclasse">

     <div class="forms col-6">
      <RegisterFormMolecule/>
  </div>
  
  </div>
</template>

<script>
import RegisterFormMolecule from "../molecules/RegisterFormMolecule.vue";

export default {
  name: "RegisterForm",
  components: {
    RegisterFormMolecule,
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

.regis-organim-container {
  background-color: #e98b00;

  border-radius: 10px;

  padding-bottom: 20px;

  width: 1px;
}

.marginclasse {
  margin-top: 100px;
}

.forms {
  width: 150vh;
  padding-bottom: 20px;
}
</style>