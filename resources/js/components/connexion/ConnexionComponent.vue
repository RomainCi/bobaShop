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
      const csrf = await axios.get("sanctum/csrf-cookie");
      const res = await axios.post('api/login', this.form);
      console.log(res);
      if (res.data.message === "admin") {
        this.$store.dispatch('checkAdmin', true);

      }
      if (res.data.message === "success") {
        this.$store.dispatch('checkUser', true)
        await this.$router.push('/');
      }
    },
  }
}
</script>

<style scoped>

</style>