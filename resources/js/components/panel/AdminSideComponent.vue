<template>
  <div class="modale-overlay" v-show="modalDelete" @click="modalDelete = false"></div>
  <div v-show="show" class="content">
    <ul>
      <li>Nom : {{ productsSide[index].name }}</li>
      <li>Image : <img alt="tea" :src="productsSide[index].image_url"></li>
      <li>Description : {{ productsSide[index].description }}</li>
      <li>Quantité : {{ productsSide[index].quantity }}</li>
      <li>Prix : {{ productsSide[index].price }} €</li>
      <li>Stock : {{ productsSide[index].stock }}</li>
    </ul>
    <button @click="this.show = !this.show ,this.$emit('editEmit',true)" :disabled="edit">edit</button>
    <button @click="modalDelete = !modalDelete">supprimer</button>
  </div>

  <div v-show="!show" class="content">
    <label>Nom</label>
    <input type="text" :value="productsSide[index].name" @input="onInput($event,'name')">

    <label>Image</label>
    <input type="file" ref="fileInput" @change="handleFileUpload">

    <label>Description</label>
    <input type="text" :value="productsSide[index].description" @input="onInput($event,'description')">

    <label>Quantité</label>
    <input type="number" @keydown="blockNonNumeric($event)" :value="productsSide[index].quantity"
           @input="onInput($event,'quantity')">

    <label>Prix</label>
    <input type="text" @keydown="blockNonNumericFloat($event)" :value="productsSide[index].price"
           @input="onInput($event,'price')">

    <label>Stock</label>
    <input type="number" @keydown="blockNonNumeric($event)" :value="productsSide[index].stock"
           @input="onInput($event,'stock')">

    <button
        @click="this.show = !this.show ,this.$emit('editEmit',false),this.copied = { ...this.productsSide[this.index] }, this.$refs.fileInput.value = ''">
      annuler
    </button>
    <button @click="updateProductsSide">valider</button>
  </div>

  <div v-show="modalDelete" class="modal-content">
    <p>êtes vous sur de supprimer le produit {{ productsSide[index].name }}</p>
    <button @click="modalDelete = false">annuler</button>
    <button @click="destroyProductsSide">confirmer</button>
  </div>
</template>

<script>
export default {
  name: "AdminSideComponent",
  emits: ['editEmit', 'newProducts', 'destroyProducts'],
  props: {
    productsSide: Array,
    index: Number,
    edit: Boolean,
  },
  data() {
    return {
      show: true,
      modalDelete: false,
      copied: {...this.productsSide[this.index]},
      file: "",
      price: 0,
    }
  },
  mounted() {
    this.copied.price = parseFloat(this.copied.price);
  },
  methods: {
    async destroyProductsSide(){
      const res = await axios.delete(`api/products/sides/${this.copied.id}`);
      console.log(res);
      if (res.status === 200) {
        this.modalDelete = false;
        location.reload();
      }
    },
    async updateProductsSide() {
      console.log(this.copied, "hello");
      this.copied.price = (this.copied.price/1).toFixed(2);
      let fd = new FormData();
      fd.append("image", this.file);
      fd.append("name", this.copied.name);
      fd.append("description", this.copied.description);
      fd.append("quantity", this.copied.quantity);
      fd.append("stock", this.copied.stock);
      fd.append("price", this.copied.price);
      fd.append('_method', 'PUT');
      console.log(fd);
      const res = await axios.post(`api/products/sides/${this.copied.id}`, fd);
      console.log(res, "le res side update");
      if (res.status === 200) {
        this.$emit('newProducts', res.data);
        this.$emit('editEmit', false);
        this.show = !this.show;
      }
    },
    handleFileUpload(event) {
      this.file = event.target.files[0];
      const fileSize = this.file.size / 1024; // convertir la taille en kilo-octets (ko)
      const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // extensions autorisées

      if (!allowedExtensions.exec(this.file.name)) {
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
      console.log('Fichier chargé :', this.file);
    },
    onInput(e, key) {
      if (key === "price") {
        this.copied[key] = Number(e.target.value).toFixed(2);
        this.copied[key] = parseFloat(this.copied[key]);
      } else if (key === "stock" || key === 'quantity') {
        this.copied[key] = parseInt(e.target.value);
      } else {
        this.copied[key] = e.target.value;
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
.content {
  width: 200px;
  /*height: 130px;*/
  border: 1px solid black;
}

img {
  height: 50px;
  width: 50px;
}

ul {
  padding: 0;
  margin: 0;
}

.modale-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 98;
  backdrop-filter: blur(15px);
}

.modal-content {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  z-index: 9999;
}
</style>