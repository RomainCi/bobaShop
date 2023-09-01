<template>
    <header>
        <NavbarComponent></NavbarComponent>
    </header>
    <main>
        <div class="modale-overlay" v-show="!modal" @click="modal = !modal, updateError = ''"></div>
        <section>
            <div>
                <h1>Paiement</h1>
            </div>
            <div v-show="messageErrorShow">
                <p style="color: black;text-align: center">{{ messageErrorShow  }}</p>
            </div>
            <div class="mainContainer">
                <div class="content contentMax">
                    <h2>Votre compte</h2>
                    <p>Email : {{ user.email }}</p>
                </div>

                <div class="container">
                    <div class="content left content-info">
                        <div>
                            <h2>Information de facturation</h2>

                            <p>Nom : {{ user.lastname }}</p>
                            <p>Prénom : {{ user.firstname }}</p>
                            <p>Societe : {{ address.society }}</p>
                            <p>Numéro de telephone : {{ user.phone }}</p>
                            <p>Adresse : {{ address.street }}</p>
                            <p>Pays : {{ address.country }}</p>
                            <p>Ville : {{ address.city }}</p>
                            <p>Code postal : {{ address.postal_code }}</p>
                        </div>
                        <button class="button-edit" @click="openModal">mise a jour</button>
                    </div>

                    <!--                    /////////////////MODAL SOCIETY//////////////////-->
                    <div class="modal-content" v-show="!modal">
                        <div class="form-group">
                            <label for="">Nom *</label>
                            <input type="text" v-model="tempUser.lastname">
                        </div>

                        <div class="form-group">
                            <label>Prénom *</label>
                            <input type="text" v-model="tempUser.firstname">
                        </div>

                        <div class="form-group">
                            <label>Société</label>
                            <input type="text" v-model="tempAddress.society">
                        </div>

                        <div class="form-group">

                            <search-adress-component @addressCity="tempAddress.city = $event "
                                                     @addressCountry="tempAddress.country = $event "
                                                     @addressPostalCode="tempAddress.postal_code = $event "
                                                     @addressStreet="tempAddress.street = $event "
                                                     :data="tempAddress.street +' '+ tempAddress.city"
                            ></search-adress-component>
                        </div>

                        <div class="form-group">
                            <label for="">Numéro de telephone *</label>
                            <vue-tel-input id="phone" v-model="tempUser.phone" mode="international"></vue-tel-input>
                        </div>
                        <p class="obligatoire">* Obligatoire</p>
                        <button class="button-update" @click="updateInformation">valider</button>
                        <p style="color: black;text-align: center">{{ updateError }}</p>
                    </div>


                    <div class="content right">
                        <h2>Résumé de votre commande</h2>
                        <div class="my-pagination">
                            <ul>
                                <li v-for="item in paginatedData" :key="item.id">
                                    {{ item.menu.name }} ({{ item.tea.name }},
                                    {{ item.syrup.name }}, {{ item.pearl.name }})
                                    <span v-if="item.sides.length !== 0">
                    <br/>side :
                    <span v-for="side in item.sides" :key="side.id">
                      {{ side.name }}
                    </span>
                  </span>
                                    <br/>
                                    prix : {{ item.menu.price }} €
                                </li>
                            </ul>

                            <Paginate
                                v-if="pageCount > 1"
                                v-model="currentPage"
                                :page-count="pageCount"
                                :page-range="6"
                                :margin-pages="2"
                                :next-class="'lala'"
                                :prev-text="'&laquo;'"
                                :next-text="'&raquo;'"
                                :no-li-surround="true"
                                :container-class="'paginate'"
                                :page-link-class="'page-link'"
                                :hide-prev-next="true"
                            />
                        </div>
                        <div>
                            <p class="content-page" v-if="pageCount > 1">
                                Page {{ currentPage }} sur {{ pageCount }}
                            </p>

                            <div class="container-price">
                                <p>Total prix HT : {{ totalHt.toFixed(2) }} €</p>
                                <p>Total prix TTC : {{ orders.total_price }} €</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content contentMax">
                    <h2>Méthode de paiement</h2>
                    <div id="card-element"></div>
                </div>
                <div v-if="success">
                    <p style="color:#EAB99F;margin-left: 10px;margin-right: 10px">Paiement accepté. <br>Vous allez
                        recevoir un email dans 15
                        min avec la facture en pièce jointe. N'oubliez pas de vérifier vos spams si cela n'apparaît
                        pas.</p>
                </div>
                <div v-if="decline" style="width: 80vw">
                    <p style="color:#EAB99F;margin-left: 10px;margin-right: 10px; text-align: center">Paiement refusé.
                        <br>{{ response.message }}</p>
                </div>
                <div v-if="attempt" style="width: 80vw">
                    <p style="color:#EAB99F;margin-left: 10px;margin-right: 10px; text-align: center">Paiement en
                        attente.
                        <br>Vous allez être redirigé sur une vérification supplémentaire dans quelques secondes.</p>
                </div>
                <div style="width: 80vw">
                    <p style="color:#EAB99F;margin-left: 10px;margin-right: 10px; text-align: center">
                        {{ messageError }}</p>
                </div>
                <button @click="storePayment">payer</button>

            </div>
        </section>
    </main>
    <footer>
        <footer-component></footer-component>
    </footer>
