<template>
  <div class="row row-cols-12 g-0">
    <div class="col-6 form-left">
      <FormLeftMolecule />
    </div>
    <div class="col-6 form-right">
      <FormRightMolecule />
    </div>
  </div>
</template>

<script>
import FormLeftMolecule from "../molecules/FormLeftMolecule.vue";
import FormRightMolecule from "../molecules/FormRightMolecule.vue";

export default {
  name: "FormOrganism",
  components: {
    FormLeftMolecule,
    FormRightMolecule
  }
};
</script>

<style lang="scss" scoped>
.row {
  filter: drop-shadow(2px 2px 5.5px rgba(44, 44, 44, 0.5));
}

.form-left,
.form-right {
  background-color: orange;
  padding-bottom: 20px;
}

.form-left {
  border-radius: 10px;
  border-bottom-right-radius: 0;
}

.form-right {
  border-radius: 10px;
  border-bottom-left-radius: 0;
}
</style>
