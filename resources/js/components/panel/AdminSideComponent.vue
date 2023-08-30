<template>
    <div class="modale-overlay" v-show="modalDelete" @click="modalDelete = false"></div>
    <div v-show="show" class="content">
        <ul>
            <li>Nom : {{ productsSide[index].name }}</li>
            <li>Image : <img alt="tea" :src="productsSide[index].image_url"></li>
            <li>Description : {{ productsSide[index].description }}</li>
            <li>Quantité : {{ productsSide[index].quantity }}</li>
            <li>Prix : {{ productsSide[index].price }} €</li>
            <li>Stock : {{ productsSide[index].stock }}</li>
        </ul>
        <button :class="{ 'btn-edit': edit }" @click="this.show = !this.show ,this.$emit('editEmit',true)"
                :disabled="edit">edit
        </button>
        <button @click="modalDelete = !modalDelete">supprimer</button>
    </div>

    <div v-show="!show" class="content">
        <label>Nom</label>
        <input type="text" :value="productsSide[index].name" @input="onInput($event,'name')">

        <label>Description</label>
        <input type="text" :value="productsSide[index].description" @input="onInput($event,'description')">

        <div class="content-form">
            <div>
                <label>Image</label>
                <input type="file" ref="fileInput" @change="handleFileUpload">
            </div>
            <div>
                <label>Quantité</label>
                <input type="number" @keydown="blockNonNumeric($event)" :value="productsSide[index].quantity"
                       @input="onInput($event,'quantity')">
            </div>
        </div>

        <div class="content-form">
            <div>
                <label>Prix</label>
                <input type="text" @keydown="blockNonNumericFloat($event)" :value="productsSide[index].price"
                       @input="onInput($event,'price')">
            </div>
            <div>
                <label>Stock</label>
                <input type="number" @keydown="blockNonNumeric($event)" :value="productsSide[index].stock"
                       @input="onInput($event,'stock')">
            </div>
        </div>
        <button
            @click="this.show = !this.show , messageErrorUpdate = null,this.$emit('editEmit',false),this.copied = { ...this.productsSide[this.index] }, this.$refs.fileInput.value = ''">
            annuler
        </button>
        <button @click="updateProductsSide">valider</button>
        <p v-show="messageErrorUpdate">{{ messageErrorUpdate }}</p>
    </div>

    <div v-show="modalDelete" class="modal-content">
        <p>êtes vous sur de supprimer le produit {{ productsSide[index].name }}</p>
        <button @click="modalDelete = false,messageErrorDelete =null">annuler</button>
        <button @click="destroyProductsSide">confirmer</button>
        <p v-show="messageErrorDelete">{{ messageErrorDelete }}</p>
    </div>
</template>

<script>
export default {
    name: "AdminSideComponent",
    emits: ['editEmit', 'newProducts', 'destroyProducts'],
    props: {
        productsSide: Array,
        index: Number,
        edit: Boolean,
    },
    data() {
        return {
            show: true,
            modalDelete: false,
            copied: {...this.productsSide[this.index]},
            file: "",
            price: 0,
            messageErrorUpdate: null,
            messageErrorDelete: null,
        }
    },
    mounted() {
        this.copied.price = parseFloat(this.copied.price);
    },
    methods: {
        async destroyProductsSide() {
            this.messageErrorDelete = null;
            try {
                const res = await axios.delete(`api/products/sides/${this.copied.id}`);
                this.messageErrorDelete = null
                if (res.data.status === "success") {
                    this.modalDelete = false;
                    location.reload();
                }
            } catch (e) {
                this.messageErrorDelete = e.response.data.message;
            }
        },
        async updateProductsSide() {
            this.copied.price = (this.copied.price / 1).toFixed(2);
            let fd = new FormData();
            fd.append("image", this.file);
            fd.append("name", this.copied.name);
            fd.append("description", this.copied.description);
            fd.append("quantity", this.copied.quantity);
            fd.append("stock", this.copied.stock);
            fd.append("price", this.copied.price);
            fd.append('_method', 'PUT');

            this.messageErrorUpdate = null;
            try {
                const res = await axios.post(`api/products/sides/${this.copied.id}`, fd);
                if (res.data.status === "success") {
                    this.$emit('newProducts', res.data.data);
                    this.$emit('editEmit', false);
                    this.show = !this.show;
                }
            } catch (e) {
                this.messageErrorUpdate = e.response.data.message;
            }

        },
        handleFileUpload(event) {
            this.file = event.target.files[0];
            const fileSize = this.file.size / 1024; // convertir la taille en kilo-octets (ko)
            const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // extensions autorisées

            if (!allowedExtensions.exec(this.file.name)) {
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
            console.log('Fichier chargé :', this.file);
        },
        onInput(e, key) {
            if (key === "price") {
                this.copied[key] = Number(e.target.value).toFixed(2);
                this.copied[key] = parseFloat(this.copied[key]);
            } else if (key === "stock" || key === 'quantity') {
                this.copied[key] = parseInt(e.target.value);
            } else {
                this.copied[key] = e.target.value;
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
.input-name {
    width: 97%;
}

.content-form {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.content-form div {
    width: 45%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 10px;
}

/*.content-form div:nth-child(2) {*/
/*    margin-right: 10px;*/
/*}*/

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

.image {
    display: flex;
    align-items: center;
    gap: 10px;
}

img {
    height: 50px;
    border-radius: 50%;
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
