<template>
  <div class="modale-overlay" v-show="modalDelete" @click="modalDelete = false"></div>
  <div v-show="show" class="content">
    <ul>
      <li>Nom : {{ productsPearlSyrup[index].name }}</li>
      <li>Couleur :
        <div class="circle" :style="{'background':productsPearlSyrup[index].color}"></div>
      </li>
      <li>Stock : {{ productsPearlSyrup[index].stock }}</li>
    </ul>
    <button @click="this.show = !this.show ,this.$emit('editEmit',true)" :disabled="edit">edit</button>
    <button @click="modalDelete = !modalDelete">supprimer</button>
  </div>

  <div v-show="!show" class="content">
    <label>Nom</label>
    <input type="text" :value="productsPearlSyrup[index].name" @input="onInput($event,'name')">

    <label>Couleur</label>
    <input type="color" :value="productsPearlSyrup[index].color" @input="onInput($event,'color')">

    <label>Stock</label>
    <input type="number" @keydown="blockNonNumeric($event)" :value="productsPearlSyrup[index].stock"
           @input="onInput($event,'stock')">

    <button
        @click="this.show = !this.show ,this.$emit('editEmit',false),this.copied = { ...this.productsPearlSyrup[this.index] }">
      annuler
    </button>
    <button @click="updateProductsPearlSyrup">valider</button>
  </div>

  <div v-show="modalDelete" class="modal-content">
    <p>êtes vous sur de supprimer le produit {{ productsPearlSyrup[index].name }}</p>
    <button @click="modalDelete = false">annuler</button>
    <button @click="destroyProductsPearlSyrup">confirmer</button>
  </div>
</template>

<script>
export default {
  name: "AdminPearl&SyrupComponent",
  emits: ['editEmit', 'newProducts'],
  props: {
    index: Number,
    productsPearlSyrup: Array,
    edit: Boolean,
    route: String,
  },
  data() {
    return {
      show: true,
      modalDelete: false,
      copied: {...this.productsPearlSyrup[this.index]},
      modalStore: true,
    }
  },
  created() {

  },
  methods: {
    blockNonNumeric(event) {
      // Autorise les touches de chiffres, le point, la virgule, les flèches et la touche de suppression.
      if (!event.key.match(/[0-9]|ArrowLeft|ArrowRight|Backspace|Delete/)) {
        event.preventDefault();
      }
    },
    onInput(e, key) {
      this.copied[key] = key === "stock" ? parseInt(e.target.value) : e.target.value;
    },

    async updateProductsPearlSyrup() {
      console.log(this.copied);
      const res = await axios.put(`api/products/${this.route}/${this.copied.id}`, this.copied);
      console.log(res.status);
      if (res.status === 200) {
        this.$emit('editEmit', false);
        this.show = !this.show;
        this.$emit('newProducts', this.copied)
      }
    },
    async destroyProductsPearlSyrup() {
      console.log(this.copied);
      const res = await axios.delete(`api/products/${this.route}/${this.copied.id}`)
      if (res.status === 200) {
        this.modalDelete = false;
        location.reload();
        // this.productsPearlSyrup.splice(this.index, 1);
      }
    }
  }
}
</script>

<style scoped>
.content {
  width: 150px;
  height: 130px;
  border: 1px solid black;
}

.circle {
  height: 50px;
  width: 50px;
  border-radius: 100%;
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

ul {
  padding: 0;
  margin: 0;
}
</style>