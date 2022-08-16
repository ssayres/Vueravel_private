<template>
  <div class="row row-cols-12 g-0">
    <div class="col-6 form-left">
      <ContentLeftMolecule />
    </div>
    <div class="col-6 form-right">
      <ContentRightMolecule />
    </div>
  </div>
</template>

<script>
import ContentLeftMolecule from "../molecules/ContentLeftMolecule.vue";
import ContentRightMolecule from "../molecules/ContentRightMolecule.vue";

export default {
  name: "ContentOrganism",
  components: {
    ContentLeftMolecule,
    ContentRightMolecule
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