</template>

<script>
import {loadStripe} from "@stripe/stripe-js";
import NavbarComponent from "@/components/NavbarComponent.vue";
import Paginate from "vuejs-paginate-next";
import {VueTelInput} from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css';
import SearchAdressComponent from "@/components/SearchAdressComponent.vue";
import FooterComponent from "@/components/FooterComponent.vue";
import {getCode} from 'iso-3166-1-alpha-2';

export default {
    name: "PaymentView",
    components: {
        NavbarComponent,
        SearchAdressComponent,
        Paginate,
        VueTelInput,
        FooterComponent
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
            itemsPerPage: 3,
            orders_menu: "",
            user: "",
            lala: "",
            society: "",
            modal: true,
            tempUser: {},
            tempAddress: {},
            address: {},
            success: false,
            decline: false,
            attempt: false,
            response: {},
            messageError: "",
            updateError: null,
            messageErrorShow: null,
        };
    },

    mounted() {
        this.stripeDownload();
        this.showOrders();
    },

    computed: {
        pageCount() {
            console.log(Math.ceil(this.orders_menu.length / this.itemsPerPage), "math");
            return Math.ceil(this.orders_menu.length / this.itemsPerPage);
        },
        paginatedData() {
            console.log("hello");
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            console.log(this.orders_menu.slice(start, end));
            return this.orders_menu.slice(start, end);
        },
    },
    methods: {
        openModal() {
            this.tempUser = {...this.user};
            this.tempAddress = {...this.address};
            this.modal = !this.modal;
        },
        // changePage(page) {
        //     this.currentPage = page;
        //     let link = document.querySelectorAll(".page-link");
        //     link.forEach(function (value, index) {
        //         const nombre = parseInt(value.text);
        //         if (nombre === page) {
        //             return (link[index].style.color = "black");
        //         } else {
        //             value.style.color = "white";
        //         }
        //     });
        // },

        async storePayment(paymentMethodData) {
            const countryCode = getCode(this.user.country);
            const billingDetails = {
                name: this.user.lastname + ' ' + this.user.firstname,
                email: this.user.email,
                phone: this.user.phone,
                address: {
                    line1: this.address.street,
                    city: this.address.city,
                    country: countryCode,
                    postal_code: this.address.postal_code,
                }
                // Autres détails de facturation si nécessaires
            };

            const {paymentMethod, error} = await this.stripe.createPaymentMethod(
                "card",
                this.cardElement,
                {
                    billing_details: billingDetails // Ajoutez les détails de facturation ici
                }
            );
            // console.log(paymentMethod, error);
            if (error) {
                this.messageError = error.message;
            } else {

                try {
                    this.messageError = "";
                    const res = await axios.post(`api/payment/${this.id}`, paymentMethod,);
                    console.log(res, "la res");
                    if (res.data.status === "succeeded") {
                        console.log("oki la res", res.data.url);
                        window.location.href = res.data.url;
                    } else if (res.data.status === "requires_action") {
                        this.attempt = true;
                        return setTimeout(function () {
                            window.location.href = res.data.url; // Rediriger après 3 secondes
                        }, 3000);
                    } else {
                        window.location.href = res.data.url;
                    }
                } catch (e) {
                    this.success = false;
                    this.decline = true;
                    this.response = {
                        "message": "Une erreur c'est produite",
                    }
                }

            }
        },

        async updateInformation() {

            const information = {
                "address": this.tempAddress,
                "user": this.tempUser,
            };
            console.log(information);
            try {
                const res = await axios.put(`api/user/information/${information.address.id}`, information);
                console.log(res, "update info");
                if (res.status === 200) {
                    this.address = this.tempAddress;
                    this.user = this.tempUser;
                    this.updateError = "";
                    this.modal = !this.modal;
                }
            } catch (e) {
                console.log(e);
                this.updateError = e.response.data.message;
            }

        },

        async showOrders() {
            this.messageErrorShow = null;
            try {
                const res = await axios(`api/orders/${this.id}`);
                if (res.data.status === "success") {
                    this.orders = res.data.order;
                    this.totalHt = this.orders.total_price / (1 + 10 / 100);
                    this.user = res.data.user;
                    this.address = res.data.user.information;
                    this.orders_menu = res.data.products;
                }
            } catch (e) {
                console.log(e);
                this.messageErrorShow = e.response.data.message;
            }

        },

        async stripeDownload() {
            this.stripe = await loadStripe(import.meta.env.VITE_STRIPE_KEY);
            const elements = this.stripe.elements();
            this.cardElement = elements.create("card", {
                style: {
                    base: {
                        color: "white",
                        '::placeholder': {
                            color: 'white',
                            fontSize: '16px',
                        },
                    }
                }
            });
            this.cardElement.mount("#card-element");
        },
    },
};
</script>

