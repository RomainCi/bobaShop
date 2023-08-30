<template>
    <h2>{{ title }}</h2>

    <p @click="modalStore = true;this.$emit('false', false);">{{ text }}</p>
    <div v-show="modalStore" class="container">
        <form @submit.prevent>
            <label>Nom</label>
            <input type="text" v-model="products.name">

            <label>Couleur</label>
            <input type="color" v-model="products.color">

            <label>Stock</label>
            <input type="number" v-model="products.stock" @keydown="blockNonNumeric($event)">

            <button @click="storeProducts">valider</button>
            <button
                @click="modalStore = !modalStore,messageErrorStore = null,this.products = { name: '', color: '', stock: '' };this.$emit('true', true);">
                annuler
            </button>
            <span v-show="messageErrorStore">{{ messageErrorStore }}</span>
        </form>
    </div>
</template>

<script>
export default {
    name: "AdminPearl&SyrupStoreComponent",
    emits: ['storeEmit', 'false', 'true'],
    props: {
        text: String,
        route: String,
        title: String,
    },
    data() {
        return {
            modalStore: false,
            products: {
                name: "",
                color: "",
                stock: "",
            },
            messageErrorStore: null,
        }
    },
    methods: {
        async storeProducts() {
            try {
                const res = await axios.post(`api/products/${this.route}`, this.products);
                console.log(res, "store");
                if (res.data.status === "success") {
                    this.modalStore = !this.modalStore;
                    this.products = {name: "", color: "", stock: ""};
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

input[type=color] {
    width: 100%;
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
