<template>
    <p>Vous avez choisie un {{ choice.name }} de taille {{ choice.size }} ml</p>
    <div>
        <label for="tea-select">Choisissez votre thé :</label>
        <select id="tea-select" v-model="selectedTea">
            <option value="" disabled selected>-- Sélectionnez un type de thé --</option>
            <option v-for="(value, index) in teaList" :key="index" :value="value">{{ value.name }}</option>
        </select>
    </div>

    <div>
        <label for="tea-select">Choisissez votre sirop :</label>
        <select id="tea-select" v-model="selectedSirop">
            <option value="" disabled selected>-- Sélectionnez un type de sirop --</option>
            <option v-for="(value, index) in siropList" :key="index" :value="value">{{ value.name }}</option>
        </select>
    </div>

    <div>
        <label for="tea-select">Choisissez votre perle :</label>
        <select id="tea-select" v-model="selectedPerle">
            <option value="" disabled selected>-- Sélectionnez un type de perle --</option>
            <option v-for="(value, index) in perleList" :key="index" :value="value">{{ value.name }}</option>
        </select>
    </div>
    <div v-for="(index, i) in numberSide" :key="i">
        <label :for="'side-select-' + i">Choisissez votre side {{ index }} :</label>
        <select :id="'side-select-' + i" v-model="selectedSide[i]">
            <option :value="null" disabled selected>-- Sélectionnez un side --</option>
            <option v-for="(value, j) in sideList" :key="j" :value="value">{{ value.name }}</option>
        </select>
    </div>
    <div v-show="show">
        <p>Il vous manque des choix</p>
    </div>
    <button @click="saveLocalStorage">ajouter au panier</button>

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
            sideList: [],
            teaList: [],
            siropList: [],
            perleList: [],
            numberSide: null,
            commandWait: [],
            show: false
        };
    },
    mounted() {
        this.productsAll();
    },
    methods: {
        saveLocalStorage() {
            // console.log(this.choice);
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
            console.log("continue")
            let data = {
                "selectedTea": this.selectedTea,
                "selectedSirop": this.selectedSirop,
                "selectedPerle": this.selectedPerle,
                "selectedMenu": this.choice,
                "selectedSide": this.selectedSide,
            };
            this.commandWait = JSON.parse(localStorage.getItem("commandWait")) || [];
            if (!Array.isArray(this.commandWait)) {
                this.commandWait = [];
            }
            this.commandWait.push(data);
            console.log(this.commandWait.length, "longeur");
            localStorage.setItem("commandWait", JSON.stringify(this.commandWait));
            this.$store.dispatch('ajouterElement', this.commandWait.length);
            this.$emit("eventChildModals", false);
        },

        async productsAll() {
            const res = await axios.get(`api/products/menus/${this.choice.id}`);
            console.log(res, "hello je suis la réponse");
            this.numberSide = res.data.number_side;
            this.teaList = res.data.teas;
            this.perleList = res.data.pearls;
            this.siropList = res.data.syrups;
            if (this.numberSide !== 0) {
                this.sideList = res.data.sides;
            }
            this.selectedSide = new Array(this.numberSide).fill(null);
        },
        async commandProductNotSide() {
            const res = await axios.post(`api/products=command/id=${this.choice.id}`, {
                "idPerle": this.selectedPerle.id,
                "idSirop": this.selectedSirop.id,
                "idTea": this.selectedTea.id
            });
            console.log(res);
        },
        async commandProductSide() {

            const ids = this.selectedSide.map((item) => item.id);
            const res = await axios.post(`api/products=command/id=${this.choice.id}`, {
                "idPerle": this.selectedPerle.id,
                "idSirop": this.selectedSirop.id,
                "idTea": this.selectedTea.id,
                "idSide": ids,
            });
            console.log(res);
        }
    }
}
</script>

<style scoped>
select {
    background-color: transparent;
    border: 2px solid #EAB99F;
    border-radius: 20px;
    color: #EAB99F;
    font-family: Rufina, serif;
    font-size: 16px;
    margin-bottom: 10px;
    outline: none;
    padding: 10px;
    transition: border-color 0.2s ease-in-out;
}

select:focus {
    border-color: #EAB99F;
}

option {
    background-color: white;
    color: #EAB99F;
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
    border-radius: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    display: flex;
    margin-right: auto;
    margin-left: auto;
}

button:hover {
    background-color: #DCA788;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
}

</style>
