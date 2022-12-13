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
            Accueil
          </li>
          <li @click="closeMenu">
            Contact
          </li>
          <li @click="closeMenu">
            Qui sommes-nous
          </li>
          <li @click="closeMenu">
            Faq
          </li>
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
      imageLogo: imageLogo
    }
  },
  methods: {
    openMenu() {
      this.navLinks = "open";
      this.toggle = true;
    },
    closeMenu() {
      this.navLinks = "close";
      this.toggle = false;
    },
  }
}
</script>

<style lang="scss" scoped>
$backgroundColor: #EAB99F;
.open {
  width: 0;
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
  color: #3CB9B1;
}

@media screen and (max-width: 900px) {
  .close {
    position: fixed;
    right: -700px;
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
    margin-top: -40px;
    height: 300px;
  }
  ul div {
    display: flex;
    justify-content: space-between;
    width: 280px;
    height: fit-content;
  }
}

@media screen and (min-width: 900px) {
  i {
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
}

</style>
