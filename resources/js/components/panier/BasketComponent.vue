<template>
    <section>
        <h1>Mon panier</h1>
        <div v-if="loading">
            <p>Chargement en cours...</p>
        </div>
        <div v-else>
            <div class="content-all" v-if="products.length !== 0 && total !== 0 && message === ''">
                <div class="content-price basket">
                    <div class="content-basket" v-for="(element,index) in products" :key="index">
                        <div
                            v-if="element.pearl && element.menu && element.sides && element.tea && element.syrup && arrayBool[index]"
                            class="content-basket">
                            <img :src="imageTea" v-if="element.sides.length !== 0">
                            <img :src="imageMenu" v-else>
                            <div class="content-descriptif">
                                <div class="content-text-menu">
                                    <p>{{ element.menu.name }}</p>
                                </div>
                                <div class="content-text-descriptif">
                                    <p class="description">Thé : {{ element.tea.name }} </p>
                                    <p class="description">Perle : {{ element.pearl.name }}</p>
                                    <p class="description">Sirop : {{ element.syrup.name }}</p>
                                    <div v-if="element.sides.length !== 0">
                                        <p class="description">Sides :
                                            <span class="description" v-for="(e,i) in element.sides" :key="i">
                                                <span v-if="e">{{ e.name }}&nbsp;</span>&nbsp;
                                                 <span v-else>{{ this.arrayBool[index] = false }}</span>
                                            </span>

                                        </p>
                                    </div>

                                </div>
                            </div>

                            <div class="content-price-menu">
                                {{ element.menu.price }}€
                            </div>
                            <div class="content-price-delete">
                                <button class="button-delete" @click="deleteBasket(element.id,index)"><i
                                    class="fa-solid fa-x"></i>
                                </button>
                            </div>
                        </div>
                        <div v-else class="content-basket">
                            <img :src="imageTea">
                            <div class="content-text-menu">
                                <p style="margin-right: auto;margin-left: auto">Certains articles n'existent plus</p>
                            </div>
                            <div class="content-price-delete">
                                <button class="button-delete" @click="deleteBasket(element.id,index)"><i
                                    class="fa-solid fa-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-price-button">
                    <div class="content-price-total content-hours">
                        <p class="title-price" v-show="show">HEURE DE RÉCUPÉRATION</p>
                        <div v-if="hours === false" style="display: flex ; flex-direction: column">
                            <p>Le magasin est actuellement fermé</p>
                            <p>Les horaires sont du mardi au dimanche de 11H30 à 19h00</p>

                        </div>
                        <div v-else class="content-open-shop">
                            <div v-show="show" class="content-update-hours">
                                <p>Votre commande sera prête à {{ hours }}</p>
                                <button class="button-hours" @click="show = !show">changer l'heure</button>
                            </div>
                            <div v-show="!show" class="content-update-hours">
                                <div class="container-cancel-hours">
                                    <button class="cancel-hours" @click="show = !show,hoursForm = hours"><i
                                        class="fa-solid fa-x"></i></button>
                                </div>
                                <form class="content-update-hours-form" @submit.prevent="updateHours">
                                    <label for="heureRecuperation">Heure</label>
                                    <input type="time" id="heureRecuperation" v-model="hoursForm" max="18:30"
                                           :min="hoursMin"
                                           required>
                                    <button class="button-hours" type="submit">valider</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-price-button">
                    <div class="content-price-total">
                        <p class="title-price">FACTURE</p>
                        <div>
                            <p class="p-price">Prix ht : </p>
                            <p class="p-price-right">{{ totalHT.toFixed(2) + "€" }}</p>
                        </div>
                        <div>
                            <p class="p-price">TVA : </p>
                            <p class="p-price-right">{{ tva.toFixed(2) + "€" }}</p>
                        </div>
                        <div class="line"></div>
                        <div>
                            <p class="p-price total">Total TTC : </p>
                            <p class="p-price-right"> {{ total.toFixed(2) + "€" }}</p>
                        </div>
                    </div>

                </div>
                <div class="content-button" v-if="hours !== false">
                    <button class="button" @click="storeOrder">CONFIRMER LA COMMANDE</button>
                </div>
            </div>
            <div v-else>
                <p>{{ message }}</p>
            </div>
            <div>
                <p>{{ messageOrder }}</p>
            </div>
        </div>
    </section>
