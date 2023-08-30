<template>
  <div>
    <div class="content" v-show="modal">
      <p class="user-name">{{ text }} : {{ value }}</p>
      <button @click="modal = !modal">modifier
      </button>
    </div>

    <div v-show="!modal">
      <div v-if="type === 'date'">
        <label>{{ text }}</label>
        <date-picker v-model:value="content" :format="'DD/MM/YYYY'" :value-type="'DD/MM/YYYY'"></date-picker>
      </div>
      <div v-else-if="type === 'text'|| type === 'email'">
        <label>{{ text }}</label>
        <input @input="onInput" :value="value" :type="type">
      </div>
      <div v-else>
        <label>Ancien mot de passe</label>
        <input v-model="user.last_password" :type="type">

        <label>Nouveau mot de passe</label>
        <input v-model="user.password" :type="type">

        <label>Confirmation mot de passe</label>
        <input :type="type" v-model="user.password_confirmation">
      </div>
      <button @click="updateUser(index)">valider</button>
      <button @click="modal = !modal">cancel</button>
    </div>

  </div>
</template>

<script>
import DatePicker from 'vue-datepicker-next';
import 'vue-datepicker-next/index.css';

export default {
  name: "ModalComponent",
  components: {
    DatePicker,
  },
  props: {
    modal: Boolean,
    value: String,
    text: String,
    index: String,
    type: String,
  },
  data() {
    return {
      content: "",
      user: {
        last_password: "",
        password: "",
        password_confirmation: "",
      }
    }
  },
  methods: {
    async updateUser(index) {
      if (index === 'password') {
        this.content = this.user;
      }
      const res = await axios.put("api/user", {content: this.content, colum: index});
      if (res.status === 200) {
        if(index === "password"){
         return this.$emit('update-value', "********")
        }
        this.$emit('update-value', this.content);
      }
    },
    onInput(e) {
      this.content = e.target.value;
    },
  }
}
</script>

<style scoped>

</style>