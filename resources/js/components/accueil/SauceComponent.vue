<template>
  <section>
    <div class="containerMain">
      <div class="container">
        <div class="containerTitle">
          <h2>Les sauces</h2>
          <p>Tous nos menus sont accompagnés d'une sauce</p>
        </div>
        <div class="containerSauce">
          <sauces-component title="Sauce 1" text="piment,huile" image="spices1.png"></sauces-component>
          <sauces-component title="Sauce 1" text="piment,huile" image="spices1.png"></sauces-component>
          <sauces-component title="Sauce 1" text="piment,huile" image="spices1.png"></sauces-component>
        </div>
        <img :src="handSauce" alt="main_sauce">
      </div>
    </div>
    <div class="containerLogo">
      <logo-food-component title="Onigiri" prix="0€" image="back-1 8.png"></logo-food-component>
      <logo-food-component title="Empanadas" prix="0€" image="back-1 4.png"></logo-food-component>
      <logo-food-component title="Dim Sum" prix="0€" image="back-1 4.png"></logo-food-component>
      <logo-food-component title="Mochis" prix="0€" image="logoMochis.png"></logo-food-component>
    </div>
  </section>
</template>

<script>
import SaucesComponent from "../../components/SaucesComponent.vue";
import LogoFoodComponent from "../../components/LogoFoodComponent.vue";
import handSauce from "../../../assets/image/handSauce.png"

export default {
  name: "SauceComponent",
  components: {
    SaucesComponent,
    LogoFoodComponent
  },
  data() {
    return {
      handSauce,
    }
  }
}
</script>

<style scoped>
.containerMain {
  background: #EBF0E4;
}

.container {
  margin-right: 30px;
  margin-left: 30px;
  margin-top: 30px;
  position: relative;
  z-index: 4;
  display: flex;
  flex-direction: column;
  padding-bottom: 20px;
  padding-top: 20px;
}

.containerTitle {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.containerTitle p {
  font-size: 13px;
  text-align: center;
  font-family: Lato, sans-serif;
  font-weight: 400;
  margin: 10px 0 40px;
}

.containerTitle h2 {
  font-size: 30px;
  font-family: Rufina, sans-serif;
  font-weight: 700;
  margin: 0;
}

.containerSauce {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
}

img {
  width: 60%;
  align-self: center;
  margin-top: 20px;
}

.containerLogo {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 10px;
  margin: 20px 30px;
}
</style>