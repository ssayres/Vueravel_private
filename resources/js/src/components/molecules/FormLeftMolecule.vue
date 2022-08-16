<template>
  <form class="form-container form-sender" @submit.prevent="">
    <div class="row row-cols-12">
      <div class="col-12">
        <h2>Formulário</h2>
        <h1>Remetente</h1>
      </div>

      <div class="col-6">
        <DefaultInput
          v-model="sender.name"
          type="text"
          label="Nome"
          id="inputNomeRemetente"
          formText="Insira o nome do remetente aqui."
          formTextId="inputTextNomeRemetente"
          invalidFeedback="Você se esqueceu de preencher o campo com o nome do remetente."
          classAppend="sender"
        />
      </div>

      <div class="col-6">
        <DefaultInput
          type="text"
          label="CPF/CNPJ"
          id="inputDocumentoRemetente"
          formText="Insira o documento do remetente no campo acima."
          formTextId="inputTextDocumentoRemetente"
          invalidFeedback="Você se esqueceu de preencher o campo com o documento do remetente."
          v-model="sender.document"
          v-mask="['###.###.###-##', '##.###.###/####-##']"
          classAppend="sender"
        />
      </div>

      <div class="col-12 mb-3">
        <label for="inputCepRemetente" class="form-label">CEP</label>
        <input
          type="text"
          name="inputCepRemetente"
          id="inputCepRemetente"
          class="form-control"
          v-model="sender.postalCode"
          @focusout="verifySenderCep"
          maxlength="8"
        />

        <div
          id="inputTextCepRemetente"
          class="form-text default-form-text"
        ></div>

        <div class="invalid-feedback"></div>
      </div>

      <div class="col-6">
        <DefaultInput
          type="text"
          label="Endereço"
          id="inputEnderecoRemetente"
          formText="Preencha o campo de CEP do remetente para que esse campo se preencha automaticamente."
          formTextId="inputTextEnderecoRemetente"
          invalidFeedback="Você se esqueceu de preencher o cep do remetente."
          v-model="sender.address"
          classAppend="sender"
        />
      </div>

      <div class="col-3">
        <DefaultInput
          type="text"
          label="Número"
          id="inputNumeroRemetente"
          formText="Insira o número do remetente acima."
          formTextId="inputNumberNumeroRemetente"
          invalidFeedback="Campo não preenchido."
          v-model="sender.number"
          classAppend="sender"
        />
      </div>

      <div class="col-3">
        <DefaultInput
          type="text"
          label="Complemento"
          id="inputComplementoRemetente"
          formText="Insira o complemento do endereço caso possua."
          formTextId="inputTextComplementoRemetente"
          v-model="sender.complement"
          classAppend="sender"
        />
      </div>

      <div class="col-6">
        <DefaultInput
          type="text"
          label="Cidade"
          id="inputCidadeRemetente"
          formText="Preencha o campo de CEP do remetente para que esse campo se preencha automaticamente."
          formTextId="inputTextCityRemetente"
          invalidFeedback="Você se esqueceu de preencher o campo com o CEP do remetente."
          v-model="sender.city"
          classAppend="sender"
        />
      </div>

      <div class="col-6">
        <DefaultInput
          type="text"
          label="Estado"
          id="inputEstadoRemetente"
          formText="Preencha o campo de CEP do destinatário para que esse campo se preencha automaticamente."
          formTextId="inputTextStateRemetente"
          invalidFeedback="Você se esqueceu de preencher o campo com o CEP do destinatário."
          v-model="sender.state"
        />
      </div>

      <div class="col-12">
        <SwitchButton
          id="inputSwitchButtonRemetente"
          text="Salvar formulário remetente?"
          v-model="saveSender"
          @click="this.$store.dispatch('alterSwitchSender')"
          :checked="this.$store.getters.$stateSwitchSender"
          :class="['my-4']"
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
import { useToast, POSITION } from "vue-toastification";

