<template>
  <nav id="nav">
    <img alt="logo" :src="logo" class="logo">
    <div class="menu-hamburger">
      <i @click="openMenu" class="fa-solid fa-bars"></i>
    </div>
    <transition>
      <div :class="navLinks" id="navMain" class="navMain">
        <ul>
          <li class="x" @click="closeMenu"><i class="fa-solid fa-xmark"></i></li>
          <li @click="closeMenu">
            <router-link to="/">Accueil</router-link>
          </li>

          <li @click="closeMenu">
            <router-link to="/contact">Contact</router-link>
          </li>

          <li @click="closeMenu">
            <router-link to="/qui-sommes-nous">Qui sommes nous</router-link>
          </li>

          <li @click="closeMenu">
            <router-link to="/FAQ">F.A.Q</router-link>
          </li>

<!--          <li @click="closeMenu" v-if="$store.state.nbrBasket !== -1">-->
<!--            <router-link to="/panier"><i class="fa-solid fa-basket-shopping"></i>-->
<!--              <span>{{ $store.state.nbrBasket === 0 ? commandWait.length : $store.state.nbrBasket }}</span>-->
<!--            </router-link>-->
<!--          </li>-->
<!--          <li @click="closeMenu" v-else>-->
<!--            <router-link to="/panier">Panier <span>{{ 0 }}</span></router-link>-->
<!--          </li>-->

<!--          <li v-if="$store.state.admin" @click="closeMenu">-->
<!--            <a href="http://127.0.0.1:8000/admin/panel">test</a>-->
<!--          </li>-->
<!--          <li @click="closeMenu" v-if="!$store.state.user">-->
<!--            <router-link to="/authentification"><i class="fa-solid fa-user"></i></router-link>-->
<!--          </li>-->
<!--          <li @click="closeMenu" v-else>-->
<!--            <router-link to="/compte"><i class="fa-solid fa-user"></i></router-link>-->
<!--          </li>-->
          <img class="imageLogo" :src="imageLogo" alt="imageLogo">
        </ul>
      </div>
    </transition>
  </nav>
</template>

<script>
import logo from "../../assets/image/logo.png";
import backgroundImage from "../../assets/image/backgroundImageNavbar.png"
import imageLogo from "../../assets/image/imageLogo.png"

export default {
  name: "NavbarComponent",
  data() {
    return {
      toggle: false,
      navLinks: "close",
      logo: logo,
      backgroundImage: backgroundImage,
      imageLogo: imageLogo,
      commandWait: [],
      modalAdmin: false,
      modalUser: false,
    }
  },

  methods: {
    openMenu() {
      this.navLinks = "open";
      this.toggle = true;
      return this.$emit('position', 'fixed');
    },
    closeMenu() {
      this.navLinks = "close";
      this.toggle = false;
      return this.$emit('position', "notFixed");
    },
    // async verificationAdmin() {
    //   const res = await axios.get('/api/admin/verification');
    //   if (res.status === 200 && res.data.message === "admin") {
    //     this.modalAdmin = true;
    //     console.log(this.modalAdmin);
    //   }
    // },
    // async connexion() {
    //   const res = await axios.get('api/user/verification');
    //   if (res.status === 200 && res.data.message === "user") {
    //     this.modalUser = true;
    //   }
    // }
  },
  mounted() {
    this.commandWait = JSON.parse(localStorage.getItem("commandWait")) || [];
    // this.verificationAdmin();
    // this.connexion();
  }
}
</script>

<style lang="scss" scoped>
$backgroundColor: #EAB99F;
.open {
  width: 0;
}

span {
  margin-left: 4px;
}

@font-face {
  font-family: 'Rufina';
  font-weight: 400;
  src: url("/resources/assets/fonts/Rufina-Regular.ttf") format('truetype');
}


.logo {
  height: 30px;
  align-self: center;
  margin-left: 30px;
  cursor: pointer;
}

nav {
  display: flex;
  justify-content: space-between;
  height: 8.5Vh;
  width: 100%;
  background-color: $backgroundColor;
}

nav p {
  margin-left: 30px;
  align-self: center;
}

nav .menu-hamburger {
  display: flex;
  flex-direction: column;
  gap: 5px;
  margin-right: 30px;
  justify-content: center;
}

nav .menu-hamburger i {
  color: white;
  font-size: 25px;
  margin-right: 0;
}

ul {
  list-style-type: none;
}

.containerLink {
  display: flex;
}

a {
  text-decoration: none;
  color: white;
}

@media screen and (max-width: 900px) {
  .close {
    position: fixed;
    right: -1000px;
    height: 100vh;
    width: 0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    background-color: white;
    transition: all 0.5s ease-in;
    z-index: 100;
    background-image: url("../../assets/image/backgroundImageNavbar.png");
    background-size: cover;
  }

  .open {
    position: fixed;
    right: 0;
    top: 0;
    bottom: 0;
    display: flex;
    align-items: flex-start;
    background-color: white;
    transition: all 0.5s ease;
    z-index: 100;
    background-image: url("../../assets/image/backgroundImageNavbar.png");
    width: 100%;
    background-size: cover;
  }

  ul {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 20px;
    align-items: center;
    margin: 0;
    padding: 0;
    width: 100%;
  }

  ul li {
    margin-top: 30px;
    font-family: Rufina, sans-serif;
    font-size: 1.5em;
    height: fit-content;
    color: white;
  }

  .x {
    margin-right: 30px;
    align-self: flex-end;
  }

  i {
    color: white;
    cursor: pointer;
  }
  .imageLogo {
    align-self: flex-end;
    margin-top: -83px;
    height: 260px;
  }
  ul div {
    display: flex;
    justify-content: space-between;
    width: 280px;
    height: fit-content;
  }
}

@media screen and (min-width: 900px) {
  .fa-xmark, .fa-bars {
    display: none;
  }

  ul {
    display: flex;
    justify-content: flex-end;
    margin: 0 30px 0 0;
    align-items: center;
    gap: 40px;
    padding: 0;
    height: 100%;
  }
  .imageLogo {
    display: none;
  }
  a::after {
    display: block;
    content: "";
    border-bottom: solid 2px;
    transform: scaleX(0);
    transition: transform 250ms ease-in-out;
    transform-origin: 0 50%;
  }

  a:hover::after {
    transform: scaleX(1);
  }
  li {
    font-size: 18px;
  }
}

</style>
