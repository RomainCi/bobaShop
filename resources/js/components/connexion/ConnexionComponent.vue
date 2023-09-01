<template>
    <div class="modale-overlay" v-show="modal || modalMail" @click="modal = false; modalMail = false"></div>
    <section>
        <h1>Connexion</h1>
        <div class="contentForm">
            <form @submit.prevent="authentification">
                <label>Email</label>
                <input v-model="form.email" type="email">
                <label>Mot de passe</label>
                <input v-model="form.password" type="password">
                <button>connexion</button>
            </form>
            <p class="account" @click="this.$router.push('/inscription')">Vous n'avez pas de encore de compte ?</p>
            <p @click="modalMail=true" class="forget">Mot de passe oublié ?</p>
        </div>
        <div v-if="modal" class="modal-content">
            <p>Erreur lors de la connexion</p>
        </div>
        <div v-if="modalMail" class="modal-content content-forget">
            <p class="oublie">Vous avez oublié votre mot de passe, veuillez écrire votre adresse email ! </p>
            <label>Email</label>
            <input class="modal-mail" type="email" v-model="forget.email">
            <button @click="forgetPassword">Valider</button>
            <p v-show="show">{{ response }}</p>
        </div>
    </section>
</template>

<script>
export default {
    name: "ConnexionComponent",
    data() {
        return {
            form: {
                email: null,
                password: null,
            },
            modal: false,
            modalMail: false,
            response: null,
            show: false,
            forget: {
                email: null,
            }
        }
    },
    methods: {
        async authentification() {
            try {
                const csrf = await axios.get("sanctum/csrf-cookie");
                const res = await axios.post('api/login', this.form);
                if (res.status === 200) {
                    window.location = import.meta.env.VITE_APP_URL;
                }
            } catch (e) {
                if (e.response.request.status !== 200) {
                    this.modal = !this.modal;
                }
            }
        },
        async forgetPassword() {
            this.response = null;
            this.show = false;
            try {
                const res = await axios.post('api/forget', this.forget);
                if (res.data.status === "success") {
                    this.response = res.data.message;
                    this.show = true;
                }
            } catch (e) {
                this.response = e.response.data.message;
                this.show = true;
            }
        }
    }
}
</script>

<style scoped>
.oublie {
    font-size: 16px;
    font-family: Lato, sans-serif;
    font-weight: bold;
    color: black;
    text-align: center;
    margin-top: 5px;
}

section {
    background-color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
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
    border-radius: 6px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    z-index: 9999;
    width: 80%;
    max-width: 583px;
}

h1 {
    color: #EAB99F;
    font-family: Rufina, sans-serif;
    font-size: 40px;
    margin-bottom: 2rem;
}

.contentForm {
    display: flex;
    flex-direction: column;
    align-items: center;
}

form {
    background-color: #fff;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    padding: 2rem;
    border-radius: 6px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    max-width: 20rem;
    width: 100%;
}

label {
    font-size: 1rem;
    margin-bottom: 0.5rem;
    color: black;
    font-family: Lato, sans-serif;
}

input {
    width: 100%;
    padding: 0.8rem 1.2rem;
    margin-bottom: 1rem;
    font-size: 1rem;
    border: none;
    background-color: #EAB99F;
    border-radius: 6px;
    color: white;
    font-family: Lato, sans-serif;
    transition: all 0.3s ease;
}

input:focus {
    outline: none;
    box-shadow: 0 0 0 2px #EAB99F;
}

button {
    padding: 0.8rem 1.8rem;
    background-color: #EAB99F;
    color: #fff;
    font-size: 1.3rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
    font-family: Lato, sans-serif;
}

button:hover {
    outline: none;
    box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.25);
}

p {
    margin-top: 1.5rem;
    font-size: 1rem;
    color: #666;
    font-family: Lato, sans-serif;
}

.forget, .account {
    border-bottom: 1px black solid;
    color: black;
    font-family: Lato, sans-serif;
    cursor: pointer;
}

.forget {
    margin-top: 10px;
}

.modal-mail {
    width: 80%;
}

.content-forget {
    display: flex;
    flex-direction: column;
    align-items: center;
}

@media screen and (max-width: 600px) {
    .contentForm {
        width: 280px;
    }

    input {
        width: 80%;
    }

    form {
        max-width: 100%;
        padding: 2rem 1rem;
    }

    h1 {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    input {
        padding: 0.6rem 1rem;
        margin-bottom: 0.8rem;
        font-size: 0.8rem;
    }

    button {
        padding: 0.8rem 1.5rem;
        font-size: 0.8rem;
    }

    p {
        font-size: 0.8rem;
    }
}

@media screen and (min-width: 1300px) {
    h1 {
        font-size: 50px;
    }
}
</style>