</template>

<script>
import imageBubbleTea from "../../../assets/image/imageBubbleTea.png"
import imageTea from "../../../assets/image/basket/bobasite-2Carre.avif"
import imageMenu from "../../../assets/image/basket/bobasiteCarre.avif"
import {DateTime} from 'luxon'

export default {
    name: "BasketComponent",
    data() {
        return {
            total: 0,
            tva: 0,
            totalHT: 0,
            imageBubbleTea,
            hours: null,
            show: true,
            hoursForm: null,
            hoursMin: null,
            error: null,
            products: [],
            message: "",
            loading: true,
            imageTea,
            imageMenu,
            arrayBool: [],
            messageOrder: "",
        }
    },
    mounted() {
        // this.recuperationLocalStorage();
        this.showProducts();
        // this.updateHoursNow();
        // this.interval = setInterval(this.updateHoursNow, 120000);
    },
    methods: {
        updateHours() {
            this.show = !this.show;
            this.hours = this.hoursForm;

        },
        updateHoursNow() {
            // Obtenir l'heure actuelle
            const date = DateTime.local().setZone("Europe/Paris").plus({minutes: 720});
            console.log(date.toLocaleString(DateTime.TIME_24_SIMPLE));
            if (date.weekday >= 2 && date.weekday <= 6) {
                if (date.hour >= 11 && date.minute >= 30 && date.hour < 18) {
                    this.hours = date.toLocaleString(DateTime.TIME_24_SIMPLE);
                    console.log(this.hours);
                    this.hoursForm = this.hours;
                    this.hoursMin = this.hours;
                } else if (date.hour === 18 && date.minute <= 30) {
                    this.hours = date.toLocaleString(DateTime.TIME_24_SIMPLE);
                    console.log(this.hours);
                    this.hoursForm = this.hours;
                    this.hoursMin = this.hours;
                } else {
                    return this.hours = false;
                }
            } else {
                return this.hours = false;
            }
        },

        calculPrice() {
            this.products.forEach((e, i) => {
                this.arrayBool[i] = true;
                if (e.menu && e.menu.price && e.pearl && e.syrup && e.tea && e.sides) {

                    e.sides.forEach((element, index) => {
                        if (element === null) {
                            this.products[i].menu.price = "0";
                        }
                    });
                    const price = parseFloat(e.menu.price);
                    this.total += price;
                    console.log(this.total, "toal");
                }
            })

            this.tva = (this.total * 0.1); // Calcul de la TVA à 10%
            this.totalHT = this.total - this.tva;
            console.log(this.arrayBool, this.total);
        },

        async showProducts() {
            try {
                const res = await axios.get('api/basket')
                if (res.data.status === "success") {
                    this.message = "";
                    this.products = res.data.data.basket;
                    if (this.products.length === 0) {
                        this.message = "Votre panier est vide";
                    }
                    this.calculPrice();
                } else {
                    this.products = [];
                    this.message = res.data.message;
                }
                return this.loading = false;
            } catch (e) {
                if (e.response.data.status === "error") {
                    this.message = e.response.data.message;
                    return this.loading = false;
                } else {
                    this.message = "Une erreur c'est produite";
                    return this.loading = false;
                }
            }
        },

        async deleteBasket(id, index) {
            try {
                const res = await axios.delete(`api/basket/${id}`);
                console.log(res, 'le res');
                if (res.data.status === "success") {
                    this.message = "";
                    this.products.splice(index, 1);
                    this.total = 0;
                    this.arrayBool = [];
                    this.calculPrice();
                    if (this.products.length === 0) {
                        this.message = "Votre panier est vide"
                    }
                }
            } catch (e) {
                console.log(e, "destroy");
                if (e.response.data.status === "denied") {
                    console.log("je suis la ")
                    this.message = e.response.data.message;
                    console.log(this.message);
                } else if (e.response.data.status === "error") {
                    console.log(e.response, 'le e');
                    this.message = e.response.data.message;
                    this.products = [];
                    this.total = 0;
                } else {
                    this.products = [];
                    this.total = 0;
                    this.message = "Une erreur c'est produite";
                }
            }
        },
        async storeOrder() {
            console.log(this.products);
            try {
                const res = await axios.post("api/orders", {'hours': this.hours});

                if (res.data.status === "success") {
                    await this.$router.push(`/commandes/${res.data.id}`);
                }
            } catch (e) {
                if (e.response.data.status === "error") {
                    this.total = 0;
                    this.loading = true;
                    await this.showProducts();
                } else {
                    this.total = 0;
                    this.loading = true;
                    await this.showProducts();
                }

            }

        }
    }
    ,
    created() {
        // Mettre à jour l'heure actuelle toutes les 60 secondes
        this.interval = setInterval(this.updateHeureActuelle, 60000);
    }
    ,
    beforeDestroy() {
        // Nettoyer l'intervalle lorsque le composant est détruit
        clearInterval(this.interval);
    }
}
</script>

