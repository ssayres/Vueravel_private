<template>
  <div>
    <label :for="id" class="form-label">{{ label }}</label>
    <input
      :type="type"
      :name="id"
      :id="id"
      class="form-control"
      :class="[classAppend]"
      :required="required"
      :value="modelValue"
      @input="(event) => $emit('update:modelValue', event.target.value)"
      @change="onChange"
      @focusout="elementVerify"
      :disabled="disabled"
    />

    <div
      :v-if="formText"
      :id="formTextId"
      class="form-text default-form-text"
      :class="[classAppend]"
    >
      <!-- {{ formText }} -->
    </div>
    <div class="invalid-feedback">
      <!-- {{ invalidFeedback }} -->
    </div>
  </div>
</template>

<script>
export default {
  name: "DefaultInput",

  props: {
    id: {
      type: String,
      required: true
    },
    modelValue: {
      type: String,
      default: "",
      required: false
    },
    label: {
      type: String,
      required: true
    },
    type: {
      type: String,
      default: "text",
      required: false
    },
    required: {
      type: Boolean,
      required: false,
      default: false
    },
    invalidFeedback: {
      type: String,
      required: false
    },
    formText: {
      type: String,
      required: false
    },
    formTextId: {
      type: String,
      required: false
    },
    disabled: {
      type: Boolean,
      required: false,
      default: false
    },
    classAppend: {
      type: String,
      required: false,
      default: ""
    }
  },
  methods: {
    onInput(event) {
      this.$emit("update:inputValue", event.target.value);
    },
    onChange(event) {
      this.$emit("change", event.target.value);
    },
    elementVerify(e) {
      const element = e.target;
      const formText = document.getElementById(this.formTextId);

      if (this.classAppend) {
        element.className = `form-control ${this.classAppend}`;
      } else {
        element.className = `form-control`;
      }

      if (this.invalidFeedback) {
        if (element.value.length >= 1) {
          formText.style.display = "block";
          element.classList.add("is-valid");
        } else {
          formText.style.display = "none";
          element.classList.add("is-invalid");
        }
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.form-control:active,
.form-control:focus {
  outline: none;
  box-shadow: none !important;
}

.form-control:focus {
  border: 1px solid #e97b00;
  box-shadow: 0 0 4px #e97b00 !important;
}

.form-text {
  color: gray;
  font-size: 0.75rem;
}
</style>
