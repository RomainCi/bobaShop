<template>
  <div class="modale-overlay" v-show="modal" @click="modal = false"></div>
  <p>Mon panier</p>
  <div v-for="(element,index) in commandWait" :key="index">
    <p>Menu:{{ element.selectedMenu.name }}, the : {{ element.selectedTea.name }} , perle :
      {{ element.selectedPerle.name }}, sirop : {{ element.selectedSirop.name }} , <span
          v-for="(e,i) in element.selectedSide" :key="i">
        side : {{ e.name }},
      </span> prix :
      {{ element.selectedMenu.price }}</p>
    <button @click="deleteBasket(index)">supprimer</button>
  </div>
  <div>
    <p>Total :{{total.toFixed(2) + "€"}} </p>
  </div>
  <button @click="modal = true">supprimer la commande</button>
  <button @click="buyCommand">valider ma commande</button>
  <div v-if="modal" class="modal-content">
    <p>Êtes vous sur de supprimer la commande</p>
    <button @click="deleteBasketAll">supprimer</button>
    <button @click="modal = false">annuler</button>
  </div>
</template>

<script>

export default {
  name: "BasketComponent",
  data() {
    return {
      commandWait: [],
      total: 0,
      modal:false,
    }
  },
  mounted() {
    this.recuperationLocalStorage();
    this.calculPrice();
  },
  methods: {
    calculPrice() {
      console.log(this.commandWait, "price");
      this.commandWait.forEach((e, i) => {
        const price = parseFloat(e.selectedMenu.price.replace("€", ""));
        this.total += price;
      })
    },
    deleteBasketAll(){
      localStorage.removeItem('commandWait');
      this.commandWait = [];
      console.log(this.commandWait.length,"longeur Deleye");
      this.total = 0;
      this.$store.dispatch('ajouterElement', -1);
      this.modal = false;
    },
    recuperationLocalStorage() {
      this.commandWait = JSON.parse(localStorage.getItem("commandWait")) || [];
      console.log(this.commandWait);
    },
    deleteBasket(index) {
      this.commandWait.splice(index, 1);
      localStorage.removeItem('commandWait');
      localStorage.setItem("commandWait", JSON.stringify(this.commandWait));
      this.$store.dispatch('ajouterElement', this.commandWait.length);
    },
    async buyCommand() {
      console.log(this.commandWait, "buy");
      let commandWaitId = this.commandWait.map((obj, index) => {
        const {selectedMenu, selectedTea, selectedSirop, selectedPerle, selectedSide} = obj;

        const sideIds = selectedSide ? selectedSide.map(side => ({"id": side.id})) : [];

        let result = {
          selectedMenu: {"id": selectedMenu.id},
          selectedTea: {"id": selectedTea.id},
          selectedSirop: {"id": selectedSirop.id},
          selectedPerle: {"id": selectedPerle.id},
        }

        if (selectedSide && selectedSide.length > 0) {
          console.log(sideIds[index]);
          console.log(index, "index");
          result.selectedSide = sideIds
        }

        return result
      })

      // console.log(commandWaitId, "new");
      console.log(this.price, "pri");
      // const res = await axios.post("api/products=command", commandWaitId)
      // console.log(res);

    }
  }
}
</script>

<style scoped>
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