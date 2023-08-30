<template>
    <section>
        <div class="modale-overlay" v-show="modal" @click="modal = false"></div>
        <div class="contentTitle">
            <h2>Bubble Teas</h2>
            <p class="emporter">Uniquement à emporter</p>
        </div>
        <div class="container">
            <bubble-tea-prix-component v-for="(value,index) in menu" :key="index" @eventChild="event($event)"
                                       @eventChildModal="modal = $event"
                                       :id="value.id"
                                       :name="`${value.name}`"
                                       :size="value.size"
                                       :prix="value.price"
                                       :index="index"
                                       :length="menu.length"
                                       :class="[(index+1) % 2 === 1 ? 'border' : '', index === 0 ? 'border' : '']"

            >
            </bubble-tea-prix-component>
        </div>
        <div v-if="modal" class="modal-content">
            <modal-bubble-component :choice="choice" @eventChildModals="modal = $event"></modal-bubble-component>
        </div>
    </section>
</template>

<script>
import bubbleTeaPrixComponent from "../BubbleTeaPrixComponent.vue";
import modalBubbleComponent from "@/components/modal/ModalBubbleComponent.vue";

export default {
    name: "BubbleTeaComponent",
    components: {
        bubbleTeaPrixComponent,
        modalBubbleComponent,
    },
    props: {
        menu: Array,
    },
    data() {
        return {
            modal: false,
            tata: null,
            floutage: "floutage",
            menus: this.menu,
            choice: [],
        }
    },
    mounted() {

    },
    methods: {
        event(e) {
            console.log(e, "le e");
            this.choice = e;
        },
        test() {
            console.log("hey");
            this.modal = true;
        },
    }
}
</script>

<style scoped>
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

/*.floutage{*/
/*  filter: blur(28px);*/
/*}*/

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
        /*display: flex;*/
        /*justify-content: space-around;*/
    }

    .border {
        border-right: 2px dashed black;
    }

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