<style scoped>
.error {
    margin-right: auto;
}

section {
    min-height: 68.5vh;
}

.content-hours {
    width: 100% !important;
}

.container-cancel-hours {
    width: 100% !important;
}

.content-update-hours {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 100% !important;
    align-items: center;
}

label {
    font-family: Lato, sans-serif;
    color: #EAB99F;
}

input {
    border: none;
    border-radius: 20px;
    font-size: 1.2rem;
    padding: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 0 0 2px #ddd;
    font-family: Lato, sans-serif;
    color: #EAB99F;
}

input:focus {
    color: white;
    background-color: #EAB99F;
    outline: none;
}


.content-update-hours-form {
    width: 60%;
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 600px;
    position: absolute;
    justify-content: space-between;
    height: 125px;
}

.content-open-shop {
    width: 100% !important;
}

.container-cancel-hours {
    width: 100%;
}

.cancel-hours {
    margin-left: auto;
    /*margin-top: 15px;*/
    margin-right: 10px;
    font-family: 'Rufina', serif;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    background-color: transparent;
    box-shadow: none;
    color: #EAB99F;
    display: flex;
    align-items: center;
    align-self: center;
    border: none;
}

.modale-overlay-panier {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 98;
    backdrop-filter: blur(15px);
}


/* Cadre pour le titre */
h1 {
    text-align: center;
    font-family: Rufina, sans-serif;
    font-size: 40px;
    color: #EAB99F;
}

img {
    height: 80px;
    border-radius: 50%;
    align-self: center;
    margin-left: 5px;
}

p {
    color: #EAB99F;
    border-radius: 5px;
    padding: 10px;
    font-family: Lato, serif;
    font-size: 16px;
    text-align: center;
}

.border-text {
    border: 2px solid #EAB99F;
    width: 70%;
}

/* Cadre pour chaque élément de la commande */
div.v-for-element {
    border: 1px solid #EAB99F;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
    font-family: Rufina, serif;
    font-size: 18px;
}

.content-descriptif {
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 100%;
}

.content-text-descriptif {
    height: 70%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-top: 10px;
    padding-bottom: 10px;
    width: 85%;
    margin-left: 15px;
}

.content-text-menu {
    height: 30%;
}

.content-text-menu p {
    padding: 0;
    margin: 10px 0 0;
    text-transform: uppercase;
    color: #EAB99F;
}

/* Cadre pour le bouton supprimer */


/* Cadre pour les informations de prix */
.content-price-menu {
    align-self: center;
    border: #EAB99F 1px solid;
    background-color: #EAB99F;
    border-radius: 40px;
    padding: 5px;
    color: white;
}

