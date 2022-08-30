<template>
  <div class="table-content">
    <div v-if="$products.length > 0" class="table-container">
      <table
        class="table table-hover table-bordered table-striped table-borderless"
      >
        <thead>
          <th scope="col">#</th>
          <th scope="col">IdProduto</th>
          <th scope="col">CentroCusto</th>
          <th scope="col">Conteúdo</th>
          <th scope="col">Qtd</th>
          <th scope="col">Valor</th>
          <th scope="col">#</th>
        </thead>
        <tbody>
          <tr v-for="(item, index) in $products" :key="index">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ item.IdProduct }}</td>
            <td>{{ item.CentroCusto }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.quantity }}</td>
            <td>{{ item.value }}</td>
            <td class="trash-icon" @click.stop="removeProduct(item)">
              <i class="bi bi-trash-fill"></i>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="row row-cols-12">
        <DefaultButton
          v-if="$products.length > 0"
          type="button"
          text="Gerar Declaração"
          @click.stop="createDocument"
          :class="['col-6']"
        />

        <DangerButton
          v-if="$products.length > 0"
          type="button"
          text="Limpar Declaração"
          @click.stop="this.$store.dispatch('resetProducts')"
          :class="['col-6']"
        />
      </div>
    </div>

    <!-- Pay attention on v-else. This will be renderized if the length of products in the bag is lower than zero. -->
    <div v-else class="hollow-array">
      <a @click="displayPrincipalPage">
        <i class="bi bi-arrow-down-left-circle-fill"></i>
      </a>
      <h1>Identificação</h1>
      <h2>Dos Bens</h2>
      <p>
        Nenhum bem foi identificado ainda. Se quiser você pode preencher os
        campos ao lado com as informações sobre seu(s) item(s). Não se esqueça
        de preencher todos os campos, ou seu item pode acabar não sendo inserido
        devidamente. Se você desejar excluir um item da sua lista basta colocar
        o mouse sobre o item e dar um simples click sob ele, ou clicando na
        lixeira ao lado do item.
      </p>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import DefaultInput from "../atoms/DefaultInput.vue";
import DefaultButton from "../atoms/DefaultButton.vue";
import DangerButton from "../atoms/DangerButton.vue";

export default {
  name: "ContentRightMolecule",
  components: {
    DefaultInput,
    DefaultButton,
    DangerButton
  },
  computed: {
    $products() {
      return this.$store.getters.$products;
    }
  },
  methods: {
    displayPrincipalPage() {
      return this.$store.dispatch("displayPrincipalPage");
    },
    removeProduct(item) {
      this.$store.dispatch("removeProduct", item);
    },
    async createDocument() {
      const data = {
        sender: this.$store.getters.$sender,
        reciver: this.$store.getters.$reciver,
        content: this.$store.getters.$products
      };

      try {
        const document = await axios.post(
          "http://localhost:8000/api/index",
          data,
          {
            responseType: "blob"
          }
        );

        window.open(URL.createObjectURL(document.data));
      } catch (e) {
        console.log(e);
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.table-content {
  background-color: white;
  height: 100%;

  padding: 1.25rem;
  border: 0.0625rem solid whitesmoke;
  background-color: white;

  border-top-right-radius: 0.3125rem;
  border-bottom-right-radius: 0.3125rem;

  position: relative;
}

h1 {
  font-family: "Lora", sans-serif !important;
  font-size: 2.375rem;
  line-height: 1.25rem;
  text-align: left;
  margin-top: 10px;

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

.hollow-array {
  a {
    text-align: center;
  }
}

.bi-arrow-down-left-circle-fill {
  top: -0.9375rem;
  left: -1.3125rem;

  font-size: 2.5rem;
  line-height: 0;

  color: #e97b00;
  filter: drop-shadow(2px 1px 3px rgba(41, 41, 41, 0.5));

  position: absolute;
}

.bi-arrow-down-left-circle-fill:hover {
  color: rgb(250, 142, 19);
}

th:last-child,
th:first-child {
  text-align: center;
}

.trash-icon {
  text-align: center;
  color: #e97b00;
}

.trash-icon:hover {
  i {
    filter: drop-shadow(0px 0px 5px #e97b00);
  }

  background-color: whitesmoke;
}

.bi-trash-fill {
  color: #e97b00;
}
</style>
