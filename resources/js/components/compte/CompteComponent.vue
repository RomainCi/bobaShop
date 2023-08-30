<template>
  <section>
    <nav>
      <h1>Mon profil</h1>
      <button class="buttonShow" @click="showSidebar = true">Menu</button>
      <transition name="sidebar">
        <div v-if="showSidebar" class="sidebar">
          <button @click="showSidebar = false">Fermer</button>
          <ul>
            <li @click="choice = 1">Profil</li>
            <li @click="choice = 2">Sécurité</li>
            <li>Factures</li>
          </ul>
        </div>
      </transition>
      <div class="sidebar h">
        <ul>
          <li>Profil</li>
          <li>Sécurité</li>
          <li>Factures</li>
        </ul>
      </div>
    </nav>

    <div class="contents">
      <profil-component :user="user" v-if="choice === 1"></profil-component>
      <security-component v-if="choice === 2" :security="security"></security-component>
    </div>

  </section>
</template>

<script>
import ProfilComponent from "@/components/compte/ProfilComponent.vue";
import SecurityComponent from "@/components/compte/SecurityComponent.vue";

export default {
  name: "CompteComponent",
  components: {
    ProfilComponent,
    SecurityComponent,
  },
  data() {
    return {
      sidebarLinks: [
        {
          title: 'Mes factures',
          icon: 'fa-file-text',
          path: '/invoices'
        },
        {
          title: 'Modifier mon mot de passe',
          icon: 'fa-lock',
          path: '/change-password'
        },
        {
          title: 'Modifier mon adresse email',
          icon: 'fa-envelope',
          path: '/change-email'
        },
        {
          title: 'Déconnexion',
          icon: 'fa-sign-out',
          path: '/logout'
        }
      ],
      showSidebar: false,
      user: {},
      security:{},
      choice: 1,
    }
  },
  methods: {
    async showUser() {
      const res = await axios.get('api/user');
      console.log(res);
      if (res.status === 200) {
        // this.user = res.data.user;
        const { lastname, firstname, birthdays } = res.data.user;
        this.user = {
          lastname,
          firstname,
          birthdays
        };
        const {email} = res.data.user;
        this.security = {
          email,
          "password" : "********",
        };
      }
    }
  },
  mounted() {
    this.showUser();
  }
}
</script>

<style scoped>

nav {
  background-color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
}

h1 {
  font-size: 2rem;
  font-weight: bold;
  color: #333;
}

/* Style pour le bouton du menu */
button {
  background-color: #333;
  color: white;
  border: none;
  padding: 0.5rem;
  font-size: 1.2rem;
  cursor: pointer;
}

/* Style pour la barre latérale */
.sidebar {
  position: fixed;
  /*left: 0;*/
  right: 60%;
  top: 8.5vh;
  bottom: 0;
  background-color: #EAB99F;
  transition: left 0.3s;
  z-index: 100;
  width: 40%;
}

.h {
  display: none;
}


/* Style pour le bouton fermer */
.sidebar button {
  background-color: white;
  color: #333;
  border: none;
  padding: 0.5rem;
  font-size: 1.2rem;
  cursor: pointer;
  margin-bottom: 1rem;
}

ul {
  list-style: none;
  padding: 0;
}

.sidebar ul li a {;
  transition: 0.3s;
}

a {
  display: block;
  color: white;
  font-size: 1.2rem;
  margin-bottom: 1rem;
  text-decoration: none;
  padding: 0.5rem;
  border-radius: 0.5rem;
  transition: 0.3s;
}

.sidebar ul li:hover {
  background-color: white;
  color: white;
}

/* Style pour le contenu principal */
.contents {
  padding: 2rem;
  margin-top: 5rem;
  background-color: white;
  border-radius: 1rem;
  max-width: 400px;
  margin-left: auto;
  margin-right: auto;
}

.contents h2 {
  font-size: 1.5rem;
  font-weight: bold;
  color: #333;
  margin-bottom: 1rem;
}

/* Style pour le formulaire */
form {
  display: flex;
  flex-direction: column;
}

label {
  font-size: 1.2rem;
  font-weight: bold;
  color: #333;
  margin-bottom: 0.5rem;
}

input[type="text"],
input[type="email"],
input[type="date"] {
  padding: 0.5rem;
  margin-bottom: 1rem;
  font-size: 1.2rem;
  border: none;
  border-radius: 0.5rem;
}

button {
  background-color: #333;
  color: white;
  border: none;
  padding: 0.5rem;
  font-size: 1.2rem;
  cursor: pointer;
  border-radius: 0.5rem;
  margin-top: 1rem;
}

button:hover {
  background-color: white;
  color: #333;
}

.show-sidebar .sidebar {
  left: 0;
  z-index: 2;
}

.sidebar ul li {
  display: block;
  color: white;
  font-size: 1.2rem;
  margin-bottom: 1rem;
  text-decoration: none;
  padding: 0.5rem;
  border-radius: 0.5rem;
  transition: 0.3s;
  z-index: 1;
}

.sidebar-enter-active, .sidebar-leave-active {
  transition: all 0.5s;
}

.sidebar-leave-to {
  opacity: 0;
  transform: translateX(-100%);
}

.sidebar-leave {
  opacity: 1;
  transform: translateX(0%);
  /*width: 20%;*/
}

.sidebar-enter-active {
  transition: all 0.3s ease-out;
}

.sidebar-enter {
  transform: translateX(100%);
}

.sidebar-enter-to {
  transform: translateX(0);
}

@media screen and (min-width: 900px) {
  .h {
    display: block;
    width: fit-content;
    left: 0;

  }

  .contents {
    margin-left: 200px;
    max-width: 100%;
    background-color: yellow;
  }

  h1 {
    margin-left: 200px;
  }

  .buttonShow {
    display: none;
  }
}

</style>
