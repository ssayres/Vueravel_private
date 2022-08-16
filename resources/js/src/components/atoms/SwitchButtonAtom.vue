<template>
  <div class="form-check form-switch">
    <input
      class="form-check-input"
      :name="id"
      :id="id"
      type="checkbox"
      role="switch"
      :checked="checked"
    />
    <label class="form-check-label" for="flexSwitchCheckDefault">{{
      text
    }}</label>
  </div>
</template>

<script>
export default {
  name: "SwitchButtonAtom",

  props: {
    id: {
      type: String,
      required: true
    },
    text: {
      type: String,
      required: false,
      default: () => "Default text for a switch button, change by props text;"
    },
    checked: {
      type: Boolean,
      required: false,
      default: () => false
    },
    classAppend: {
      type: String,
      required: false,
      default: () => ""
    }
  }
};
</script>

<style lang="scss" scoped></style>
