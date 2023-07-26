<template>
    <header>
        <NavbarComponent></NavbarComponent>
    </header>
    <main>
        <div class="modale-overlay" v-show="!modal" @click="modal = !modal"></div>
        <section>
            <div>
                <h1>Paiement</h1>
            </div>
            <div class="mainContainer">
                <div class="content contentMax">
                    <h2>Votre compte</h2>
                    <p>Email : {{ user.email }}</p>
                </div>

                <div class="container">
                    <div class="content left">
                        <h2>Information de facturation</h2>
                        <p>Nom : {{ user.lastname }}</p>
                        <p>Prénom : {{ user.firstname }}</p>
                        <p>Societe : {{ address.society }}</p>
                        <p>Numéro de telephone : {{ user.phone }}</p>
                        <p>Adresse : {{ address.street }}</p>
                        <p>Pays : {{ address.country }}</p>
                        <p>Ville : {{ address.city }}</p>
                        <p>Code postal : {{ address.postal_code }}</p>
                        <button @click="openModal">mise a jour</button>
                    </div>

                    <!--                    /////////////////MODAL SOCIETY//////////////////-->
                    <div class="modal-content" v-show="!modal">
                        <label for="">Nom</label>
                        <input type="text" v-model="tempUser.lastname">

                        <label>Prénom</label>
                        <input type="text" v-model="tempUser.firstname">

                        <label>Société</label>
                        <input type="text" v-model="tempAddress.society">

                        <search-adress-component @addressCity="tempAddress.city = $event "
                                                 @addressCountry="tempAddress.country = $event "
                                                 @addressPostalCode="tempAddress.postal_code = $event "
                                                 @addressStreet="tempAddress.street = $event "
                                                 :data="tempAddress.street +' '+ tempAddress.city"
                        ></search-adress-component>

                        <label for="">Numéro de telephone</label>
                        <vue-tel-input id="phone" v-model="tempUser.phone" mode="international"></vue-tel-input>


                        <button @click="updateInformation">valider</button>
                    </div>


                    <div class="content right">
                        <h2>Résumé de votre commande</h2>
                        <div class="my-pagination">
                            <ul>
                                <li v-for="item in paginatedData" :key="item.id">
                                    {{ item.menus.name }} ({{ item.teas.name }},
                                    {{ item.syrups.name }},{{ item.pearls.name }})
                                    <span v-if="item.sides.length !== 0">
                    <br/>side :
                    <span v-for="side in item.sides" :key="side.id">
                      {{ side.side.name }}
                    </span>
                  </span>
                                    <br/>
                                    prix : {{ item.menus.price }} €
                                </li>
                            </ul>

                            <Paginate
                                v-if="pageCount > 1"
                                v-model="currentPage"
                                :page-count="pageCount"
                                :page-range="5"
                                :margin-pages="2"
                                :next-class="'lala'"
                                :prev-text="'&laquo;'"
                                :next-text="'&raquo;'"
                                :no-li-surround="true"
                                :container-class="'paginate'"
                                :page-link-class="'page-link'"
                                :hide-prev-next="true"
                                :click-handler="changePage"
                            />

                            <p v-if="pageCount > 1">
                                Page {{ currentPage }} sur {{ pageCount }}
                            </p>
                        </div>
                        <p>Total prix HT : {{ totalHt.toFixed(2) }} €</p>
                        <p>Total prix TTC : {{ orders.total_price }} €</p>
                    </div>
                </div>
                <div class="content contentMax">
                    <h2>Méthode de paiement</h2>
                    <div id="card-element"></div>
                </div>
                <button @click="storePayment">payer</button>
            </div>
        </section>
    </main>
</template>

<script>
import {loadStripe} from "@stripe/stripe-js";
import NavbarComponent from "@/components/NavbarComponent.vue";
import Paginate from "vuejs-paginate-next";
import {saveAs} from 'file-saver';
import {VueTelInput} from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css';
import SearchAdressComponent from "@/components/SearchAdressComponent.vue";

