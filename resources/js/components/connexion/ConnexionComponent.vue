<template>
  <section>
    <h1>connexion</h1>
    <div>
      <form @submit.prevent="authentification">
        <label>Email</label>
        <input v-model="form.email" type="email">
        <label>Mot de passe</label>
        <input v-model="form.password" type="password">
        <button>valider</button>
      </form>
      <p>Vous n'avez pas de encore de compte ?</p>
    </div>
    <button @click="test">test</button>
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
      }
    }
  },
  methods: {
    async authentification() {
      console.log(this.form);
      const csrf = await axios.get("sanctum/csrf-cookie");
      const res = await axios.post('api/login', this.form);
      console.log(res);
    },
    async test(){
      const res = await axios.get('api/test');
      console.log(res);
    }
  }
}
</script>

<style scoped>

</style>