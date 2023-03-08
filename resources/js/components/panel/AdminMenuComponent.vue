<template>
  <div>
    <div class="modale-overlay" v-show="modalDelete" @click="modalDelete = false"></div>
    <h2>Changer les menus</h2>
    <button @click="modalStore = !modalStore" v-if="!modalStore">ajouter un text pour la page Page Accueil</button>
    <div v-else>
      <label>nom</label>
      <input type="text" v-model="menus.name">
      <button @click="storeMenus">valider</button>
      <button @click="modalStore = !modalStore">annuler</button>
    </div>
    <div class="container">
      <div v-for="(value,index) in menus" :key="index" class="content">

        <div v-if="!modal[index]">
          <li>
            nom: {{ value.name }}
          </li>
          <li>
            side : {{ value.sides }}
          </li>
          <li>
            taille : {{ value.size }}ml
          </li>
          <li>
            prix : {{ value.price }} {{ value.currency }}
          </li>

          <button @click="modal[index] = !modal[index]" :disabled="modal.some((value, i) => value && i !== index) ">
            edit
          </button>
          <button
              @click="modalDelete= !modalDelete , indexDelete = index, idDelete = value.id, nameDelete = value.name ">
            supprimer
          </button>
          <div v-if="modalDelete" class="modal-content">
            <p>êtes vous sur de supprimer le menu {{ nameDelete }}</p>
            <button @click="modalDelete = false">annuler</button>
            <button @click="deleteMenus">confirmer</button>
          </div>
        </div>

        <div v-else class="content">
          <label>Nom</label>
          <input v-model="menus[index].name">

          <label>Side</label>
          <input v-model="menus[index].sides">

          <label>Taille</label>
          <input v-model="menus[index].size">

          <label>Prix</label>
          <input v-model="menus[index].price">

          <button @click="updateMenus(value.id,index)">valider</button>
          <button @click="modal[index] = !modal[index]">cancel</button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AdminMenuComponent",
  data() {
    return {
      modal: [],
      menus: "",
      modalDelete: false,
      modalStore:false,
      indexDelete: "",
      nameDelete: "",
      idDelete: "",
    }
  },
  mounted() {
    this.getAllMenus()
  },
  methods: {
    async getAllMenus() {
      const res = await axios.get("api/products=menu");
      this.menus = res.data.menu;
    },
    updateMenus(id, index) {
      console.log(id, "id");
      console.log("menu", this.menu[index]);
    },
    async deleteMenus() {
      const res = await axios.delete(`api/products=menu/id=${this.idDelete}`)
      if (res.status === 200) {
        this.menus.splice(this.indexDelete, 1);
      }
    }
  }
}
</script>

<style scoped>
h2 {
  text-align: center;
}

.container {
  display: flex;
  gap: 40px;
  justify-content: center;
}

.content {
  display: flex;
  flex-direction: column;
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