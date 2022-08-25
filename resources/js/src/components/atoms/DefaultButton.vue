<template>
  <div>
    <button class="btn btn-primary" :type="type" v-bind="$attrs">
      {{ text }}
    </button>
  </div>
</template>

<script>
export default {
  name: "DefaultButton",

  props: {
    text: {
      type: String,
      required: false,
      default: () => "DefaultButtonText"
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
  margin: 1.25rem 0 0.20 0;
  box-shadow: 1px 1px 5px rgba(100, 100, 100, 0.295);
}

.btn-primary {
  color: white;
  background-color: color("via", "base");
  border-color: #ff730091;
}

.btn-primary:hover {
  background-color: #ff7300;
  border-color: #ff7300ad;
  color: white;
}

.btn-primary:focus,
.btn-primary:active {
  background-color: #ff831e !important;
  border-color: #ff730091;

  outline: 0px !important;
  box-shadow: 0 0 5px #f8801d !important;
}
</style>
