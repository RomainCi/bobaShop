<template>
    <h2>{{ title }}</h2>
    <p @click="modalStore = true;this.$emit('false', false);">{{ text }}</p>
    <div v-show="modalStore" class="container">
        <form @submit.prevent>
            <label>Nom</label>
            <input type="text" v-model="products.name">

            <label>Nombre de side</label>
            <input type="number" v-model="products.sides" @keydown="blockNonNumeric($event)">

            <label>Taille en ml</label>
            <input type="number" v-model="products.size" @keydown="blockNonNumeric($event)">

            <label>Prix</label>
            <input type="text" v-model="products.price" @keydown="blockNonNumericFloat($event)">

            <button @click="storeProducts">valider</button>
            <button
                @click="modalStore = !modalStore,messageErrorStore =null,this.products = { name: '', price: '', size: '' ,side:''};this.$emit('true', true);">
                annuler
            </button>
            <span v-show="messageErrorStore">{{ messageErrorStore }}</span>
        </form>
    </div>
</template>

<script>
export default {
    name: "AdminMenuStoreComponent",
    emits: ['storeEmit', 'false', 'true'],
    props: {
        text: String,
        title: String,
    },
    data() {
        return {
            modalStore: false,
            products: {
                name: "",
                sides: "",
                size: "",
                price: "",
            },
            messageErrorStore: null,
        }
    },
    methods: {
        async storeProducts() {
            this.messageErrorStore = null;
            this.products.price = (this.products.price / 1).toFixed(2);
            try {
                const res = await axios.post(`api/products/menus`, this.products);
                if (res.data.status === "success") {
                    this.modalStore = !this.modalStore;
                    this.products = {name: "", size: "", price: "", side: ""};
                    this.$emit('storeEmit', res.data.data);
                    this.$emit('true', true);
                }
            } catch (e) {
                this.messageErrorStore = e.response.data.message;
            }

        },
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
    }
}
</script>

<style scoped>

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance: textfield;
}

form {
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

h2 {
    font-family: Rufina, sans-serif;
}

h2, p {
    text-align: center;
}

p {
    font-family: Lato, sans-serif;
    text-decoration: underline;
    cursor: pointer;
}

.container {
    margin-bottom: 20px;
}

label {
    text-align: center;
    font-family: Lato, sans-serif;
    font-size: 13px;
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
    margin-bottom: 6px;
    font-size: 1rem;
    border: none;
    background-color: #EAB99F;
    border-radius: 6px;
    color: white;
    font-family: Lato, sans-serif;
}

</style>
