<template>
    <div>
        <header>
            <navbar-component></navbar-component>
        </header>
        <main>
            <section>
                <h1>Réinitialiser mot de passe</h1>
                <div class="form-container">
                    <form @submit.prevent="updatePassword">
                        <div class="form-group">
                            <label>Nouveau mot de passe *</label>
                            <input v-model="password.password" type="password">
                        </div>

                        <div class="form-group">
                            <label>Confirmation mot de passe</label>
                            <input v-model="password.password_confirmation" type="password">
                        </div>

                        <p class="password-information">* Le mot de passe doit contenir un minimum de 8 caractères avec
                            un chiffre, une majuscule et un caractère spécial.</p>
                        <button>valider</button>
                        <p v-if="message">{{ message }}</p>
                    </form>
                </div>
            </section>
        </main>
        <footer>
            <footer-component></footer-component>
        </footer>
    </div>
</template>

<script>
import NavbarComponent from "@/components/NavbarComponent.vue";
import FooterComponent from "@/components/FooterComponent.vue";

export default {
    name: "ResetPasswordView",
    components: {
        NavbarComponent,
        FooterComponent
    },
    props: {
        token: String,
    },
    data() {
        return {
            password: {
                password: null,
                password_confirmation: null,
                token: this.token,
            },
            message: null,
        }
    },
    methods: {
        async updatePassword() {
            this.message = null;
            try {
                const res = await axios.put('api/update/password', this.password);
                console.log(res);
                if (res.data.status === "success") {
                    this.message = res.data.message;
                }
            } catch (e) {
                console.log(e);
                this.message = e.response.data.message;
            }

        }
    }
}
</script>

<style scoped>
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
    text-align: center;
}

.form-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 2rem;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    border-radius: 20px;
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

.form-group input[type="password"] {
    border: none;
    border-radius: 20px;
    font-size: 1.2rem;
    padding: 0.5rem;
    color: #555;
    background-color: transparent;
    transition: all 0.3s ease;
    box-shadow: 0 0 0 2px #ddd;
    font-family: Lato, sans-serif;
}

.form-group input[type="password"]:focus {
    outline: none;
    box-shadow: 0 0 0 2px #EAB99F;
}

label {
    margin-left: 10px;
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
}

button:hover {
    background-color: #D89E71;
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

@media screen and (max-width: 600px) {
    .form-container {
        width: 70%;
    }
}
</style>
