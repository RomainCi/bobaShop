<template>
  <div>
    <h1>Bonjour admin</h1>
    <div>
      <h2>Changer le message d'accueil</h2>
      <p @click="modalStore = !modalStore" v-if="!modalStore">Pour ajouter un texte pour la page accueil cliquer ici</p>
      <div v-else>
        <div class="modal">
          <label>ajout text</label>
          <input type="text" v-model="textStore">
          <button @click="storeContent">valider</button>
          <button @click="modalStore = !modalStore">annuler</button>
        </div>
      </div>
      <p>Les differents texte de la page Accueil</p>
      <div v-for="(value,index) in content" :key="index">
        <div class="modal" v-if="!modal[index]">
          <p class="textContent">text : <span>{{ value.content }}</span></p>
          <div class="contentButton">
            <button @click="this.modal[index] = true" :disabled="modal.some((value, i) => value && i !== index) ">edit
            </button>
            <button @click="deleteContent(value.id,index)">supprimer</button>
          </div>
        </div>
        <div v-else class="modal">
          <input type="text" v-model="content[index].content">
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
      const res = await axios.put(`api/home/content=${id}`, {content: this.content[index].content})
      if (res.status === 200) {
        this.modal[index] = !this.modal[index];
        let found = this.content.find((element, i) => i === index);
        found.content = this.content[index].content;
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
h2, p {
  text-align: center;
}

.modal {
  border: black 1px solid;
  width: 150px;
  margin-left: auto;
  margin-right: auto;
  gap: 5px;
  display: flex;
  flex-direction: column;
  padding: 10px;
}

label {
  text-align: center;
}

span {
  font-weight: bold;
}

.contentButton {
  display: flex;
  justify-content: space-around;
}
</style>