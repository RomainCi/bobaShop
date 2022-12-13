<template>
  <section>
    <div class="contentTitle">
      <h2>Nos menus</h2>
      <p class="emporter">uniquement à emporter</p>
    </div>
    <div class="container">
      <menu-prix-component prix="0€" menu="Petit Menu"></menu-prix-component>
      <menu-prix-component prix="0€" menu="Menu Medium"></menu-prix-component>
      <menu-prix-component prix="0€" menu="Grand Menu"></menu-prix-component>
    </div>
  </section>
</template>

<script>
import imageBubbleTea from "../../../assets/image/imageBubbleTea.png"
import MenuPrixComponent from "../../components/MenuPrixComponent.vue";
export default {
  name: "MenuComponent",
  components:{
    MenuPrixComponent
  },
  data() {
    return {
      image: imageBubbleTea
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
  font-size: 35px;
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


</style>