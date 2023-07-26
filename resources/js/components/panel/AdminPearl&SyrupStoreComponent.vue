<template>
  <h2>{{ title }}</h2>
  <p @click="modalStore = true">{{ text }}</p>
  <div v-show="modalStore">
    <form @submit.prevent>
      <label>Nom</label>
      <input type="text" v-model="products.name">

      <label>Couleur</label>
      <input type="color" v-model="products.color">

      <label>Stock</label>
      <input type="number" v-model="products.stock" @keydown="blockNonNumeric($event)">

      <button @click="storeProducts">valider</button>
      <button @click="modalStore = !modalStore,this.products = { name: '', color: '', stock: '' }">annulé</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "AdminPearl&SyrupStoreComponent",
  emits: ['storeEmit'],
  props: {
    text: String,
    route: String,
    title: String,
  },
  data() {
    return {
      modalStore: false,
      products: {
        name: "",
        color: "",
        stock: "",
      },
    }
  },
  methods: {
    async storeProducts() {
      const res = await axios.post(`api/products/${this.route}`, this.products);
      if (res.status === 200) {
        this.modalStore = !this.modalStore;
        this.products = { name: "", color: "", stock: "" };
        this.$emit('storeEmit', res.data);
      }
    },
    blockNonNumeric(event) {
      // Autorise les touches de chiffres, le point, la virgule, les flèches et la touche de suppression.
      if (!event.key.match(/[0-9]|ArrowLeft|ArrowRight|Backspace|Delete/)) {
        event.preventDefault();
      }
    },
  }
}
</script>

<style scoped>
form {
  display: flex;
  flex-direction: column;
  align-items: center;
  border: black 1px solid;
  width: 200px;
  gap: 10px;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 30px;
}
</style>