<style scoped>

.obligatoire {
    font-size: 13px;
    color: black;
}

button {
    padding: 0.8rem 1.8rem;
    background-color: #EAB99F;
    color: #ffffff;
    font-size: 1.3rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
    font-family: Lato, sans-serif;
    margin-bottom: 40px;
    margin-top: 40px;
    width: 40%;
}

button:hover {
    outline: none;
    box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.25);
}


.my-pagination {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.content-info {
    display: flex !important;
    flex-direction: column !important;

    justify-content: space-between !important;
}

.right {
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
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
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 6px;
    z-index: 98;
    display: flex;
    flex-direction: column;
    width: 300px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}

.content-info {
    background-color: yellow;
}

.button-update {
    margin: 10px auto;
}


.paginate {
    margin-top: 0;
    margin-bottom: 0;
    display: flex;
    justify-content: space-around;
    padding: 0;
    list-style: none;
    color: white;
    cursor: pointer;
    /*position: absolute;*/
    /*left: 0;*/
    /*right: 0;*/
    /*bottom: 135px;*/
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
    font-family: Rufina, sans-serif;
    font-size: 30px;
    color: #EAB99F;
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

#phone {
    border: none;
    border-radius: 6px;
    font-size: 1.2rem;
    color: black;
    background-color: #EAB99F !important;
    transition: all 0.3s ease;
    padding: 0.215rem 0.5rem;
    font-family: Lato, sans-serif;
}

.tata {
    width: 100%;
}

.content {
    /*width: 100%;*/
    margin: 10px;
    padding: 20px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    border-radius: 6px;
    background-color: #EAB99F;
    display: flex;
    flex-direction: column;
    justify-content: start;

}

.form-group {
    display: flex;
    flex-direction: column;
    margin: 0.5rem 0;
    width: 100%;
}

.form-group label {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: #333;
    font-family: Lato, sans-serif;
    margin-left: 10px;
}

.form-group input {
    border: none;
    border-radius: 6px;
    font-size: 1.2rem;
    padding: 0.5rem;
    color: white;
    background-color: #EAB99F;
    transition: all 0.3s ease;
    font-family: Lato, sans-serif;
}

.form-group input[type="text"]:focus {
    outline: none;
    box-shadow: 0 0 0 2px #EAB99F;
}

/*.left,.right{*/
/*    position: relative;*/
/*   */
/*}*/
li, p {
    color: white;
    font-size: 15px;
    font-family: Lato, sans-serif;
}

li {
    margin-top: 4px;
    margin-bottom: 4px;
    list-style: none;
}

ul {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin-top: 14px;
    margin-bottom: 14px;
    padding: 0;
}

ul li:first-child {
    margin-top: 0;
}

h2 {
    margin-top: 0;
    text-align: center;
    font-family: Lato, sans-serif;
    color: white;
    font-size: 20px;
}

span {
    margin-left: 1px;
    margin-right: 1px;
}

/*.container-price{*/
/*    position: absolute;*/
/*    bottom: 20px;*/
/*}*/
/*.content-page{*/
/*    position: absolute;*/
/*    bottom: 75px;*/
/*}*/

.container-price p:last-child {
    margin-bottom: 0px;
    font-weight: bold;
    font-size: 17px;
}

.button-edit {
    background-color: #ffffff;
    color: #EAB99F;
    width: fit-content;
    margin: 0 auto;
}

@media screen and (min-width: 900px) {
    .left, .right {
        width: 50%;
    }

    h1 {
        font-size: 40px;
    }

    .container {
        display: flex;
        justify-content: space-around;
        width: 100%;
    }

    /*.container-price{*/
    /*    position: absolute;*/
    /*    bottom: 20px;*/
    /*}*/
}

@media screen and (min-width: 1100px) {
    h1 {
        font-size: 50px;
    }
}

</style>
