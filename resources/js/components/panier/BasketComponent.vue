<template>
    <section>
        <h1>Mon panier</h1>
        <div class="content-all" v-if="commandWait.length !== 0">
            <div class="content-price basket">
                <div class="content-basket" v-for="(element,index) in commandWait" :key="index">
                    <img :src="imageBubbleTea">
                    <div class="content-descriptif">
                        <div class="content-text-menu">
                            <p>{{ element.selectedMenu.name }}</p>
                        </div>
                        <div class="content-text-descriptif">
                            <p class="description">Thé : {{ element.selectedTea.name }} </p>
                            <p class="description">Perle : {{ element.selectedPerle.name }}</p>
                            <p class="description">Sirop : {{ element.selectedSirop.name }}</p>

                            <div v-if="element.selectedSide.length !== 0">
                                <p class="description">-side : <span class="description"
                                                                     v-for="(e,i) in element.selectedSide" :key="i">
                               {{ e.name }} &nbsp;
                            </span></p>
                            </div>
                        </div>
                    </div>
                    <div class="content-price-menu">
                        {{ element.selectedMenu.price }}
                    </div>
                    <div class="content-price-delete">
                        <button class="button-delete" @click="deleteBasket(index)"><i class="fa-solid fa-x"></i>
                        </button>
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
            <div class="content-button">
                <button class="button" @click="storeOrder">CONFIRMER LA COMMANDE</button>
            </div>
        </div>
        <div v-else>
            <p>Aucun article</p>
        </div>
    </section>
</template>

<script>
import imageBubbleTea from "../../../assets/image/imageBubbleTea.png"

export default {
    name: "BasketComponent",
    data() {
        return {
            commandWait: [],
            total: 0,
            modal: false,
            tva: 0,
            totalHT: 0,
            imageBubbleTea,
            // modalPayment: true,
        }
    },
    mounted() {
        this.recuperationLocalStorage();
        this.calculPrice();
    },
    methods: {
        calculPrice() {
            console.log(this.commandWait, "price");
            this.commandWait.forEach((e, i) => {
                const price = parseFloat(e.selectedMenu.price.replace("€", ""));
                this.total += price;

            })
            this.tva = (this.total / 105.5) * 5.5;
            this.totalHT = this.total - this.tva;
            console.log(this.tva, "tva");
        },
        deleteBasketAll() {
            localStorage.removeItem('commandWait');
            this.commandWait = [];
            console.log(this.commandWait.length, "longeur Deleye");
            this.total = 0;
            this.$store.dispatch('ajouterElement', -1);
            this.modal = false;
        },
        recuperationLocalStorage() {
            this.commandWait = JSON.parse(localStorage.getItem("commandWait")) || [];
            console.log(this.commandWait, 'test command');
        },
        deleteBasket(index) {
            this.commandWait.splice(index, 1);
            localStorage.removeItem('commandWait');
            localStorage.setItem("commandWait", JSON.stringify(this.commandWait));
            this.$store.dispatch('ajouterElement', this.commandWait.length);
            this.total = 0;
            this.calculPrice();
        },
        async storeOrder() {
            console.log(this.commandWait, "buy");
            let ordersId = this.commandWait.map((obj, index) => {
                const {selectedMenu, selectedTea, selectedSirop, selectedPerle, selectedSide} = obj;

                const sideIds = selectedSide ? selectedSide.map(side => ({"id": side.id})) : [];

                let result = {
                    menus: {"id": selectedMenu.id, 'price': selectedMenu.price.replace("€", "")},
                    teas: {"id": selectedTea.id},
                    syrups: {"id": selectedSirop.id,},
                    pearls: {"id": selectedPerle.id},
                }

                if (selectedSide && selectedSide.length > 0) {
                    console.log(sideIds, 'sidesIdsss');
                    result.sides = sideIds;
                } else {
                    result.sides = null;
                }

                return result
            })
            try {
                console.log(ordersId);
                let test = {
                    menus: {"id": 4, "price": "8.80"},
                    teas: {"id": 1},
                    syrups: {"id": 1},
                    pearls: {"id": 1},
                    sides: [
                        {"id": 3,}, {"id": 4}
                    ],
                };

                let tata = [];

                for (let i = 0; i < 100; i++) {
                    tata.push({
                        menus: test.menus,
                        teas: test.teas,
                        syrups: test.syrups,
                        pearls: test.pearls,
                        sides: test.sides
                    });
                }


                const res = await axios.post("api/orders", {'data': ordersId});
                if (res.status === 200) {
                    await this.$router.push(`/commandes/${res.data}`);
                    // this.deleteBasketAll();
                }
            } catch (error) {
                if (error.response.status === 401) {
                    await this.$router.push('/authentification');
                } else if (error.response.status === 403) {
                    alert('pas bien');
                }
            }

        }
    }
}
</script>

<style scoped>
/*.StripeElement {*/
/*  border: 1px solid blue;*/
/*  background-color: white;*/
/*  padding: 10px;*/
/*  border-radius: 4px;*/
/*}*/
section {
    min-height: 68.5vh;
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
    height: 100px;
}

p {

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
    width: 70%;
}
.content-text-descriptif{
    height: 70%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-top:10px ;
    padding-bottom: 10px;
}
.content-text-menu{
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
    font-family: 'Rufina', serif;
    font-size: 1rem;
    font-weight: bold;
    padding: 6px 12px;
    border: none;
    border-radius: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    width: 100%;
    height: 50px;
}

.button-delete {
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

.button:hover {
    background-color: #DCA788;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
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
.title-price{
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
