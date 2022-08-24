<template>
  <div class="imageContainer">
  </div>
</template>

<script>
import DefaultInput from "../atoms/DefaultInput.vue";
import DefaultButton from "../atoms/DefaultButton.vue";
import DangerButton from "../atoms/DangerButton.vue";

export default {
  name: "FormRightLoginMolecule",
  components: {
    DefaultInput,
    DefaultButton,
    DangerButton
  }
};
</script>

<style lang="scss" scoped>
.imageContainer {
  background-image: url('/images/caixas.png');
  min-height: 190px;
}
</style>
