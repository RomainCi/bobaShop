<template>
  <div class="user-profile">
    <div v-for="(value,index) in user" :key="index">
      <modal-component @update-value="user[index] = $event" :type="type[index]" :modal="true" :value="value"
                       :text="text[index]"
                       :index="index"></modal-component>
    </div>
  </div>
</template>

<script>
import ModalComponent from "@/components/compte/ModalComponent.vue";

export default {
  name: "ProfilComponent",
  components: {
    ModalComponent,
  },
  props: {
    user: Object,
  },
  data() {
    return {
      text: {
        "lastname": "nom",
        "firstname": "prénom",
        "birthdays": "date de naissance"
      },
      type: {
        "lastname": "text",
        "firstname": "text",
        "birthdays": "date"
      }
    }
  },

}
</script>

<style scoped>
.user-profile {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.content {
  background-color: red;
  display: flex;
  justify-content: space-around;
}

.user-name {
  font-size: 1.2rem;
  margin: 0.5rem 0;
}

.user-birthday {
  font-size: 1rem;
  margin: 0.5rem 0;
}

@media screen and (min-width: 768px) {
  .user-profile {
    flex-direction: row;
    justify-content: space-between;
    align-items: flex-start;
    text-align: left;
  }

  .user-name {
    font-size: 1.5rem;
    margin: 0;
  }

  .user-birthday {
    font-size: 1.2rem;
    margin: 0;
  }
}
</style>
