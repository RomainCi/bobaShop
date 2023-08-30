<template>
    <div v-show="messageErrorShow">
        <p>{{ messageErrorShow }}</p>
    </div>
    <div v-if="loading">
        <p>Chargement en cours...</p>
    </div>
    <div v-else>
        <p class="choice">Vous avez choisie un {{ choice.name }} de taille {{ choice.size }} ml</p>
        <div>
            <label for="tea-select">Choisissez votre thé :</label>
            <select id="tea-select" v-model="selectedTea">
                <option value="" disabled selected>-- Sélectionnez un type de thé --</option>
                <option v-for="(value, index) in teaList" :key="index" :value="value.id" :disabled="value.stock <= 0">
                    {{ value.name }}
                    {{ value.stock <= 0 ? '(Stock épuisé)' : '' }}
                </option>
            </select>
        </div>

        <div>
            <label for="tea-select">Choisissez votre sirop :</label>
            <select id="tea-select" v-model="selectedSirop">
                <option value="" disabled selected>-- Sélectionnez un type de sirop --</option>
                <option v-for="(value, index) in siropList" :key="index" :value="value.id" :disabled="value.stock <= 0">
                    {{ value.name }} {{ value.stock <= 0 ? '(Stock épuisé)' : '' }}
                </option>
            </select>
        </div>

        <div>
            <label for="tea-select">Choisissez votre perle :</label>
            <select id="tea-select" v-model="selectedPerle">
                <option value="" disabled selected>-- Sélectionnez un type de perle --</option>
                <option v-for="(value, index) in perleList" :key="index" :value="value.id" :disabled="value.stock <= 0">
                    {{ value.name }}
                    {{ value.stock <= 0 ? '(Stock épuisé)' : '' }}
                </option>
            </select>
        </div>
        <div v-for="(index, i) in numberSide" :key="i">
            <label :for="'side-select-' + i">Choisissez votre side {{ index }} :</label>
            <select :id="'side-select-' + i" v-model="selectedSide[i]" @change="checkStock(i)">
                <option :value="null" disabled selected>-- Sélectionnez un side --</option>
                <option v-for="(value, j) in sideList" :key="j" :value="value" :disabled="value.stock <= 0">
                <span v-if="selectedSide[i] === null">{{ value.name }}{{
                        value.stock <= 0 ? '(Stock épuisé)' : ''
                    }}</span>
                    <span v-else>
                    <span>{{ value.name }} </span>
                </span>
                </option>
            </select>
        </div>
        <div class="show" v-show="show">
            <p>Il vous manque des choix !</p>
        </div>
        <div v-if="errorBasket.length !== 0 ?? 0">
            <div v-for="(value,index) in errorBasket" :key="index">
                <p style="margin: 0">{{ value[0] }}</p>
            </div>
        </div>
        <div v-if="message !== null">
            <p style="margin: 0">{{ message }}</p>
        </div>
        <button @click="saveLocalStorage">ajouter au panier</button>
    </div>
</template>

<script>

export default {
    name: "ModalBubbleComponent",
    emits: ["eventChildModals"],
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
            selectedSide: [],
            lastSide: [],
            sideList: [],
            teaList: [],
            siropList: [],
            perleList: [],
            numberSide: null,
            commandWait: [],
            show: false,
            errorBasket: [],
            savedSelectedSide: [],
            message: null,
            loading: true,
            messageErrorShow: null
        };
    },
    mounted() {
        this.productsAll();
        // this.startPolling();
    },
    beforeDestroy() {
        clearInterval(this.pollingInterval); // Arrêtez le polling lors de la destruction du composant
    },
    methods: {
        async saveLocalStorage() {
            if (this.selectedPerle === "" || this.selectedSirop === "" || this.selectedTea === "") {
                return this.show = true;
            }
            if (this.numberSide !== 0) {
                console.log(this.selectedSide);
                for (let e of this.selectedSide) {
                    if (e === null) {
                        this.show = true;
                        return;
                    }
                }
            }
            console.log('oko');
            let data = [{
                "tea": {'id': this.selectedTea},
                "syrup": {'id': this.selectedSirop},
                "pearl": {'id': this.selectedPerle},
                "menu": {'id': this.choice.id, "price": this.choice.price},
                "sides": this.selectedSide.map(item => ({'id': item.id})),
            }];
            console.log(data, "data lalal");
            try {
                const res = await axios.post('api/basket', {"data": data});
                if (res.status === 200 && res.data.status === "success") {
                    this.message = res.data.message;
                } else {
                    this.message = res.data.message;
                }
                await this.productsAll();
            } catch (e) {
                console.log(e, "le e response");
                console.log(e.response.data.errors);
                if (e.response.data.errors !== undefined) {
                    this.errorBasket = e.response.data.errors;
                } else if (e.response.data.status === "error") {
                    this.message = e.response.data.message;
                } else {
                    this.message = "Une erreur est survenue";
                }
                await this.productsAll();
            }
        },
        checkStock(index) {
            const selectedSide = this.selectedSide[index];
            if (this.lastSide[index] === null) {
                this.lastSide[index] = selectedSide;
                selectedSide.stock--;
            } else {
                this.lastSide[index].stock++;
                this.lastSide[index] = selectedSide;
                selectedSide.stock--;
            }

        },
        async productsAll() {
            try {
                this.messageErrorShow = null;
                const res = await axios.get(`api/products/${this.choice.id}`);
                if (res.data.status === "success") {
                    this.numberSide = res.data.numberSide;
                    this.teaList = res.data.teas.data;
                    this.perleList = res.data.pearls.data;
                    this.siropList = res.data.syrups.data;
                    if (this.numberSide !== 0) {
                        this.sideList = res.data.sides.data;
                    }
                    this.selectedSide = new Array(this.numberSide).fill(null);
                    this.lastSide = new Array(this.numberSide).fill(null);
                    return this.loading = false;
                }

            } catch (e) {
                this.messageErrorShow = e.response.data.message;
                return this.loading = false;
            }

        },
        startPolling() {
            this.pollingInterval = setInterval(() => {
                this.productsAll(); // Effectuez une requête périodique pour mettre à jour les données
            }, 5000); // Mettez à jour toutes les 5 secondes (à ajuster selon vos besoins)
        }
    }
}
</script>

<style scoped>
.choice {
    font-weight: bold;
}

select {
    border: none;
    border-radius: 6px;
    font-size: 1.2rem;
    padding: 0.5rem;
    color: white;
    background-color: #eab99f;
    transition: all 0.3s ease;
    font-family: Lato, sans-serif;
    margin-top: 5px;
    margin-bottom: 5px;
}

select:focus {
    outline: none;
    box-shadow: 0 0 0 2px #EAB99F;
}

option {
    background-color: #EAB99F;
    color: white;
    font-family: Rufina, serif;
}

label {
    font-family: Rufina, sans-serif;
}

div {
    display: flex;
    flex-direction: column;
}

p {
    font-family: Rufina, sans-serif;
}

button {
    background-color: #EAB99F;
    color: #ffffff;
    font-family: 'Rufina', serif;
    font-size: 1.2rem;
    font-weight: bold;
    padding: 12px 24px;
    border: none;
    border-radius: 6px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    display: flex;
    margin-right: auto;
    margin-left: auto;
    margin-top: 10px;
    transition: all 0.3s ease;
}

button:hover {
    outline: none;
    box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.25);
}

.show p {
    text-align: center;
}
</style>
