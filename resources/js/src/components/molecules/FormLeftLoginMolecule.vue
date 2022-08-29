<template>
  <form class="form-container" action="/api/auth/login" method="post">
    <div class="row row-cols-12">
      <!-- Linha -->
      <div class="col-12">
        <DefaultInput
          type="email"
          label="Email"
          id="email"
          name="email"
          formText=""
          formTextId=""
          invalidFeedback=""
        />
      </div>

      <!-- Linha -->
      <div class="col-12">
        <DefaultInput type="password" name="password" label="Senha" id="password" />
      </div>
      <div class="butao col-6">
        <DefaultButton label="Submit" type="submit" id="inputSubmit" text="Entrar" @click="batata"/>
      </div>
    </div>
  </form>
</template>

<script>
import DefaultInput from "../atoms/DefaultInput.vue";
import DefaultButton from "../atoms/DefaultButton.vue";
import DangerButton from "../atoms/DangerButton.vue";

export default {
  name: "FormLeftLoginMolecule",
  components: {
    DefaultInput,
    DefaultButton,
    DangerButton
  },
  methods: {
    batata() {
      console.log("batata")
    }
  }
};
</script>

<style lang="scss" scoped>
form {
  h1 {
    font-family: "Lora", sans-serif !important;
    font-size: 2.375rem;
    line-height: 1.25rem;
    text-align: left;
    margin-bottom: 2.1875rem;

    color: rgb(44, 44, 44);
  }

  h2 {
    font-family: "Lora", sans-serif !important;
    line-height: 0.9375rem;
    font-size: 1.375rem;
    text-align: left;
    font-style: italic;

    color: rgb(61, 61, 61);
  }

  p {
    margin-top: 1.5625rem;
    font-family: "Merriweather", serif;
    font-size: 0.875rem;
    line-height: 1.3125rem;

    color: black;
    text-align: left;
  }

  display: grid;
  grid-template-rows: 98% 2%;

  padding: 1.25rem;
  // border: 0.0625rem solid whitesmoke;
  background-color: white;

  position: relative;
}

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
.butao {
  
  margin-left: 5.75em;
  margin-top: 20px;
  
  

  
  
  
}
</style>
