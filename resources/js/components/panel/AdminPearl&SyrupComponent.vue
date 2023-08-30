<template>
    <div class="modale-overlay" v-show="modalDelete" @click="modalDelete = false, messageErrorDelete= null"></div>
    <div v-show="show" class="content">
        <ul>
            <li>Nom : {{ productsPearlSyrup[index].name }}</li>
            <li class="color">Couleur :
                <div class="circle" :style="{'background':productsPearlSyrup[index].color}"></div>
            </li>
            <li>Stock : {{ productsPearlSyrup[index].stock }}</li>
        </ul>
        <button :class="{ 'btn-edit': edit }" @click="this.show = !this.show ,this.$emit('editEmit',true)"
                :disabled="edit">edit
        </button>
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
            @click="this.show = !this.show ,this.$emit('editEmit',false),this.copied = { ...this.productsPearlSyrup[this.index] },messageErrorUpdate = null">
            annuler
        </button>
        <button @click="updateProductsPearlSyrup">valider</button>
        <p v-show="messageErrorUpdate">{{ messageErrorUpdate }}</p>
    </div>

    <div v-show="modalDelete" class="modal-content">
        <p>êtes vous sur de supprimer le produit {{ productsPearlSyrup[index].name }}</p>
        <button @click="modalDelete = false,messageErrorDelete= null">annuler</button>
        <button @click="destroyProductsPearlSyrup">confirmer</button>
        <p v-show="messageErrorDelete">{{ messageErrorDelete }}</p>
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
            messageErrorUpdate: null,
            messageErrorDelete: null,
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
            this.messageErrorUpdate = null;
            try {
                const res = await axios.put(`api/products/${this.route}/${this.copied.id}`, this.copied);
                if (res.data.status === "success") {
                    this.$emit('editEmit', false);
                    this.show = !this.show;
                    this.$emit('newProducts', this.copied)
                }
            } catch (e) {
                this.messageErrorUpdate = e.response.data.message;
            }

        },
        async destroyProductsPearlSyrup() {
            console.log(this.copied);
            try {
                this.messageErrorDelete = null;
                const res = await axios.delete(`api/products/${this.route}/${this.copied.id}`)
                if (res.data.status === "success") {
                    this.modalDelete = false;
                    location.reload();
                }
            } catch (e) {
                this.messageErrorDelete = e.response.data.message
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
    border: #EAB99F 1px solid;
    width: 180px;
    margin-left: auto;
    margin-right: auto;
    gap: 5px;
    display: flex;
    flex-direction: column;
    padding: 10px;
    border-radius: 20px;
    height: 100%;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-family: Lato, sans-serif;
    font-size: 15px;
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

.color {
    display: flex;
    align-items: center;
    gap: 10px;
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

label {
    text-align: center;
    font-size: 13px;
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

label {
    margin-left: 10px;
}

.circle {
    height: 30px;
    width: 30px;
    border-radius: 100%;
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
