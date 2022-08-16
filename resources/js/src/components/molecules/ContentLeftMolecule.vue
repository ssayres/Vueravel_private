<template>
  <form class="form-container" @submit.prevent="addContent">
    <div class="row row-cols-12">
      <div class="col-12">
        <DefaultInput
          type="text"
          label="Conteúdo do pacote"
          id="inputConteudoPacote"
          formText="Não se esqueça de adicionar a informação sobre o nome do pacote."
          formTextId="inputTextConteudoPacote"
          invalidFeedback="Você se esqueceu de preencher o campo com o conteúdo do pacote."
          v-model="content.name"
        />
      </div>

      <div class="col-12 my-3">
        <DefaultInput
          label="Quantidade de itens enviados"
          type="number"
          id="inputQuantidadePacote"
          formText="Adicione a quantidade de itens enviados."
          formTextId="inputTextQuantidadePacote"
          invalidFeedback="Você se esqueceu de preencher o campo com a quantidade do pacote."
          v-model="content.quantity"
        />
      </div>

      <div class="col-12">
        <MoneyInput
          label="Valor (R$)"
          id="inputValorPacote"
          formText="Campo referente ao valor total do pacote."
          formTextId="inputTextValorPacote"
          inalidFeedback="Você se esqueceu de preencher o campo com o valor do pacote."
          v-model="content.value"
        />
      </div>

      <div class="col-6 button">
        <DefaultButton type="submit" text="Adicionar Produto" />
      </div>

      <div class="col-6 button">
        <DangerButton
          text="Limpar Formulário"
          type="reset"
          @click="resetBootstrapValidation"
        />
      </div>
    </div>
  </form>
</template>

<script>
import { useToast, POSITION } from "vue-toastification";
import DefaultInput from "../atoms/DefaultInput.vue";
import MoneyInput from "../atoms/MoneyInput.vue";
import DefaultButton from "../atoms/DefaultButton.vue";
import DangerButton from "../atoms/DangerButton.vue";

export default {
  name: "ContentLeftMolecule",
  components: {
    DefaultInput,
    DefaultButton,
    DangerButton,
    MoneyInput
  },
  setup() {
    const toast = useToast();

    return { toast };
  },
  mounted() {
    if (this.$products.length >= 10) {
      this.disableFormFields();
    }
  },
  data() {
    return {
      content: {
        name: "",
        quantity: "",
        value: ""
      }
    };
  },
  computed: {
    $products() {
      return this.$store.getters.$products;
    },
    $inputFieldsIds() {
      const inputFieldsId = [
        "inputConteudoPacote",
        "inputQuantidadePacote",
        "inputValorPacote"
      ];

      return inputFieldsId;
    }
  },
  methods: {
    fieldsIsNotFilled() {
      let response = false;

      Object.entries(this.content).forEach(([key, value]) => {
        if (value.length <= 0) {
          response = true;
        }
      });

      return response;
    },
    addContent() {
      // If any field is not filled then return false;
      if (this.fieldsIsNotFilled()) {
        const myJSX = (
          <div>
            <h5>
              <strong>Campo não preenchido!</strong>
            </h5>
            <span>
              Um ou mais campos não foram preenchidos. Os campos não preenchidos
              foram marcados em <strong>vermelho</strong>. Verifique o
              formulário e tente novamente.
            </span>
          </div>
        );

        this.toast.error(myJSX, {
          timeout: 10000,
          position: POSITION.TOP_RIGHT
        });

        return false;
      }

      this.resetBootstrapValidation();
      this.$store.dispatch("addProduct", this.content);
      this.content = {
        name: "",
        quantity: "",
        value: ""
      };
    },
    resetBootstrapValidation() {
      const inputFields = document.getElementsByClassName("form-control");

      Array.from(inputFields).forEach((el) => {
        el.className = "form-control";
      });
    },
    disableFormFields() {
      for (let id of this.$inputFormFieldIds) {
        let field = document.getElementById(id);

        field.disabled = true;
      }
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

  height: 100%;

  padding: 1.25rem;
  border: 0.0625rem solid whitesmoke;
  background-color: white;

  border-top-left-radius: 0.3125rem;
  border-bottom-left-radius: 0.3125rem;
}
</style>
