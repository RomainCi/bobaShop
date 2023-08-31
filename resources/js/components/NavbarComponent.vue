<template>
    <div class="modale-overlay" v-show="show" @click="show = false"></div>
    <nav id="nav">
        <img alt="logo" @click="$router.push('/')" :src="logo" class="logo">
        <div class="container">
            <transition>
                <div :class="navLinks" id="navMain" class="navMain">
                    <ul>
                        <li class="x" @click="closeMenu"><i class="fa-solid fa-xmark"></i></li>
                        <li @click="closeMenu">
                            <router-link to="/">Accueil</router-link>
                        </li>

                        <li @click="closeMenu">
                            <router-link to="/qui-sommes-nous">Qui sommes-nous</router-link>
                        </li>

                        <li @click="closeMenu">
                            <router-link to="/FAQ">FAQ</router-link>
                        </li>
                        <li @click="closeMenu">
                            <router-link to="/contact">Contact</router-link>
                        </li>

                        <li v-if="$store.state.admin" @click="closeMenu">
                            <a :href="url">Panel</a>
                        </li>


                        <img class="imageLogo" :src="imageLogo" alt="imageLogo">
                    </ul>
                </div>
            </transition>
            <div class="menu-hamburger">
                <i @click="openMenu" class="fa-solid fa-bars"></i>
                <ul class="contain-item">
                    <li @click="closeMenu" v-if="$store.state.nbrBasket !== -1">
                        <router-link class="link-basket" to="/panier"><i class="fa-solid fa-basket-shopping"></i>
                            <!--                            <span>{{-->
                            <!--                                    $store.state.nbrBasket-->
                            <!--                                }}</span>-->
                        </router-link>
                    </li>
                    <li @click="closeMenu" v-else>
                        <router-link to="/panier" class="link-basket"><i class="fa-solid fa-basket-shopping"></i>
                            <!--                            <span>{{ commandWait.length }}</span>-->
                        </router-link>
                    </li>
                    <li @click="closeMenu" v-if="$store.state.user || $store.state.admin">
                        <i @click="show=true" class="fa-solid fa-user"></i>
                    </li>
                    <li @click="closeMenu" v-else>
                        <router-link to="/authentification"><i class="fa-solid fa-user"></i></router-link>
                    </li>
                    <div class="logout-container" v-show="show">
                        <p class="logout" @click="logout">Déconexion</p>
                    </div>
                </ul>

            </div>
        </div>
    </nav>
</template>

<script>
import logo from "../../assets/image/logo.png";
import backgroundImage from "../../assets/image/backgroundImageNavbar.png"
import imageLogo from "../../assets/image/imageLogo.png"

export default {
    name: "NavbarComponent",
    emits: ['position'],
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
            show: false,
            url: "",
        }
    },

    methods: {
        openMenu() {
            this.navLinks = "open";
            return this.$emit('position', 'fixed');
        },
        closeMenu() {
            this.navLinks = "close";
            return this.$emit('position', "notFixed");
        },
        async logout() {
            const res = await axios.post('api/logout');
            if (res.status === 200 && res.data.message === "success") {
                window.location = import.meta.env.VITE_APP_URL;
            }
        }
    },
    mounted() {
        this.url = `${import.meta.env.VITE_APP_URL}/admin/panel`
    }
}
</script>

<style lang="scss" scoped>
$backgroundColor: #EAB99F;
.modale-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 98;
    //backdrop-filter: blur(15px);
}

.user {
    display: flex;
    flex-direction: column;
    align-items: center;
    //height: 100%;
}

.logout-container {
    position: absolute;
    top: 70px;
    right: 2px;
    background-color: white;
    height: 30px;
    display: flex;
    padding: 5px;
    align-items: center;
    border-radius: 20px;
    z-index: 99;
    width: fit-content;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}

.logout {
    margin: 0;
    font-family: Lato, sans-serif;
    font-size: 13px;
    cursor: pointer;
}

.open {
    width: 0;
}

.container {
    display: flex;
}

span {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@font-face {
    font-family: 'Rufina';
    font-weight: 400;
    src: url("/resources/assets/fonts/Rufina-Regular.ttf") format('truetype');
}

i {
    cursor: pointer;
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
    position: relative;
}

nav p {
    margin-left: 30px;
    align-self: center;
}

nav .menu-hamburger {
    display: flex;
    gap: 20px;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
}

nav .menu-hamburger.ul {
    padding: 0;
    list-style-type: none;
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

.contain-item {
    display: flex !important;
    flex-direction: row;
    align-items: center;
}

.contain-item li {
    margin: 0;
}

.link-basket {
    color: black;
    position: relative;
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
        color: white;
    }

    a:hover::after {
        transform: scaleX(1);
    }
    li {
        font-size: 18px;
    }
    nav .menu-hamburger {
        margin-right: 0;
    }

}

</style>
