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
            <p @click="modalMail=true" class="forget">Mot de passe oublier ?</p>
        </div>
        <div v-if="modal" class="modal-content">
            <p>Erreur lors de la connexion</p>
        </div>
        <div v-if="modalMail" class="modal-content content-forget">
            <label>Email</label>
            <input class="modal-mail" type="email" v-model="forget.email">
            <button @click="forgetPassword">Valider</button>
            <p>Vous allez recevoir un lien dans votre boite mail</p>
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
            modalMail:false,
            forget:{
                email:null,
            }
        }
    },
    methods: {
        async authentification() {
            console.log(this.form);
            try {
                const csrf = await axios.get("sanctum/csrf-cookie");
                const res = await axios.post('api/login', this.form);
                console.log(res);
                if (res.status === 200) {
                    window.location = import.meta.env.VITE_APP_URL;
                }
            } catch (e) {
                console.log("e", e.response.request.status);
                if (e.response.request.status !== 200) {
                    this.modal = !this.modal;
                }
            }
        },
        async forgetPassword(){
            try {
                const res = await axios.post('api/forget',this.forget);
                console.log(res);
            }catch (e) {
               if(e.response.request.status !== 200){
                   alert('cette adresse mail existe pas');
               }
            }
        }
    }
}
</script>

<style scoped>
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
    border-radius: 30px;
    z-index: 9999;
}

h1 {
    color: black;
    font-family: Rufina, sans-serif;
    font-size: 3rem;
    margin-bottom: 3rem;
}

.contentForm {
    display: flex;
    flex-direction: column;
    align-items: center;
}

form {
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    border-radius: 10px;
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
    background-color: #e2d4cd;
    border-radius: 6px;
    color: white;
    font-family: Lato, sans-serif;
}

button {
    padding: 1rem 2rem;
    background-color: #e2d4cd;
    color: #fff;
    font-size: 1rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

button:hover {
    background-color: #eab99f;
}

p {
    margin-top: 1.5rem;
    font-size: 1rem;
    color: #666;
}

.forget, .account {
    border-bottom: 1px red solid;
    color: black;
    font-family: Lato, sans-serif;
    cursor: pointer;
}

.forget {
    margin-top: 10px;
}
.modal-mail{
    width: fit-content;
}
.content-forget{
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
        margin-bottom: 2rem;
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

</style>