export default {
    name: "PaymentView",
    components: {
        NavbarComponent,
        SearchAdressComponent,
        Paginate,
        VueTelInput
    },
    props: {
        id: String,
    },
    data() {
        return {
            stripe: {},
            cardElement: {},
            orders: "",
            totalHt: 0,
            currentPage: 1,
            itemsPerPage: 6,
            orders_menu: "",
            user: "",
            lala: "",
            society: "",
            modal: true,
            tempUser: {},
            tempAddress: {},
            address: {}
        };
    },

    mounted() {
        this.stripeDownload();
        this.showOrders();
    },

    computed: {
        pageCount() {
            console.log(this.orders_menu.length);
            console.log(Math.ceil(this.orders_menu.length / this.itemsPerPage));
            return Math.ceil(this.orders_menu.length / this.itemsPerPage);
        },
        paginatedData() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.orders_menu.slice(start, end);
        },
    },
    methods: {
        openModal() {
            this.tempUser = {...this.user};
            this.tempAddress = {...this.address};
            console.log(this.tempAddress);
            this.modal = !this.modal;
        },
        changePage(page) {
            this.currentPage = page;
            let link = document.querySelectorAll(".page-link");
            link.forEach(function (value, index) {
                const nombre = parseInt(value.text);
                if (nombre === page) {
                    return (link[index].style.color = "blue");
                } else {
                    value.style.color = "red";
                }
            });
        },

        async storePayment(paymentMethodData) {
            const {paymentMethod, error} = await this.stripe.createPaymentMethod(
                "card",
                this.cardElement
            );
            console.log(paymentMethod, error);
            if (error) {
                alert(error.message);
            } else {
                console.log(this.user);
                paymentMethod.billing_details.email = this.user.email;
                const res = await axios.post(`api/payment/${this.id}`, paymentMethod,);
                console.log(res);
            }
        },

        async updateInformation() {
            this.address = this.tempAddress;
            console.log(this.address);
            this.user = this.tempUser;
            const information = {
                "address": this.address,
                "user":this.user,
            };
            console.log(information);

            // const res = await axios.put(`api/user/information/${this.address.id}`, this.address);
            const res = await axios.put(`api/user/information/${information.address.id}`, information);
            // const resUser = await axios.put(`api/user/${this.user.id}`, this.user);
        },

        async showOrders() {
            const res = await axios(`api/orders/${this.id}`);
            console.log(res);
            if (res.status === 200) {
                this.orders = res.data.orders;
                this.totalHt = this.orders.total_price / (1 + 5.5 / 100);
                this.user = res.data.user;
                this.address = res.data.address;
                this.orders_menu = this.orders.orders_menu;
            }
        },

        async stripeDownload() {
            this.stripe = await loadStripe(import.meta.env.VITE_STRIPE_KEY);
            const elements = this.stripe.elements();
            console.log(elements, this.stripe);
            this.cardElement = elements.create("card", {
                classes: {
                    base: "StripeElement bg-red w-1/2 p-2 my-2 rounded-lg",
                },
            });
            this.cardElement.mount("#card-element");
        },
    },
};
</script>

<style scoped>
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
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    z-index: 98;
    display: flex;
    flex-direction: column;
    width: 300px;
}

.paginate {
    margin-top: 0;
    margin-bottom: 0;
    display: flex;
    justify-content: space-around;
    padding: 0;
    list-style: none;
    color: red;
}

/*.pagination > .page-link {*/
/*  display: none;*/
/*}*/
/*.paginate .page-item.active {*/
/*  background-color: #007bff;*/
/*  color: #fff;*/
/*}*/

h1 {
    text-align: center;
}

.mainContainer {
    max-width: 1000px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.contentMax {
    width: 100%;
}

.tata {
    width: 100%;
}

.content {
    /*width: 100%;*/
    margin: 10px;
    padding: 20px;
    background-color: #f2f2f2;
}

h2 {
    margin-top: 0;
    text-align: center;
}

span {
    margin-left: 1px;
    margin-right: 1px;
}

@media screen and (min-width: 900px) {
    .left, .right {
        width: 50%;
    }

    .container {
        display: flex;
        justify-content: space-around;
        width: 100%;
    }
}
</style>
