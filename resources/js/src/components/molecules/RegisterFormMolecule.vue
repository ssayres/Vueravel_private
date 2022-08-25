<template>
  <form class="form-container" @submit.prevent="">
    <div class="row row-cols-12">
      <!-- Linha de cabeçalho do formulário -->
      <div class="col-12">
        <h2>Formulário</h2>
        <h1>Cadastro</h1>
      </div>

      <!-- Linha -->
      <div class="col-6">
        <DefaultInput
          type="text"
          label="Nome"
          id="inputNomeUsuario"
          formText="Não se esqueça de inserir o seu nome acima."
          formTextId="inputNomeUsuarioFormText"
          invalidFeedback="Você se "
          v-model="user.name"
        />
      </div>

      <!-- Linha -->
      <div class="col-6">
        <DefaultInput
          type="text"
          label="CPF"
          id="inputDocumentoUsuario"
          formTextId="Você deve inserir o número do seu CPF acima."
          invalidFeedback="Você se esqueceu de inserir o número do CPF, o campo está vazio ou é inválido."
          v-model="user.document"
        />
      </div>

      <!-- Linha -->
      <div class="col-12">
        <DefaultInput
          type="email"
          label="Email"
          id="inputEmailUsuario"
          formTextId="Não se esqueça de inserir o email no campo acima."
          invalidFeedback="Você não inseriu um email válido ou então se esqueceu de preencher o campo."
          v-model="user.email"
        />
      </div>

      <!-- Linha -->
      <div class="col-6">
        <DefaultInput
          type="password"
          label="Senha"
          id="inputPasswordUsuario"
          formTextId="Preencha o campo acima com a sua senha, se lembre de anota-la."
          invalidFeedback="Você não inseriu uma senha válida ou então se esqueceu de preencher o campo."
          v-model="user.password"
        />
      </div>
      <div class="col-6">
        <DefaultInput
          type="password"
          label="Confirmação de Senha"
          id="inputPasswordConfirmUsuario"
          formTextId="Confirme o seu password aqui, ele deve ser igual ao inserido no campo anterior."
          invalidFeedback="As senhas não são iguais ou então se esqueceu de preencher o campo."
        />
      </div>
      <!-- Fim da Linha -->

      <!-- Linha -->
      <div class="col-12">
        <DefaultButton class="col-6" />
        <DangerButton class="col-6" />
      </div>
    </div>
  </form>
</template>

<script>
import DefaultInput from "../atoms/DefaultInput.vue";
import DefaultButton from "../atoms/DefaultButton.vue";
import DangerButton from "../atoms/DangerButton.vue";
import { useToast, POSITION } from "vue-toastification";

export default {
  name: "RegisterForm",
  components: {
    DefaultInput,
    DefaultButton,
    DangerButton
  },
  setup() {
    const toast = useToast();

    return { toast };
  },
  data() {
    return {
      user: {
        name: "",
        document: "",
        email: "",
        password: ""
      }
    };
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

  padding: 1.25rem;
  border: 0.0625rem solid whitesmoke;
  background-color: white;

  border-top-left-radius: 0.3125rem;
  border-bottom-left-radius: 0.3125rem;
}
</style>
