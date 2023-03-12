<template>
  <section>
    <nav>
      <h1>Mon profil</h1>
      <button class="buttonShow" @click="showSidebar = true">Menu</button>
      <transition name="sidebar">
        <div v-if="showSidebar" class="sidebar">
          <button @click="showSidebar = false">Fermer</button>
          <ul>
            <li><a>Profil</a></li>
            <li><a href="#">Changer l'email</a></li>
            <li><a href="#">Changer le mot de passe</a></li>
            <li><a href="#">Factures</a></li>
          </ul>
        </div>
      </transition>
      <div class="sidebar h">
        <ul>
          <li><a>Profil</a></li>
          <li><a href="#">Changer l'email</a></li>
          <li><a href="#">Changer le mot de passe</a></li>
          <li><a href="#">Factures</a></li>
        </ul>
      </div>
    </nav>

    <div class="content">
      <h2>Profil</h2>

    </div>

  </section>
</template>

<script>
export default {
  name: "CompteComponent",
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
    }
  },
  methods: {
  async showUser(){
      const res = await axios.get('api/user');
      console.log(res)
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

.h{
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

.sidebar ul li a:hover {
  background-color: white;
  color: white;
}

/* Style pour le contenu principal */
.content {
  padding: 2rem;
  margin-top: 5rem;
  background-color: white;
  border-radius: 1rem;
  max-width: 400px;
  margin-left: auto;
  margin-right: auto;
}

.content h2 {
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
.test
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

.sidebar ul li a {
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
.h{
  display: block;
  width: fit-content;
  left: 0;

}
  .content{
    margin-left: 200px;
    max-width: 100%;
  }
  h1{
    margin-left: 200px;
  }
  .buttonShow{
    display: none;
  }
}

</style>
