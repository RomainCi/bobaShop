<template>
  <section>
    <div>
      <h1>Inscription</h1>
    </div>
    <div>
      <form @submit.prevent="sendFormulaire">
        <label>Nom</label>
        <input type="text" v-model="form.lastname">

        <label>Prénom</label>
        <input type="text" v-model="form.firstname">

        <label>Date de naissance (xx/xx/xxxx)</label>
        <input type="text" maxlength="10" v-model="dateInput" ref="dateInput" @keyup="onKeyPress">

        <label>Telephone</label>

        <vue-tel-input v-model="form.phone" mode="international"></vue-tel-input>

        <label>Email</label>
        <input type="email" v-model="form.email">

        <label>Mot de passe</label>
        <input type="text" v-model="form.password">

        <label>Vérification mot de passe</label>
        <input type="text" v-model="form.password_confirmation">

        <label>Condition générale</label>
        <input type="checkbox" v-model="form.check">

        <button>Valider</button>
      </form>
    </div>
  </section>
</template>

<script>
import {VueTelInput} from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css';

export default {
  name: "RegisterComponent",
  components: {
    VueTelInput,
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
        check: false,
      }
    }
  },

  mounted() {
    this.$refs.dateInput.addEventListener("input", this.formatDate);
  },
  methods: {
    async sendFormulaire() {
      this.form.birthdays = this.dateInput;
      console.log(this.form);
      const res = await axios.post('api/register', this.form);
      console.log(res);

    },
    onKeyPress(e){
    },
    formatDate(e) {
      let currentValue = e.target.value;
      console.log(currentValue);
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
form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
</style>