<template>
  <div>
    <label for="tea-select">Choisissez votre thé :</label>
    <select id="tea-select" v-model="selectedTea">
      <option value="" disabled selected>-- Sélectionnez un type de thé --</option>
      <option v-for="(value, index) in teaList" :key="index" :value="value">{{ value.name }}</option>
    </select>
  </div>
  <div>
    <label for="tea-select">Choisissez votre sirop :</label>
    <select id="tea-select" v-model="selectedSirop">
      <option value="" disabled selected>-- Sélectionnez un type de sirop --</option>
      <option v-for="(value, index) in siropList" :key="index" :value="value">{{ value.name }}</option>
    </select>
  </div>

  <div>
    <label for="tea-select">Choisissez votre sirop :</label>
    <select id="tea-select" v-model="selectedPerle">
      <option value="" disabled selected>-- Sélectionnez un type de sirop --</option>
      <option v-for="(value, index) in perleList" :key="index" :value="value">{{ value.name }}</option>
    </select>
  </div>
  <div v-for="(index, i) in numberSide" :key="i">
    <label :for="'side-select-' + i">Choisissez votre side {{ index }} :</label>
    <select :id="'side-select-' + i" v-model="selectedSide[i]">
      <option :value="null" disabled selected>-- Sélectionnez un side --</option>
      <option v-for="(value, j) in sideList" :key="j" :value="value">{{ value.name }}</option>
    </select>
    <p>Vous avez sélectionné : {{ selectedSide[i] }}</p>
  </div>

  <p>Résumer de votre commande vous avez choisie un {{ choice.name }} de taille {{ choice.size }} ml avec</p>
  <p>Thé {{ selectedTea.name }}</p>
  <p>Sirop {{ selectedSirop.name }}</p>
  <p>Perle {{ selectedPerle.name }}</p>
  <button @click="saveLocalStorage">valider</button>
</template>

<script>

export default {
  name: "ModalBubbleComponent",
  props: {
    choice: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      selectedTea: "",
      selectedSirop: "",
      selectedPerle: "",
      selectedSide: "",
      sideList: [],
      teaList: [],
      siropList: [],
      perleList: [],
      numberSide: null,
      commandWait: [],
    };
  },
  mounted() {
    this.getAllProductsBubble();
  },
  methods: {
    saveLocalStorage() {
      // console.log(this.choice);
      let data = {
        "selectedTea": this.selectedTea,
        "selectedSirop": this.selectedSirop,
        "selectedPerle": this.selectedPerle,
        "selectedMenu": this.choice,
        "selectedSide": this.selectedSide,
      };
      this.commandWait = JSON.parse(localStorage.getItem("commandWait")) || [];
      if (!Array.isArray(this.commandWait)) {
        this.commandWait = [];
      }
      this.commandWait.push(data);
      console.log(this.commandWait.length, "longeur");
      localStorage.setItem("commandWait", JSON.stringify(this.commandWait));
      this.$store.dispatch('ajouterElement', this.commandWait.length);
    },
    // commandProduct() {
    //   this.numberSide === 0 ? this.commandProductNotSide() : this.commandProductSide();
    // },
    async getAllProductsBubble() {
      const res = await axios.get(`api/products=bubble/id=${this.choice.id}`);
      console.log(res);
      this.numberSide = res.data.side;
      console.log(this.numberSide);
      const product = res.data.products;
      this.teaList = product.filter(product => product.type === 'thé');
      this.siropList = product.filter(product => product.type === "sirop");
      this.perleList = product.filter(product => product.type === 'perle');
      this.sideList = product.filter(product => product.type === 'side');
      this.selectedSide = new Array(this.numberSide).fill(null);
    },
    async commandProductNotSide() {
      const res = await axios.post(`api/products=command/id=${this.choice.id}`, {
        "idPerle": this.selectedPerle.id,
        "idSirop": this.selectedSirop.id,
        "idTea": this.selectedTea.id
      });
      console.log(res);
    },
    async commandProductSide() {

      const ids = this.selectedSide.map((item) => item.id);
      const res = await axios.post(`api/products=command/id=${this.choice.id}`, {
        "idPerle": this.selectedPerle.id,
        "idSirop": this.selectedSirop.id,
        "idTea": this.selectedTea.id,
        "idSide": ids,
      });
      console.log(res);
    }
  }
}
</script>

<style scoped>

</style>