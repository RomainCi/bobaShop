<template>
  <h2>{{ title }}</h2>
  <p @click="modalStore = true">{{ text }}</p>
  <div v-show="modalStore">
    <form @submit.prevent>
      <label>Nom</label>
      <input type="text" v-model="products.name">

      <label>Nombre de side</label>
      <input type="number" v-model="products.sides" @keydown="blockNonNumeric($event)">

      <label>Taille en ml</label>
      <input type="number" v-model="products.size" @keydown="blockNonNumeric($event)">

      <label>Prix</label>
      <input type="text" v-model="products.price" @keydown="blockNonNumericFloat($event)">

      <button @click="storeProducts">valider</button>
      <button
          @click="modalStore = !modalStore,this.products = { name: '', price: '', size: '' ,side:''}">
        annulé
      </button>
    </form>
  </div>
</template>

<script>
export default {
  name: "AdminMenuStoreComponent",
  emits: ['storeEmit'],
  props: {
    text: String,
    title: String,
  },
  data() {
    return {
      modalStore: false,
      products: {
        name: "",
        sides: "",
        size: "",
        price: "",
      },
    }
  },
  methods: {
    async storeProducts() {
      console.log(this.products)
      this.products.price = (this.products.price / 1).toFixed(2);
      const res = await axios.post(`api/products/menus`, this.products);
      if (res.status === 200) {
        this.modalStore = !this.modalStore;
        this.products = {name: "", size: "", price: "", side: ""};
        this.$emit('storeEmit', res.data);
      }
    },
    blockNonNumeric(event) {
      // Autorise les touches de chiffres, le point, la virgule, les flèches et la touche de suppression.
      if (!event.key.match(/[0-9]|ArrowLeft|ArrowRight|Backspace|Delete/)) {
        event.preventDefault();
      }
    },
    blockNonNumericFloat(event) {
      // Autorise les touches de chiffres, le point, la virgule, les flèches et la touche de suppression.
      if (!event.key.match(/[0-9.,]|ArrowLeft|ArrowRight|Backspace|Delete/)) {
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