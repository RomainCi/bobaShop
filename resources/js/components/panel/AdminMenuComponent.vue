<template>
    <div class="modale-overlay" v-show="modalDelete" @click="modalDelete = false"></div>
    <div v-show="show" class="content">
        <ul>
            <li>Nom : {{ productsMenu[index].name }}</li>
            <li>Nombre de side : {{ productsMenu[index].sides }}</li>
            <li>Taille : {{ productsMenu[index].size }}</li>
            <li>Prix : {{ productsMenu[index].price }} €</li>
        </ul>
        <button :class="{ 'btn-edit': edit }" @click="this.show = !this.show ,this.$emit('editEmit',true)"
                :disabled="edit">edit
        </button>
        <button @click="modalDelete = !modalDelete">supprimer</button>
    </div>

    <div v-show="!show" class="content">
        <label>Nom</label>
        <input type="text" :value="productsMenu[index].name" @input="onInput($event,'name')">

        <label>Nombre de side</label>
        <input type="number" @keydown="blockNonNumeric($event)" :value="productsMenu[index].sides"
               @input="onInput($event,'sides')">

        <label>Taille en ml</label>
        <input type="number" @keydown="blockNonNumeric($event)" :value="productsMenu[index].size"
               @input="onInput($event,'size')">

        <label>Prix</label>
        <input type="number" @keydown="blockNonNumericFloat($event)" :value="productsMenu[index].price"
               @input="onInput($event,'price')">

        <button
            @click="this.show = !this.show ,messageErrorUpdate =null,this.$emit('editEmit',false),this.copied = { ...this.productsMenu[this.index] }">
            annuler
        </button>
        <button @click="updateProductsMenu">valider</button>
        <p v-show="messageErrorUpdate">{{ messageErrorUpdate }}</p>
    </div>

    <div v-show="modalDelete" class="modal-content">
        <p>êtes vous sur de supprimer le produit {{ productsMenu[index].name }}</p>
        <button @click="modalDelete = false">annuler</button>
        <button @click="destroyProductsMenu">confirmer</button>
    </div>
</template>

<script>
export default {
    name: "AdminMenuComponent",
    emits: ['editEmit', 'newProducts', 'destroyProducts'],
    props: {
        productsMenu: Array,
        index: Number,
        edit: Boolean,
    },
    data() {
        return {
            show: true,
            modalDelete: false,
            copied: {...this.productsMenu[this.index]},
            file: "",
            price: 0,
            messageErrorUpdate: null,
        }
    },
    mounted() {
    },
    methods: {
        blockNonNumeric(event) {
            // Autorise les touches de chiffres, le point, la virgule, les flèches et la touche de suppression.
            if (!event.key.match(/[0-9]|ArrowLeft|ArrowRight|Backspace|Delete/)) {
                event.preventDefault();
            }
        },
        blockNonNumericFloat(event) {
            // Autorise les touches de chiffres, le point, la virgule, les flèches et la touche de suppression.
            if (!event.key.match(/[0-9.,]|ArrowLeft|ArrowRight|Backspace|Delete/)) {
                event.preventDefault();
            }
        },
        onInput(e, key) {
            if (key === "price") {
                this.copied[key] = Number(e.target.value).toFixed(2);
                this.copied[key] = parseFloat(this.copied[key]);
            } else if (key === 'size') {
                this.copied[key] = parseInt(e.target.value);
            } else {
                this.copied[key] = e.target.value;
            }
        },
        async updateProductsMenu() {
            this.messageErrorUpdate = null;
            this.copied.price = (this.copied.price / 1).toFixed(2);
            try {
                const res = await axios.put(`api/products/menus/${this.copied.id}`, this.copied);
                if (res.data.status === "success") {
                    this.$emit('newProducts', this.copied);
                    this.$emit('editEmit', false);
                    this.show = !this.show;
                }
            } catch (e) {
                this.messageErrorUpdate = e.response.data.message;
            }

        },
        async destroyProductsMenu() {
            const res = await axios.delete(`api/products/menus/${this.copied.id}`)
            if (res.status === 200) {
                this.modalDelete = false;
                location.reload();
            }
        },
        async storeMenus() {
            console.log(this.menu);
            const res = await axios.post('api/products/menus', this.menu)
            if (res.status === 200) {
                this.menu = {
                    price: '',
                    name: '',
                    sides: '',
                    size: ''
                };
                this.modalStore = false;
                this.menus.push(res.data.menu);
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
