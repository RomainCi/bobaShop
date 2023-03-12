<template>
  <div class="containerMain">
    <div class="modale-overlay" v-show="modalDelete" @click="modalDelete = false"></div>
    <h2>Changer les menus</h2>

    <p class="textAjouter" @click="modalStore = !modalStore" v-if="!modalStore">Pour ajouter un menu cliquer ici</p>

    <div v-else class="containerForm">
      <form @submit.prevent="storeMenus">
        <label>nom</label>
        <input type="text" v-model="menu.name" required>

        <label>nombre de side</label>
        <input type="number" v-model="menu.sides" @keydown="blockNonNumeric($event)" required>

        <label>taille en ml</label>
        <input type="number" v-model="menu.size" @keydown="blockNonNumeric($event)" required>

        <label>prix</label>
        <input type="number" v-model="menu.price" @keydown="blockNonNumericChars($event)" step="0.01"
               pattern="[0-9]+([,\.][0-9]+)?" required>

        <button>valider</button>
      </form>
      <button class="cancel" @click="modalStore = !modalStore">annuler</button>
    </div>
    <div class="container">
      <div v-for="(value,index) in menus" :key="index" class="content">

        <div v-if="!modal[index]">
          <ul>
            <li class="name">
              {{ value.name }}
            </li>
            <li>
              side : <span>{{ value.sides }}</span>
            </li>
            <li>
              taille : <span>{{ value.size }}</span>ml
            </li>
            <li>
              prix : <span>{{ value.price }}</span> {{ value.currency }}
            </li>
          </ul>
          <div class="contentButton">
            <button @click="modal[index] = !modal[index], indexUpdate = index"
                    :disabled="modal.some((value, i) => value && i !== index) ">
              edit
            </button>
            <button
                @click="modalDelete= !modalDelete , indexDelete = index, idDelete = value.id, nameDelete = value.name ">
              supprimer
            </button>
          </div>
          <div v-if="modalDelete" class="modal-content">
            <p>êtes vous sur de supprimer le menu {{ nameDelete }}</p>
            <button @click="modalDelete = false">annuler</button>
            <button @click="deleteMenus">confirmer</button>
          </div>
        </div>

        <form v-else class="content contentPadding" @submit.prevent="updateMenus(value.id,index)">
          <label>Nom</label>
          <input type="text" v-model="menus[index].name" required>

          <label>Side</label>
          <input type="number" @keydown="blockNonNumeric($event)" v-model="menus[index].sides" required>

          <label>Taille</label>
          <input type="number" @keydown="blockNonNumeric($event)" v-model="menus[index].size" required>

          <label>Prix</label>
          <input type="number" v-model="menus[index].price" @keydown="blockNonNumericChars($event)" step="0.01"
                 pattern="[0-9]+([,\.][0-9]+)?" required>

          <button>valider</button>
          <button @click="modal[index] = !modal[index]">cancel</button>
        </form>

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
      modalStore: false,
      indexDelete: "",
      nameDelete: "",
      idDelete: "",
      menu: {
        name: "",
        sides: "",
        size: "",
        price: "",
      },
      test: "",
      indexUpdate: "",
    }
  },
  mounted() {
    this.getAllMenus()
  },
  methods: {
    blockNonNumeric(event) {
      // Autorise les touches de chiffres, le point, la virgule, les flèches et la touche de suppression.
      if (!event.key.match(/[0-9]|ArrowLeft|ArrowRight|Backspace|Delete/)) {
        event.preventDefault();
      }
    },
    blockNonNumericChars(event) {
      // Autorise les touches de chiffres, le point, la virgule, les flèches et la touche de suppression.
      if (!event.key.match(/[0-9]|\.|\,|ArrowLeft|ArrowRight|Backspace|Delete/)) {
        event.preventDefault();
      }
    },
    async getAllMenus() {
      const res = await axios.get("api/products=menu");
      this.menus = res.data.menu;
    },
    async updateMenus(id, index) {
      let number = this.menus[index].price;
      number = Number(number).toFixed(2);
      number = Number(number);
      this.menus[index].price = number;
      const res = await axios.put(`api/products=menu/id=${id}`, this.menus[index]);
      if (res.status === 200) {
        this.modal[index] = false;
        let found = this.menus.find((element, i) => i === index);
        found = this.menu;
      }
    },
    async deleteMenus() {
      const res = await axios.delete(`api/products=menu/id=${this.idDelete}`)
      if (res.status === 200) {
        this.menus.splice(this.indexDelete, 1);
      }
    },
    async storeMenus() {
      console.log(this.menu);
      const res = await axios.post('api/products=menu')
      if (res.status === 200) {
        this.menu = {
          price: '',
          name: '',
          sides: '',
          size: ''
        };
        this.menus.push(res.data.menu);
      }
    }
  }
}
</script>

<style scoped>

.containerMain {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-self: center;
}

h2 {
  text-align: center;
}

.container {
  display: flex;
  gap: 40px;
  justify-content: center;
  flex-wrap: wrap;
}

.content {
  display: flex;
  flex-direction: column;
  border: black 1px solid;
  width: 150px;
  height: 100%;
  gap: 5px;
}

ul {
  list-style: none;
  padding: 0;
}

li {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.name {
  text-align: center;
  margin-bottom: 10px;
  font-size: 18px;
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

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type=number] {
  -moz-appearance: textfield;
}

input {
  padding-left: 5px;
  margin-right: 10px;
  margin-left: 10px;
}

button {
  margin-right: 10px;
  margin-left: 10px;
}

label {
  margin-left: 10px;
}

.textAjouter {
  text-align: center;
}

form {
  display: flex;
  flex-direction: column;
  width: 150px;
}

.containerForm {
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

.cancel {
  width: 130px;
}

.contentButton {
  display: flex;
  justify-content: space-around;
}

span {
  font-weight: bold;
}
</style>