<template>
  <form class="form-container form-reciver" @submit.prevent="submitForms">
    <div class="row row-cols-12">
      <div class="col-12 header">
        <a v-if="$isFilledAllForms" @click="displayContentPage">
          <i class="bi bi-arrow-up-right-circle-fill"></i>
        </a>
        <h2>Formulário</h2>
        <h1>Destinatário</h1>
      </div>

      <div class="col-6">
        <DefaultInput
          type="text"
          label="Nome"
          id="inputNomeDestinatario"
          formText="Insira o nome do destinatário no campo acima."
          formTextId="inputTextNomeDestinatario"
          invalidFeedback="Você se esqueceu de inserir o nome do remetente, preencha o campo."
          v-model="reciver.name"
          classAppend="reciver"
        />
      </div>

      <div class="col-6">
        <DefaultInput
          type="text"
          label="CPF/CNPJ"
          id="inputDocumentoDestinatario"
          formText="Insira o documento do destinatário no campo acima."
          formTextId="inputTextDocumentoDestinatario"
          invalidFeedback="Você se esqueceu de preencher o campo com o documento do destinatario."
          v-model="reciver.document"
          v-mask="['###.###.###-##', '##.###.###/####-##']"
          classAppend="reciver"
        />
      </div>

      <div class="col-12 mb-3">
        <label for="inputCepDestinatario" class="form-label">CEP</label>
        <input
          type="text"
          name="inputCepDestinatario"
          id="inputCepDestinatario"
          class="form-control"
          v-model="reciver.postalCode"
          @focusout="verifyReciverCep"
          maxlength="8"
        />

        <div
          id="inputTextCepDestinatario"
          class="form-text default-form-text"
        ></div>
        <div class="invalid-feedback"></div>
      </div>

      <div class="col-6">
        <DefaultInput
          type="text"
          label="Endereço"
          id="inputEnderecoDestinatario"
          formText="Preencha o campo de CEP do destinatário para que esse campo se preencha automaticamente."
          formTextId="inputTextEnderecoDestinatario"
          invalidFeedback="Você se esqueceu de preencher o cep do destinatario."
          v-model="reciver.address"
        />
      </div>

      <div class="col-3">
        <DefaultInput
          type="string"
          label="Número"
          id="inputNumeroDestinatario"
          formText="Insira o número do destinatário acima."
          formTextId="inputNumberNumeroDestinatario"
          invalidFeedback="Campo não preenchido."
          v-model="reciver.number"
          classAppend="reciver"
        />
      </div>

      <div class="col-3">
        <DefaultInput
          type="text"
          label="Complemento"
          id="inputComplementoDestinatario"
          formText="Insira o complemento do endereço caso possua."
          formTextId="inputTextComplementoRemetente"
          v-model="reciver.complement"
          classAppend="reciver"
        />
      </div>

      <div class="col-6">
        <DefaultInput
          type="text"
          label="Cidade"
          id="inputCidadeDestinatario"
          formText="Preencha o campo de CEP do destinatário para que esse campo se preencha automaticamente."
          formTextId="inputTextCityDestinatario"
          invalidFeedback="Você se esqueceu de preencher o campo com o CEP do destinatário."
          v-model="reciver.city"
        />
      </div>

      <div class="col-6">
        <DefaultInput
          type="text"
          label="Estado"
          id="inputEstadoDestinatario"
          formText="Preencha o campo de CEP do destinatário para que esse campo se preencha automaticamente."
          formTextId="inputTextStateDestinatario"
          invalidFeedback="Você se esqueceu de preencher o campo com o CEP do destinatário."
          v-model="reciver.state"
        />
      </div>

      <div class="col-12">
        <SwitchButton
          id="inputSwitchButtonDestinatario"
          text="Salvar formulário destinatário?"
          v-model="saveReciver"
          @click="this.$store.dispatch('alterSwitchReciver')"
          :checked="this.$store.getters.$stateSwitchReciver"
          :class="['my-4']"
        />
      </div>

      <div v-if="!$isFilledAllForms" class="col-6 button" style="height: 60px">
        <DefaultButton type="submit" text="Enviar Formulário" />
      </div>
      <div v-else class="col-6 button" style="height: 60px">
        <DangerButton
          text="Limpar Formulário"
          type="button"
          @click.stop="resetAllForms"
        />
      </div>

      <div v-if="!$isFilledAllForms" class="col-6 button" style="height: 60px">
        <DangerButton
          text="Limpar Formulário"
          type="button"
          @click.stop="resetAllForms"
        />
      </div>
      <div v-else class="col-6 button" style="height: 60px">
        <DefaultButton
          type="button"
          text="Adicionar Conteúdo"
          @click="displayContentPage"
        />
      </div>
    </div>
  </form>
