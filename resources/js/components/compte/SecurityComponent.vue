<template>
  <div>
    <h1>Sécurité</h1>
    <div  v-for="(value,index) in security" :key="index">
      <modal-component @update-value="security[index] = $event" :type="type[index]" :modal="true" :value="value"
                       :text="text[index]"
                       :index="index"></modal-component>
    </div>
    <!--    <div v-show="modal.email" class="content">-->
    <!--      <p>email : {{ email }}</p>-->
    <!--      <button @click="modal.email = !modal.email">modifier</button>-->
    <!--    </div>-->

    <!--    <div v-show="!modal.email">-->
    <!--      <label>Email</label>-->
    <!--      <input type="email" @input="onInputEmail" :value="email">-->
    <!--      <button @click="modal.email = !modal.email">cancel</button>-->
    <!--      <button @click="updateUser(mail,'email')">valider</button>-->
    <!--    </div>-->

    <!--    <div v-show="modal.password" class="content">-->
    <!--      <p>email : **************</p>-->
    <!--      <button @click="modal.password = !modal.password">modifier</button>-->
    <!--    </div>-->

    <!--    <div v-show="!modal.password">-->
    <!--      <label>Email</label>-->
    <!--      <input type="password" v-model="password">-->
    <!--      <button @click="modal.password = !modal.password">cancel</button>-->
    <!--      <button @click="updateUser(password,'password')">valider</button>-->
    <!--    </div>-->

  </div>
</template>

<script>
import ModalComponent from "@/components/compte/ModalComponent.vue";

export default {
  name: "SecurityComponent",
  components: {
    ModalComponent,
  },
  props: {
    security: Object,
  },
  data() {
    return {
      text: {
        "email": "email",
        "password": "mot de passe",
      },
      type: {
        "email": "email",
        "password": "password",
      }
    }
  },
  methods: {
    onInputEmail(e) {
      this.mail = e.target.value;
    },
    async updateUser(value, colum) {
      console.log(value);
      const res = await axios.put('/api/user', {content: value, colum: colum})
    }
  }
}
</script>

<style scoped>
.content {
  display: flex;
  justify-content: space-around;
}
</style>