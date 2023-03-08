<template>
  <div>
    <h1>Bonjour admin</h1>
    <div>
      <h2>Changer le message d'accueil</h2>
      <button @click="modalStore = !modalStore" v-if="!modalStore">ajouter un text pour la page Page Accueil</button>
      <div v-else>
        <label>ajout text</label>
        <input type="text" v-model="textStore">
        <button @click="storeContent">valider</button>
        <button @click="modalStore = !modalStore">annuler</button>
      </div>
      <div v-for="(value,index) in content" :key="index">
        <div v-if="!modal[index]">
          <p>{{ value.content }}</p>
          <button @click="this.modal[index] = true" :disabled="modal.some((value, i) => value && i !== index) ">edit
          </button>
          <button @click="deleteContent(value.id,index)">supprimer le texte</button>
        </div>
        <div v-else>
          <input v-model="text">
          <button @click="this.modal[index] = !this.modal[index]">annuler</button>
          <button @click="updateContent(value.id,index)">valider le texte</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AdminHomePageComponent",
  data() {
    return {
      content: "",
      text: "",
      modal: [],
      modalStore: false,
      textStore: "",
    }
  },
  mounted() {
    this.getContentHome();
  },
  methods: {
    async getContentHome() {
      const res = await axios.get("api/home/content");
      this.content = res.data.content;
    },

    async updateContent(id, index) {
      const res = await axios.put(`api/home/content=${id}`, {content: this.text})
      if (res.status === 200) {
        this.modal[index] = !this.modal[index];
        let found = this.content.find((element, i) => i === index);
        found.content = this.text;
      }
    },

    async deleteContent(id, index) {
      console.log(index)
      const res = await axios.delete(`api/home/content=${id}`);
      if (res.status === 200) {
        this.content.splice(index, 1);
      }
    },
    async storeContent() {
      console.log(this.textStore);
      const res = await axios.post("api/home/content", {content: this.textStore})
      if (res.status === 200) {
        this.textStore = "";
        this.content.push(res.data.content);
        this.modalStore = !this.modalStore;
      }
    }
  }
}
</script>

<style scoped>

</style>