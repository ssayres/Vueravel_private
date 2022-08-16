<template>
  <div class="col-12 buttons">
    <button
      type="button"
      class="btn btn-primary forms-btn buttons"
      :class="{ focused: $isOnPrincipalPage }"
      @click="displayPrincipalPage"
    >
      Remetente/Destinatário
    </button>
    <button
      type="button"
      id="content-btn"
      class="btn btn-primary buttons"
      :class="{ focused: $isOnContentPage }"
      @click="displayContentPage"
    >
      Conteúdo
    </button>
  </div>
</template>

<script>
import { useToast, POSITION } from "vue-toastification";

export default {
  name: "ButtonHeaderMolecule",
  setup() {
    const toast = useToast();

    return { toast };
  },
  computed: {
    $isFilledAllForms() {
      if (Object.keys(this.$store.getters.$sender).length > 0) {
        if (Object.keys(this.$store.getters.$reciver).length > 0) {
          return true;
        }
      }

      return false;
    },
    $isOnPrincipalPage() {
      return this.$store.getters.$principalPage;
    },
    $isOnContentPage() {
      return this.$store.getters.$contentPage;
    },
    $savedSenderForm() {
      return this.$store.getters.$stateSwitchSender;
    },
    $savedReciverForm() {
      return this.$store.getters.$stateSwitchReciver;
    }
  },
  methods: {
    displayPrincipalPage() {
      this.$store.dispatch("displayPrincipalPage");
      this.clearFormIfNotSaved();
    },
    displayContentPage() {
      if (!this.$isFilledAllForms) {
        const toastJSX = (
          <div>
            <h5>Formulário não preenchido</h5>
            <span>
              Você deve preencher ambos formulários antes de prosseguir para
              adição de conteúdo. Verifique se você deixou de{" "}
              <strong>preencher</strong> algum campo{" "}
              <strong>obrigatório</strong> e tente novamente.
            </span>
          </div>
        );

        this.toast.error(toastJSX, {
          timeout: 10000,
          position: POSITION.TOP_RIGHT
        });

        return false;
      }

      this.$store.dispatch("displayContentPage");
    },
    clearFormIfNotSaved() {
      if (!this.$savedSenderForm) {
        this.$externalMethods.call("FormLeftMolecule/resetForm()");
      }

      if (!this.$savedReciverForm) {
        this.$externalMethods.call("FormRightMolecule/resetForm()");
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.buttons {
  button {
    float: left;
    background-color: #ffffff;
    color: black;
    border: 0;
  }

  button:hover {
    background-color: #eb9700;
    color: white;
  }

  button:active,
  button:focus {
    outline: none !important;
    box-shadow: none !important;
  }

  button:active {
    background-color: #ff7b00 !important;
    filter: drop-shadow(2px 1px 3px rgba(41, 41, 41, 0.5));
  }

  .focused {
    color: rgba(255, 255, 255, 0.815);
    background-color: #eb9700;
  }

  right: 0.9375rem;
  top: 25px;
}
</style>
