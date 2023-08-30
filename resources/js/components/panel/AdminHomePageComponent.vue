<template>
    <div>
        <div>
            <h2>Changer le message d'accueil</h2>
            <p class="ajout" @click="modalStore = !modalStore" v-if="!modalStore">Pour ajouter un texte pour la page
                accueil cliquer ici !</p>
            <div v-else>
                <div class="modal">
                    <label>Text</label>
                    <input type="text" v-model="textStore">
                    <button @click="storeContent">valider</button>
                    <button @click="modalStore = !modalStore">annuler</button>
                </div>
            </div>
            <p v-if="content.length !== 0">Les differents texte de la page Accueil</p>
            <div class="container">
                <div v-for="(value,index) in content" :key="index">
                    <div class="modal" v-if="!modal[index]">
                        <p class="textContent">text : <span>{{ value.content }}</span></p>
                        <div class="contentButton">
                            <button :class="{ 'btn-edit': edit }" @click="this.modal[index] = true"
                                    :disabled="edit = modal.some((value, i) => value && i !== index)">edit
                            </button>
                            <button @click="deleteContent(value.id,index)">supprimer</button>
                        </div>
                    </div>
                    <div v-else class="modal">
                        <label>Text</label>
                        <input type="text" v-model="content[index].content">
                        <button @click="this.modal[index] = !this.modal[index]">annuler</button>
                        <button @click="updateContent(value.id,index)">valider</button>
                    </div>
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
            edit: null,
            show: false,
            delay: "",
        }
    },
    mounted() {
        this.getContentHome();
        this.getDelayCommand();
    },
    methods: {
        async getContentHome() {
            const res = await axios.get("api/home/content");
            this.content = res.data.content;
        },

        async getDelayCommand() {
            // const res = await axios.get('api/delay/command');
            // this.delay = res.data.content;
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
.btn-edit {
    background-color: red;
    /* Autres styles que vous souhaitez appliquer au bouton désactivé */
}

h2 {
    font-family: Rufina, sans-serif;
}

h2, p {
    text-align: center;
}

p {
    font-family: Lato, sans-serif;
}

.ajout {
    cursor: pointer;
    text-decoration: underline;
}

.modal {
    border: #EAB99F 1px solid;
    width: 150px;
    margin-left: auto;
    margin-right: auto;
    gap: 5px;
    display: flex;
    flex-direction: column;
    padding: 10px;
    border-radius: 20px;
}

label {
    text-align: center;
    font-size: 13px;
}

span {
    font-weight: bold;
}

.contentButton {
    display: flex;
    justify-content: space-around;
    flex-direction: column;
    gap: 5px;
}

label {
    font-family: Lato, sans-serif;
}

button {
    padding: 5px;
    background-color: #EAB99F;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

input {
    padding: 5px;
    margin-bottom: 1rem;
    font-size: 1rem;
    border: none;
    background-color: #EAB99F;
    border-radius: 6px;
    color: white;
    font-family: Lato, sans-serif;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}
</style>
