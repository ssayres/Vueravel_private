<template>
  <div class="imageContainer">
    <img src="/images/004via.png" alt="">
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


.imageContainer img {
  width: 100%;
  height: 100%;
}
</style>
