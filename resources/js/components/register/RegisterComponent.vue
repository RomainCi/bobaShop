<template>
    <div class="modale-overlay" v-show="modal||success" @click="modal = false ; success = false"></div>
    <section>
        <div>
            <h1>Inscription</h1>
        </div>
        <div class="form-container">
            <form @submit.prevent="sendFormulaire">
                <div class="form-group name-group">
                    <div>
                        <label for="lastname">Nom *</label>
                        <input type="text" id="lastname" v-model="form.lastname">
                    </div>
                    <div>
                        <label for="firstname">Prénom *</label>
                        <input type="text" id="firstname" v-model="form.firstname">
                    </div>
                </div>


                <div class="form-group">
                    <label for="birthdate">Date de naissance (jj/mm/aaaa) *</label>
                    <input type="text" id="birthdate" maxlength="10" v-model="dateInput" ref="dateInput"
                           @keyup="onKeyPress">
                </div>

                <div class="form-group">
                    <search-adress-component @addressCity="form.address.city = $event "
                                             @addressCountry="form.address.country = $event "
                                             @addressPostalCode="form.address.postal_code = $event "
                                             @addressStreet="form.address.street = $event ">

                    </search-adress-component>
                </div>

                <div class="form-group">
                    <label for="phone">Téléphone *</label>
                    <vue-tel-input
                        :inputOptions="inputOptions" id="phone" v-model="form.phone"
                        mode="international"></vue-tel-input>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" v-model="form.email">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe **</label>
                    <input type="password" id="password" v-model="form.password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Vérification mot de passe *</label>
                    <input type="password" id="password_confirmation" v-model="form.password_confirmation">
                </div>

                <div class="content-check">
                    <label for="check">Conditions générales</label>
                    <input type="checkbox" id="check" v-model="form.check">
                </div>
                <p class="password-information">* Obligatoire</p>
                <p class="password-information">** Le mot de passe doit contenir un minimum de 8 caractères avec un
                    chiffre, une majuscule et un caractère spécial</p>
                <button>Valider</button>
            </form>
        </div>
        <div v-if="modal" class="modal-content">
            <p>Erreur lors de l'envoie du formulaire</p>
            <div class="containerError" v-for="(value,index) in validationErrors" :key="index">
                <p>{{ value[0] }}</p>
            </div>
            <p>{{ error }}</p>
        </div>
        <div class="modal-content" v-if="success">
            <p>{{ messageStore }}</p>
        </div>
    </section>
</template>

<script>
import useVuelidate from "@vuelidate/core"
import {VueTelInput} from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css';
import SearchAdressComponent from "@/components/SearchAdressComponent.vue";
import {sameAs, required, email, helpers} from "@vuelidate/validators";


export default {
    name: "RegisterComponent",
    setup() {
        return {v$: useVuelidate()};
    },
    components: {
        VueTelInput,
        SearchAdressComponent,
    },
    validations() {
        return {
            form: {
                lastname: {required},
                firstname: {required},
                phone: {
                    required,
                    checkPhone: helpers.regex(/^\+?\d{5,15}$/),
                },
                email: {required, email},
                password: {
                    required,
                    checkPassword: helpers.regex(
                        /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!§€/¤£@$<>%^&*§¤:;,-]).{8,}$/
                    ),
                },
                password_confirmation: {
                    sameAsPassword: sameAs(this.form.password),
                },
            },
        }
    },
    data() {
        return {
            dateInput: "",
            form: {
                lastname: null,
                firstname: null,
                birthdays: null,
                phone: null,
                email: null,
                password: null,
                password_confirmation: null,
                address: {
                    city: '',
                    street: "",
                    postal_code: "",
                    country: "",
                },
                check: false,
            },
            modal: false,
            success: false,
            inputOptions: {
                placeholder: "",
            },
            validationErrors: {},
            error: "",
            messageStore: null,
        }
    },

    mounted() {
        this.$refs.dateInput.addEventListener("input", this.formatDate);
    },
    methods: {
        async sendFormulaire() {
            try {
                this.form.birthdays = this.dateInput;
                const res = await axios.post('api/user', this.form);
                console.log(res);
                if (res.data.status === "success") {
                    this.success = true;
                    this.messageStore = res.data.message;
                }
            } catch (e) {
                console.log(e);
                if (e.response.status === 422 && e.response && e.response.data && e.response.data.errors) {
                    this.error = "";
                    this.validationErrors = e.response.data.errors;
                    this.modal = !this.modal;
                } else {
                    this.validationErrors = "";
                    this.error = e.response.data.message;
                    this.modal = !this.modal;
                }
            }


        },
        onKeyPress(e) {
        },
        formatDate(e) {
            let currentValue = e.target.value;
            let lastChar = currentValue.charAt(currentValue.length - 1);
            let isNumberOrSlash = /^\d+$|^\d+\/\d*$/.test(currentValue);
            if (isNumberOrSlash) {
                let digitsOnly = currentValue.replace(/\D/g, "");

                if (digitsOnly.length > 2 && digitsOnly.charAt(2) !== "/") {
                    digitsOnly = digitsOnly.slice(0, 2) + "/" + digitsOnly.slice(2);
                }

                if (digitsOnly.length > 5 && digitsOnly.charAt(5) !== "/") {
                    digitsOnly = digitsOnly.slice(0, 5) + "/" + digitsOnly.slice(5);
                }

                digitsOnly = digitsOnly.slice(0, 10);

                this.dateInput = digitsOnly;
            } else {
                e.target.value = this.dateInput;
            }
        },
    },
    updated() {
        // On supprime les lettres de l'input
        this.dateInput = this.dateInput.replace(/[^\d\/]/g, "");
    },
};

