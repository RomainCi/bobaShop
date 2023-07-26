<template>
  <h2>{{ title }}</h2>
  <p @click="modalStore = true">{{ text }}</p>
  <div v-show="modalStore">
    <form @submit.prevent>
      <label>Nom</label>
      <input type="text" v-model="products.name">

      <label>Image</label>
      <input type="file" ref="fileInput" @change="handleFileUpload">

      <label>Stock</label>
      <input type="number" v-model="products.stock" @keydown="blockNonNumeric($event)">

      <button @click="storeProducts">valider</button>
      <button @click="modalStore = !modalStore,this.products = { name: '', file: '', stock: '' },this.$refs.fileInput.value = ''">annulé</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "AdminTeaStoreComponent",
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
        image: "",
        stock: "",
      },
    }
  },
  methods: {
    handleFileUpload(event) {
      this.products.image = event.target.files[0];
      const fileSize = this.products.image.size / 1024; // convertir la taille en kilo-octets (ko)
      const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // extensions autorisées

      if (!allowedExtensions.exec(this.products.image.name)) {
        alert('Seules les images en format JPG, JPEG et PNG sont autorisées.');
        event.target.value = '';
        return false;
      }

      if (fileSize > 300) {
        alert('La taille de l\'image ne doit pas dépasser 300ko.');
        event.target.value = '';
        return false;
      }

      // Maintenant, vous pouvez envoyer le fichier au serveur ou le traiter comme vous le souhaitez.
      console.log('Fichier chargé :', this.products.image);
    },
    async storeProducts() {
      let fd = new FormData();
      fd.append("image", this.products.image);
      fd.append("name", this.products.name);
      fd.append("stock", this.products.stock);
      const res = await axios.post(`api/products/teas`, fd);
      if (res.status === 200) {
        this.modalStore = !this.modalStore;
        this.products = {name: "", image: "", stock: ""};
        this.$refs.fileInput.value = '';
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