<template>
  <div>
    <!-- <button class="btn btn-outline-danger" :type="type" v-on="$listeners"> -->
    <button class="btn btn-block btn-outline-danger" :type="type" v-bind="$attrs">
      {{ text }}
    </button>
  </div>
</template>

<script>
export default {
  name: "DangerButton",

  props: {
    text: {
      type: String,
      required: false,
      default: () => "DefaultTextDangerButton"
    },
    type: {
      type: String,
      required: false,
      default: () => "reset"
    }
  }
};
</script>

<style lang="scss" scoped>
.btn {
  width: 100%;
  margin-top: 1.25rem;
  box-shadow: 1px 1px 5px rgba(100, 100, 100, 0.295);
}

.btn-outline-danger:active,
.btn-outline-danger:focus {
  background-color: rgb(160, 0, 0);
  border: 1px solid rgb(150, 4, 4);

  outline: 0px !important;
  box-shadow: 0 0 5px color("via", "base") !important;
}
</style>