.content-price {
    border-radius: 5px;
    margin-top: 10px;
    font-family: Rufina, serif;
    font-size: 18px;
    width: 90%;
    max-width: 300px;
    display: flex;
    flex-direction: column;
    margin-left: auto;
    margin-right: auto;
    gap: 20px;
}

.content-price-total {
    border: 1px solid #EAB99F;
    font-family: Rufina, serif;
    font-size: 18px;
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    border-radius: 40px;
    align-self: center;
    box-shadow: -20px 20px 15px -3px rgba(0, 0, 0, 0.1);
}


.content-price-total div {
    display: flex;
    width: 70%;
    justify-content: space-between;
    margin: 5px auto;
}

.line {
    width: 100%;
    border-top: #EAB99F dashed 1px;
}

.content-price-total div p {
    margin: 0;
}

/*.content-price-total p {*/
/*    text-align: left;*/
/*}*/

.basket {
    max-width: 800px;
}

.description {
    margin: 0;
    padding: 0;
    text-align: left;
}

.content-basket {
    width: 100%;
    margin-right: auto;
    margin-left: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: white;
    border: 1px solid #EAB99F;
    border-radius: 40px;
    height: 150px;
    box-shadow: -20px 20px 15px -3px rgba(0, 0, 0, 0.1);
}

/* Cadre pour les boutons supprimer la commande et valider la commande */
.button {
    background-color: #EAB99F;
    color: #ffffff;
    font-family: Lato, sans-serif;
    font-size: 1rem;
    font-weight: bold;
    padding: 6px 12px;
    border: none;
    border-radius: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    width: 100%;
    height: 50px;
    transition: all 0.3s ease;
}

.button-hours {
    background-color: #EAB99F;
    color: #ffffff;
    font-family: Lato, sans-serif;
    font-size: 1rem;
    font-weight: bold;
    padding: 6px 12px;
    border: none;
    border-radius: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    width: 50%;
    transition: all 0.3s ease;
}

.button-delete {
    font-family: Lato, sans-serif;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    background-color: transparent;
    color: #EAB99F;
    display: flex;
    align-items: center;
    align-self: center;
    border: none;
    box-shadow: none;

}

.button-hours:hover, .button:hover {
    outline: none;
    box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.25);
}

.font-upper {
    font-weight: bold;
    text-transform: uppercase;
    font-family: Lato, sans-serif;
}

.total {
    font-weight: bold;
}

.side-space {
    margin-left: 5px;

}

.title-price {
    margin-top: 5px;
    margin-bottom: 0;
}

.container-price-button {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px auto;
    flex-direction: column;
    width: 90%;
    height: 150px;
    max-width: 800px;
}

Cadre pour la boîte de dialogue de suppression de commande
div.modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    border: 1px solid #EAB99F;
    border-radius: 5px;
    padding: 20px;
    font-family: Rufina, serif;
    font-size: 18px;
    text-align: center;
}

.content-button {
    margin: 20px auto;
    gap: 30px;
    width: 90%;
    max-width: 800px;
}

.content-price-delete {
    align-self: flex-start;
    margin-top: 15px;
    margin-right: 10px;
}

/*.content-price-delete .font-upper {*/
/*    width: 120px;*/
/*}*/

/*.content-price-delete {*/
/*    display: flex;*/
/*    justify-content: space-around;*/
/*    width: 30%;*/
/*}*/
.p-price, .p-price-right {
    margin: 0;
    padding: 0;
}

@media screen and (max-width: 900px) {
    .button {
        padding: 3px 6px;
        font-size: 0.8rem;
    }

    /*.content-basket {*/
    /*    flex-direction: column;*/
    /*}*/
    /*.content-price-delete {*/
    /*    display: flex;*/
    /*    width: 100%;*/
    /*}*/
    p {
        font-size: 0.8rem;
    }

}

</style>
