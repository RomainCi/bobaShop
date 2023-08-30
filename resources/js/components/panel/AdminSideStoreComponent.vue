<template>
    <h2>{{ title }}</h2>
    <p @click="modalStore = true ; this.$emit('false', false)">{{ text }}</p>
    <div v-show="modalStore" class="container">
        <form @submit.prevent>
            <label>Nom</label>
            <input class="input-name" type="text" v-model="products.name">

            <label>Description</label>
            <textarea v-model="products.description"></textarea>

            <div class="content">
                <div>
                    <label>Image</label>
                    <input type="file" ref="fileInput" @change="handleFileUpload">
                </div>
                <div>
                    <label>Quantité</label>
                    <input v-model="products.quantity" @keydown="blockNonNumeric($event)" type="number">
                </div>
            </div>
            <div class="content">
                <div>
                    <label>Prix</label>
                    <input type="text" @keydown="blockNonNumericFloat($event)" v-model="products.price">
                </div>
                <div>
                    <label>Stock</label>
                    <input type="number" v-model="products.stock" @keydown="blockNonNumeric($event)">
                </div>
            </div>
            <button @click="storeProducts">valider</button>
            <button
                @click="modalStore = !modalStore,messageErrorStore = null,this.products = { name: '', description: '', stock: '', image:'',quantity: '',price:''},this.$refs.fileInput.value = ''; this.$emit('true', true)">
                annuler
            </button>
            <span v-show="messageErrorStore">{{ messageErrorStore }}</span>
        </form>
    </div>
</template>

<script>
export default {
    name: "AdminSideStoreComponent",
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
                image: "",
                stock: "",
                description: "",
                quantity: "",
                price: "",
            },
            messageErrorStore: null,
        }
    },
    methods: {
        async storeProducts() {
            this.products.price = (this.products.price / 1).toFixed(2);
            console.log(this.products);
            let fd = new FormData();
            fd.append("image", this.products.image);
            fd.append("name", this.products.name);
            fd.append("description", this.products.description);
            fd.append("quantity", this.products.quantity);
            fd.append("stock", this.products.stock);
            fd.append("price", this.products.price);
            this.messageErrorStore = null;
            try {
                const res = await axios.post('api/products/sides', fd);
                if (res.data.status === "success") {
                    this.modalStore = !this.modalStore;
                    this.products = {name: "", image: "", stock: "", quantity: "", price: "", description: ""};
                    this.$refs.fileInput.value = '';
                    this.$emit('storeEmit', res.data.data);
                    this.$emit('true', true);
                }
            } catch (e) {
                this.messageErrorStore = e.response.data.message;
            }

        },
        handleFileUpload(event) {
            this.products.image = event.target.files[0];
            const fileSize = this.products.image.size / 1024; // convertir la taille en kilo-octets (ko)
            const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // extensions autorisées

            if (!allowedExtensions.exec(this.products.image.name)) {
                alert('Seules les images en format JPG, JPEG et PNG sont autorisées.');
                event.target.value = '';
                return false;
            }

            if (fileSize > 300) {
                alert('La taille de l\'image ne doit pas dépasser 300ko.');
                event.target.value = '';
                return false;
            }

            // Maintenant, vous pouvez envoyer le fichier au serveur ou le traiter comme vous le souhaitez.
            console.log('Fichier chargé :', this.products.image);
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

.input-name {
    width: 97%;
}

.content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.content div {
    width: 45%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 10px;
}

.content div:nth-child(2) {
    margin-right: 10px;
}

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
    width: 300px;
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
    width: 100%;
}

textarea {
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