</script>

<style scoped>
.containerError p {
    margin: 0;
}

p {
    font-family: Lato, sans-serif;
    font-size: 16px;
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
    border-radius: 30px;
    z-index: 9999;
}

/* Style pour le formulaire */
section {
    display: flex;
    flex-direction: column;
    align-items: center;
}

h1 {
    color: black;
    font-family: Rufina, sans-serif;
    font-size: 3rem;
    margin-bottom: 3rem;
}

.form-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 2rem;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    padding: 2rem;
    border-radius: 6px;
    max-width: 600px;
    background-color: #fff;
    margin-bottom: 2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin: 1rem 0;
    width: 100%;
}

.form-group label {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: #333;
    font-family: Lato, sans-serif;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="password"] {
    border: none;
    border-radius: 6px;
    font-size: 1.2rem;
    padding: 0.5rem;
    color: white;
    background-color: #EAB99F;
    transition: all 0.3s ease;
    font-family: Lato, sans-serif;
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

#phone:focus {
    outline: none;
    box-shadow: 0 0 0 2px #EAB99F;
}

label {
    margin-left: 10px;
}

.form-group input[type="text"]:focus,
.form-group input[type="email"]:focus,
.form-group input[type="password"]:focus {
    outline: none;
    box-shadow: 0 0 0 2px #EAB99F;
}


.form-group input[type="checkbox"]:checked :before {
    color: blue;
    background-color: red;
}

button {
    background-color: #EAB99F;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    font-size: 1.2rem;
    margin-top: 1rem;
    padding: 0.5rem 1.5rem;
    transition: all 0.3s ease;
    width: 100%;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
    font-family: Lato, sans-serif;
}

button:hover {
    outline: none;
    box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.25);
}


/* Aligner les champs nom et prénom */
.form-group.name-group {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

.form-group.name-group div {
    width: 45%;
}

.name-group div {
    display: flex;
    flex-direction: column;
}

.content-check {
    display: flex;
}

.content-check label {
    font-family: Lato, sans-serif;
}

.content-check input {
    margin-top: 4px;
}

.password-information {
    text-align: left;
    font-size: 12px;
}

@media screen and (min-width: 600px ) {
    .form-container {
        width: 80%;
    }

}

/* Style pour la disposition en colonne sur mobile */
@media screen and (max-width: 600px) {
    .form-group {
        width: 100%;
    }

    .form-group:nth-child(2) {
        margin-top: 0;
        /* Votre règle CSS spécifique pour le deuxième élément */
    }

    .form-group.name-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 0;
    }

    .form-container {
        width: 70%;
    }

    .form-group.name-group div {
        margin-bottom: 1rem;
        width: 100%;
    }

    .modal-content {
        width: 70%;
    }

    p {
        text-align: center;
    }
}


</style>