export default {
  name: "FormLeftMolecule",
  components: {
    DefaultInput,
    DefaultButton,
    SwitchButton
  },
  setup() {
    const toast = useToast();

    return { toast };
  },
  mounted() {
    this.$store.dispatch("loadSender");
    this.$store.dispatch("loadSwitchSenderState");

    this.$externalMethods.set("FormLeftMolecule/resetForm()", this.resetForm);
    this.$externalMethods.set("FormLeftMolecule/submitForm()", this.submitForm);

    if (this.$senderSetted) {
      this.sender = this.$senderSetted;
      this.disableFormFields();
    }
  },
  data() {
    return {
      sender: {
        name: "",
        document: "",
        postalCode: "",
        address: "",
        complement: "",
        number: "",
        city: "",
        state: ""
      },
      saveSender: this.$senderSwitchButton
    };
  },
  watch: {
    sender: {
      handler(oldValue, newValue) {
        if (Object.keys(this.$senderSetted).length > 0) {
          return false;
        }

        if (newValue.postalCode.length == 8) {
          (async () => {
            try {
              const request = await axios.get(
                `https://viacep.com.br/ws/${newValue.postalCode}/json/`
              );

              this.fillAddress(request.data);
              const fieldsToValidade = [
                "inputEnderecoRemetente",
                "inputCidadeRemetente",
                "inputEstadoRemetente"
              ];

              for (let fieldId of fieldsToValidade) {
                const field = document.getElementById(fieldId);

                field.classList.add("is-valid");
              }
            } catch (e) {
              console.log(e);
            }
          })();
        } else {
          this.resetAddress();
        }
      },
      deep: true
    }
  },
  computed: {
    $senderSetted() {
      if (Object.keys(this.$store.getters.$sender).length > 0) {
        return this.$store.getters.$sender;
      }

      return false;
    },
    $inputFormFieldIds() {
      const inputFieldsId = [
        "inputNomeRemetente",
        "inputDocumentoRemetente",
        "inputCepRemetente",
        "inputNumeroRemetente",
        "inputComplementoRemetente",
        "inputEnderecoRemetente",
        "inputCidadeRemetente",
        "inputEstadoRemetente"
      ];

      return inputFieldsId;
    },
    $senderSwitchButton() {
      return this.$store.getters.$stateSwitchSender;
    }
  },
  methods: {
    verifySenderCep() {
      const element = document.getElementById("inputCepRemetente");
      const formText = document.getElementById("inputTextCepRemetente");
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
      this.sender.address = response.logradouro;
      this.sender.city = response.localidade;
      this.sender.state = response.uf;
    },
    resetBootstrapValidation() {
      const inputFields = document.getElementsByClassName("form-control");

      Array.from(inputFields).forEach((el) => {
        el.className = "form-control";
      });
    },
    resetAddress() {
      this.sender.address = "";
      this.sender.city = "";
      this.sender.state = "";
    },
    resetForm() {
      this.sender = {
        name: "",
        document: "",
        postalCode: "",
        address: "",
        complement: "",
        number: "",
        city: "",
        state: ""
      };

      this.$store.dispatch("resetSender");
      this.resetBootstrapValidation();
      this.activeFormFields();
    },
    activeFormFields() {
      for (let id of this.$inputFormFieldIds) {
        let field = document.getElementById(id);

        field.disabled = false;
      }
    },
    disableFormFields() {
      for (let id of this.$inputFormFieldIds) {
        let field = document.getElementById(id);

        field.disabled = true;
      }
    },
    submitForm() {
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
      Object.entries(this.sender).forEach(([key, value]) => {
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
            <h5>Formulário Remetente</h5>
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

      this.disableFormFields();
      this.$store.dispatch("setSender", this.sender);
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

  padding: 1.25rem;
  border: 0.0625rem solid whitesmoke;
  background-color: white;

  border-top-left-radius: 0.3125rem;
  border-bottom-left-radius: 0.3125rem;
}

.form-sender {
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
</style>
