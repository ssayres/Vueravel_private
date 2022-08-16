<template>
  <div>
    <label :for="id" class="form-label">{{ label }}</label>
    <input
      type="money"
      :name="id"
      :id="id"
      class="form-control"
      :class="[classAppend]"
      :required="required"
      :value="modelValue"
      @input="(event) => $emit('update:modelValue', event.target.value)"
      @change="(event) => $emit('update:modelValue', event.target.value)"
      @focusout="elementVerify"
      @keyup="formatOnKeyUP"
      :disabled="disabled"
      :maxlength="maxlength"
    />
    <div
      :v-if="formText"
      :id="formTextId"
      class="form-text money-form-text"
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
  name: "MoneyInput",

  props: {
    id: {
      type: String,
      required: true
    },
    modelValue: {
      type: String,
      required: false
    },
    label: {
      type: String,
      required: true
    },
    required: {
      type: Boolean,
      required: false,
      default: false
    },
    invalidFeedback: {
      type: String,
      required: false,
      default: "Você se esqueceu de preencher."
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
    maxlength: {
      type: String,
      required: false
    },
    classAppend: {
      type: String,
      required: false,
      default: ""
    }
  },
  methods: {
    elementVerify(e) {
      const element = e.target;
      const formText = document.getElementsByClassName("money-form-text")[0];
      element.className = "form-control";

      if (element.value.length >= 1 && element.value != "R$ 0,00") {
        formText.style.display = "block";
        element.classList.add("is-valid");
      } else {
        formText.style.display = "none";
        element.classList.add("is-invalid");
      }
    },
    formatOnKeyUP(e) {
      let element = e.target;
      var value = element.value.replace(/\D/g, "");

      value = (value / 100).toFixed(2) + "";
      value = value.replace(".", ",");
      value = value.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
      value = value.replace(/(\d)(\d{3}),/g, "$1.$2,");

      element.value = "R$ " + value;

      value = element.value.split("R$ ");
      value = value[1].split(".");
      value[value.length - 1] = value[value.length - 1].split(",").join("");

      element = String(value);
      value = element.replace(/\D/g, "");

      value = (value / 100).toFixed(2) + "";
      value = value.replace(".", ",");
      value = value.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
      value = value.replace(/(\d)(\d{3}),/g, "$1.$2,");

      element = "R$ " + value;
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