</template>

<script>
import axios from "axios";
import SwitchButton from "../atoms/SwitchButtonAtom.vue";
import DefaultInput from "../atoms/DefaultInput.vue";
import DefaultButton from "../atoms/DefaultButton.vue";
import DangerButton from "../atoms/DangerButton.vue";
import FormLeftMolecule from "./FormLeftMolecule.vue";
import { useToast, POSITION } from "vue-toastification";

export default {
  name: "FormRightMolecule",
  components: {
    DefaultInput,
    DefaultButton,
    DangerButton,
    SwitchButton,
    FormLeftMolecule
  },
  setup() {
    const toast = useToast();

    return { toast };
  },
  mounted() {
    this.$store.dispatch("loadReciver");
    this.$store.dispatch("loadSwitchReciverState");
    this.$externalMethods.set("FormRightMolecule/resetForm()", this.resetForm);

    if (this.$reciverSetted) {
      this.reciver = this.$reciverSetted;
      this.disableFormFields();
    }
  },
  data() {
    return {
      reciver: {
        name: "",
        document: "",
        postalCode: "",
        address: "",
        complement: "",
        number: "",
        city: "",
        state: ""
      },
      saveReciver: this.$reciverSwitchButton,
      filledAddress: false
    };
  },
  computed: {
    $reciverSetted() {
      if (Object.keys(this.$store.getters.$reciver).length > 0) {
        return this.$store.getters.$reciver;
      }

      return false;
    },
    $isFilledAllForms() {
      if (Object.keys(this.$store.getters.$reciver).length > 0) {
        if (Object.keys(this.$store.getters.$sender).length > 0) {
          return true;
        }
      }

      return false;
    },
    $inputFormFieldIds() {
      const inputFieldsId = [
        "inputNomeDestinatario",
        "inputDocumentoDestinatario",
        "inputCepDestinatario",
        "inputNumeroDestinatario",
        "inputComplementoDestinatario",
        "inputEnderecoDestinatario",
        "inputCidadeDestinatario",
        "inputEstadoDestinatario"
      ];

      return inputFieldsId;
    },
    $addressFormFieldIds() {
      const inputFieldsId = [
        "inputEnderecoDestinatario",
        "inputCidadeDestinatario",
        "inputEstadoDestinatario"
      ];

      return inputFieldsId;
    },
    $reciverSwitchButton() {
      return this.$store.getters.$stateSwitchReciver;
    }
  },
  watch: {
    reciver: {
      handler(oldValue, newValue) {
        if (Object.keys(this.$store.getters.$reciver).length > 0) {
          return false;
        }

        if (newValue.postalCode.length == 8) {
          if (this.filledAdress) return false;

          (async () => {
            try {
              const request = await axios.get(
                `https://viacep.com.br/ws/${newValue.postalCode}/json/`
              );

              this.fillAddress(request.data);
              this.filledAdress = true;

              const addressField = document.getElementById(
                "inputEnderecoDestinatario"
              );
              const cityField = document.getElementById(
                "inputCidadeDestinatario"
              );
              const stateField = document.getElementById(
                "inputEstadoDestinatario"
              );

              addressField.className = "form-control";
              cityField.className = "form-control";
              stateField.className = "form-control";

              addressField.classList.add("is-valid");
              cityField.classList.add("is-valid");
              stateField.classList.add("is-valid");
            } catch (e) {
              console.error(e);
            }
          })();
        } else {
          this.resetAddress();

          for (let id of this.$addressFormFieldIds) {
            const field = document.getElementById(id);

            field.className = "form-control";
          }

          this.filledAdress = false;
        }
      },
      deep: true
    }
  },
  methods: {
    verifyReciverCep() {
      const element = document.getElementById("inputCepDestinatario");
      const formText = document.getElementById("inputTextCepDestinatario");
      element.className = "form-control";

      if (element.value.length >= 8) {
        formText.style.display = "block";
        element.classList.add("is-valid");
      } else {
        formText.style.display = "none";
        element.classList.add("is-invalid");
      }
    },
    fillAddress(response) {
      this.reciver.address = response.logradouro;
      this.reciver.city = response.localidade;
      this.reciver.state = response.uf;
    },
    resetBootstrapValidation() {
      for (let id of this.$inputFormFieldIds) {
        let field = document.getElementById(id);

        field.className = "form-control";
      }
    },
    resetAddress() {
      this.reciver.address = "";
      this.reciver.city = "";
      this.reciver.state = "";
    },
    resetForm() {
      this.reciver = {
        name: "",
        document: "",
        postalCode: "",
        address: "",
        complement: "",
        number: "",
        city: "",
        state: ""
      };

      this.$store.dispatch("resetReciver");
      this.resetBootstrapValidation();
      this.activeFormFields();
    },
    resetAllForms() {
      if (!confirm("Tem certeza que você deseja limpar os formulários?")) {
        return false;
      }

      this.reciver = {
        name: "",
        document: "",
        postalCode: "",
        address: "",
        complement: "",
        number: "",
        city: "",
        state: ""
      };

      const myJSX = (
        <div>
          <h5>Formulários Limpos</h5>
          <span>
            Sucesso! Você limpou ambos formulários. Lembre-se que a página de
            conteúdo só fica disponível caso você tenha preenchido{" "}
            <strong>ambos</strong> formulários.
          </span>
        </div>
      );

      this.toast.success(myJSX, {
        timeout: 5000,
        position: POSITION.TOP_RIGHT
      });

      this.$externalMethods.call("FormLeftMolecule/resetForm()");

      this.$store.dispatch("resetReciver");
      this.resetBootstrapValidation();
      this.activeFormFields();
    },
    activeFormFields() {
      for (let id of this.$inputFormFieldIds) {
        try {
          let field = document.getElementById(id);

          if (field != null) {
            field.disabled = false;
          }
        } catch (e) {
          console.error(e);
        }
      }
    },
    disableFormFields() {
      for (let id of this.$inputFormFieldIds) {
        let field = document.getElementById(id);

        field.disabled = true;
      }
    },
    submitForms() {
      this.$externalMethods.call("FormLeftMolecule/submitForm()");

      let arrayOfInvalidFields = [];
      const nameOfFields = {
        name: "Nome",
        document: "CPF/CNPJ",
        postalCode: "CEP",
        address: "Endereço",
        complement: "Complemento",
        number: "Número",
        city: "Cidade",
        state: "Estado"
      };

      // For each inside this.sender with key and value.
      Object.entries(this.reciver).forEach(([key, value]) => {
        if (key == "complement") return;

        if (value.length <= 0) {
          arrayOfInvalidFields.push(`${nameOfFields[key]}`);
        }
      });

      if (arrayOfInvalidFields.length > 0) {
        for (let field of this.$inputFormFieldIds) {
          let element = document.getElementById(field);

          if (!element.value) {
            element.classList.add("is-invalid");
          }
        }

        const toastJSX = (
          <div>
            <h5>Formulário Destinatário</h5>
            <span>
              Você se esqueceu de preencher um campo{" "}
              <strong>obrigatório</strong>. Ele foi marcado em vermelho,
              verifique as informações do formulário e tente novamente.
            </span>
          </div>
        );

        return this.toast.error(toastJSX, {
          position: POSITION.TOP_RIGHT,
          timeout: 7000
        });
      }

      this.$store.dispatch("setReciver", this.reciver);
      this.disableFormFields();
      this.displayContentPage();
    },
    displayContentPage() {
      return this.$store.dispatch("displayContentPage");
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
  border: 0.0625rem solid whitesmoke;
  background-color: white;

  border-top-right-radius: 0.3125rem;
  border-bottom-right-radius: 0.3125rem;

  position: relative;
}

.form-reciver {
  min-height: 564px;
}

// CSS of InputCEPField
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
// END OF CSS of InputCEPField

.bi-arrow-up-right-circle-fill {
  top: -15px;
  left: -20px;

  font-size: 2.5rem;
  line-height: 0;
  text-align: left;

  color: #e97b00;
  filter: drop-shadow(2px 1px 3px rgba(41, 41, 41, 0.5));

  position: absolute;
}

.bi-arrow-up-right-circle-fill:hover {
  color: rgb(250, 142, 19);
}
</style>
