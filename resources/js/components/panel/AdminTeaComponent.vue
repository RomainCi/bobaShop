<template>
  <div class="modale-overlay" v-show="modalDelete" @click="modalDelete = false"></div>
  <div v-show="show" class="content">
    <ul>
      <li>Nom : {{ productsTea[index].name }}</li>
      <li>Image : <img alt="tea" :src="productsTea[index].image_url"></li>
      <li>Stock : {{ productsTea[index].stock }}</li>
    </ul>
    <button @click="this.show = !this.show ,this.$emit('editEmit',true)" :disabled="edit">edit</button>
    <button @click="modalDelete = !modalDelete">supprimer</button>
  </div>

  <div v-show="!show" class="content">
    <label>Nom</label>
    <input type="text" :value="productsTea[index].name" @input="onInput($event,'name')">

    <label>Image</label>
    <input type="file" ref="fileInput" @change="handleFileUpload">

    <label>Stock</label>
    <input type="number" @keydown="blockNonNumeric($event)" :value="productsTea[index].stock"
           @input="onInput($event,'stock')">

    <button
        @click="this.show = !this.show ,this.$emit('editEmit',false),this.copied = { ...this.productsTea[this.index] },this.file='', this.$refs.fileInput.value = ''">
      annuler
    </button>
    <button @click="updateProductsTea">valider</button>
  </div>

  <div v-show="modalDelete" class="modal-content">
    <p>êtes vous sur de supprimer le produit {{ productsTea[index].name }}</p>
    <button @click="modalDelete = false">annuler</button>
    <button @click="destroyProductsTea">confirmer</button>
  </div>
</template>

<script>
export default {
  name: "AdminTeaComponent",
  emits: ['editEmit', 'newProducts', 'destroyProducts'],
  props: {
    productsTea: Array,
    index: Number,
    edit: Boolean,
  },
  data() {
    return {
      show: true,
      modalDelete: false,
      copied: {...this.productsTea[this.index]},
      file: "",
      test: "",
    }
  },
  computed: {
    copiedProducts() {
      return [...this.productsTea[this.index]];
    }
  },
  methods: {
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
    async updateProductsTea() {
      console.log(this.copied, "hello");
      let fd = new FormData();
      fd.append("image", this.file);
      fd.append("name", this.copied.name);
      fd.append("stock", this.copied.stock);
      fd.append('_method', 'PUT');
      console.log(fd);
      const res = await axios.post(`api/products/teas/${this.copied.id}`, fd);
      console.log(res, "le res tea update");
      if (res.status === 200) {
        this.$emit('newProducts', res.data);
        this.$emit('editEmit', false);
        this.show = !this.show;
      }
    },
    async destroyProductsTea() {
      const res = await axios.delete(`api/products/teas/${this.copied.id}`)
      console.log(res);
      if (res.status === 200) {
        this.modalDelete = false;
        location.reload();
        // delete this.copied;
        // this.$emit('destroyProducts');
        // console.log(this.productsTea);
        // this.copied = {...this.copiedProducts};
        // this.copied = {...this.productsTea[this.index]};
      }
    },
    onInput(e, key) {
      this.copied[key] = key === "stock" ? parseInt(e.target.value) : e.target.value;
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
.content {
  width: 150px;
  height: 130px;
  border: 1px solid black;
}

img {
  height: 50px;
  width: 50px;
  border-radius: 100%;
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