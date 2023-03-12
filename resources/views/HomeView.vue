<template>
<!--  <div class="modal-active">-->
<!--    <div id="modal-container" v-if="showModal" :class="out" class="two" @click="closeModal">-->
<!--      <div class="modal-background">-->
<!--        <div class="modal">-->
<!--          <span @click="out = 'out', closeModal()"><i class="fa-solid fa-x"></i></span>-->
<!--          <p v-for="(value,index) in contente" :key="index">{{ value.content }}</p>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

    <div :class="content">
      <header>
        <navbar-component v-on:position="fixed = $event"></navbar-component>
      </header>

      <main :class="fixed">
        <magasin-component></magasin-component>
        <bubble-tea-component :menu="singleMenuList"></bubble-tea-component>
        <menu-component :menu="menuList"></menu-component>
        <creation-bubble-tea-component></creation-bubble-tea-component>
        <sides-component></sides-component>
      </main>

      <footer>
        <footer-component></footer-component>
      </footer>

    </div>
<!--  </div>-->
</template>

<script>
import MagasinComponent from "../js/components/accueil/MagasinComponent.vue";
import MenuComponent from "../js/components/accueil/MenuComponent.vue";
import CreationBubbleTeaComponent from "../js/components/accueil/CreationBubbleTeaComponent.vue";
import SidesComponent from "../js/components/accueil/SidesComponent.vue";
import SauceComponent from "../js/components/accueil/SauceComponent.vue";
import NavbarComponent from "../js/components/NavbarComponent.vue";
import BubbleTeaComponent from "../js/components/accueil/BubbleTeaComponent.vue";
import FooterComponent from "../js/components/FooterComponent.vue";

export default {
  name: "HomeView",
  components: {
    NavbarComponent,
    MagasinComponent,
    MenuComponent,
    CreationBubbleTeaComponent,
    SidesComponent,
    SauceComponent,
    BubbleTeaComponent,
    FooterComponent,
  },
  data() {
    return {
      fixed: "notFixed",
      singleMenuList: [],
      menuList: [],
      contente: "",
      out: "",
      showModal: "",
      content: "content",
    }
  },
  mounted() {
    this.getMenu()
    this.getContentHome();
  },
  methods: {
    closeModal() {
      this.out = "out";
      setTimeout(function () {
        this.showModal = false
      }.bind(this), 1000)
    },

    async getMenu() {
      const res = await axios.get("api/products=menu");
      const menu = res.data.menu;
      this.singleMenuList = menu.filter(menu => menu.sides === 0);
      this.menuList = menu.filter(menu => menu.sides !== 0);
    },
    async getContentHome() {
      const res = await axios.get("api/home/content");
      if(res.status === 200 && res.data.content.length !== 0){
        this.showModal = true;
        this.contente = res.data.content;
      }else{
        console.log(res.data.content,"hello");
        this.showModal = false;
      }
    }
  }
}
</script>

<style lang="scss" scoped>
#modal-container {
  position: fixed;
  display: table;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  transform: scale(0);
  z-index: 30;

  &.two {
    transform: scale(1);

    .modal-background {
      background: rgba(0, 0, 0, .0);
      animation: fadeIn .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;

      .modal {
        opacity: 0;
        animation: scaleUp .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
      }
    }

    + .content {
      animation: scaleBack .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
    }

    &.out {
      animation: quickScaleDown 0s .5s linear forwards;

      .modal-background {
        animation: fadeOut .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;

        .modal {
          animation: scaleDown .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
      }

      + .content {
        animation: scaleForward .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
      }
    }
  }

  .modal-background {
    display: table-cell;
    background: rgba(0, 0, 0, .8);
    text-align: center;
    vertical-align: middle;

    .modal {
      background: white;
      padding: 10px;
      display: inline-block;
      border-radius: 3px;
      font-weight: 300;
      position: relative;
      width: 200px;

      h2 {
        font-size: 25px;
        line-height: 25px;
        margin-bottom: 15px;
      }

      p {
        font-size: 18px;
        line-height: 22px;
      }

      .modal-svg {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        border-radius: 3px;

        rect {
          stroke: #fff;
          stroke-width: 2px;
          stroke-dasharray: 778;
          stroke-dashoffset: 778;
        }
      }
    }
  }
}

.modal-active {
  overflow: hidden;
}

.content {
  min-height: 100%;
  height: 100%;
  background: white;
  position: relative;
  z-index: 0;
}
span{
  display: flex;
  justify-content: flex-end;
}

@keyframes fadeIn {
  0% {
    background: rgba(0, 0, 0, .0);
  }
  100% {
    background: rgba(0, 0, 0, .7);
  }
}

@keyframes fadeOut {
  0% {
    background: rgba(0, 0, 0, .7);
  }
  100% {
    background: rgba(0, 0, 0, .0);
  }
}

@keyframes scaleUp {
  0% {
    transform: scale(.8) translateY(1000px);
    opacity: 0;
  }
  100% {
    transform: scale(1) translateY(0px);
    opacity: 1;
  }
}

@keyframes scaleDown {
  0% {
    transform: scale(1) translateY(0px);
    opacity: 1;
  }
  100% {
    transform: scale(.8) translateY(1000px);
    opacity: 0;
  }
}

@keyframes scaleBack {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(.95);
  }
}

@keyframes scaleForward {
  0% {
    transform: scale(0.85);
  }
  100% {
    transform: scale(1);
  }
}

@keyframes quickScaleDown {
  0% {
    transform: scale(1);
  }
  99.9% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}

main {
  background-color: white;
}

.fixed {
  position: fixed;
  right: 0;
  left: 0;
}
</style>