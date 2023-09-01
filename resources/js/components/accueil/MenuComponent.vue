<template>
    <section>
        <div class="modale-overlay" v-show="modal" @click="modal = false"></div>
        <div class="contentTitle">
            <h2>Menus</h2>
            <p class="emporter">uniquement à emporter</p>
        </div>
        <div class="container" :class="getClass()">
            <menu-prix-component v-for="(value,index) in menu" :key="index"
                                 :prix="value.price" :menu="value.name"
                                 :size="value.size"
                                 :index="index"
                                 :length="menu.length"
                                 :lastLength="lastLength"
                                 @eventChildModal="modal = $event"
                                 @eventChild="event($event)"
                                 :id="value.id"
                                 :side="value.sides === 1 ? `+ ${value.sides} Side`: `+ ${value.sides} Sides`"
            >
            </menu-prix-component>
        </div>
        <div v-if="modal" class="modal-content">
            <modal-bubble-component :choice="choice" @eventChildModals="modal = $event"></modal-bubble-component>
        </div>
    </section>
</template>

<script>
import imageBubbleTea from "../../../assets/image/homView/imageBubbleTea.avif"
import MenuPrixComponent from "../../components/MenuPrixComponent.vue";
import ModalBubbleComponent from "../../components/modal/ModalBubbleComponent.vue";

export default {
    name: "MenuComponent",
    components: {
        MenuPrixComponent,
        ModalBubbleComponent,
    },
    props: {
        menu: Array,
    },
    data() {
        return {
            image: imageBubbleTea,
            modal: false,
            lastLength: 0,
        }
    },
    methods: {
        event(e) {
            this.choice = e;
        },
        getClass() {
            if (this.menu.length % 3 === 1) {
                this.lastLength = this.menu.length;
            }
            return this.menu.length % 3 === 1 ? "center" : "";
            // "menu.length%3 === 1 ? 'center' : ''"
        }
    }
}
</script>

<style lang="scss" scoped>
@font-face {
    font-family: 'Lato';
    font-weight: 400;
    src: url("/resources/assets/fonts/Lato-Regular.ttf") format('truetype');
}

section {
    padding-right: 30px;
    padding-left: 30px;
    background-color: white;
    padding-top: 10px;
}

.contentTitle {
    margin-bottom: 20px;
}

h2 {
    text-align: center;
    font-size: 25px;
    font-family: Rufina, sans-serif;
    font-weight: 700;
    margin-bottom: 5px;
}

.emporter {
    font-size: 10px;
    font-family: Lato, sans-serif;
    font-weight: 400;
    text-align: center;
    margin: 0;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    width: 100%;
}

.modale-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 98;
    backdrop-filter: blur(15px);
}

.modal-content {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 6px;
    z-index: 9999;
    box-shadow: -20px 20px 15px -3px rgba(0, 0, 0, 0.1);
}

@media screen and (min-width: 600px) {
    .container {
        width: 540px;
        margin-right: auto;
        margin-left: auto;
    }
    h2 {
        font-size: 30px;
    }
}

@media screen and (min-width: 900px) {
    .container {
        width: 800px;
        display: flex;
        justify-content: flex-start;
    }
    .center {
        justify-content: center;
    }
    //.border {
    //  border-right: 2px dashed black;
    //  border-left: 2px dashed black;
    //}
    h2 {
        font-size: 30px;
    }
    .emporter {
        font-size: 10px;
    }
}

@media screen and (min-width: 1300px) {
    .container {
        width: 1200px;
    }
    h2 {
        font-size: 40px;
    }
    .emporter {
        font-size: 15px;
    }
}
</style>
