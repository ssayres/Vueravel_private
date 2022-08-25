<template>
  <div class="imageContainer">
  </div>
</template>

<script>
import DangerButton from "../atoms/DangerButton.vue";
import DefaultInput from "../atoms/DefaultInput.vue";
import DefaultButton from "../atoms/DefaultButton.vue";

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
  min-height: 500px;
}
</style>
