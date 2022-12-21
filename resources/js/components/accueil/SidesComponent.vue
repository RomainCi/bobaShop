<template>
  <section>
    <div class="contentTitle">
      <h2>Les sides</h2>
    </div>
    <div class="container">
      <div class="containerTitleBis">
      </div>
      <div class="test">
        <div class="contentCardSides">
          <card-sides-component class="cardSides" title="Humitas" text="Galette de maïs, oignons et basilic enveloppés dans une feuille de bananier
cuite à la vapeur."
                                image="dimSum.png">

          </card-sides-component>
          <card-sides-component class="cardSides" title="Empanadas"
                                text="Chausson de viande hachée, oignons, oeuf, olive et raisin sec"
                                image="dimSum.png">

          </card-sides-component>
        </div>
        <card-sides-component class="cardSides" title="Dim Sums" text="Raviole asiatique de choux chinois, oignons, carottes, shiitake et vermicelle
de riz."
                              image="dimSum.png">

        </card-sides-component>
      </div>
      <div class="test bis">
        <div class="containerTitle">
          <h2>Les sides</h2>
        </div>
        <card-sides-component class="cardSides" title="Onigiri" text="Boule de riz farci au thon et mayonnaise maison."
                              image="dimSum.png">

        </card-sides-component>
        <card-sides-component class="cardSides" title="Mochis" text="Dessert asiatique réalisé avec une pâte de riz gluant farci de glace ou
confiture de lait"
                              image="dimSum.png">

        </card-sides-component>
      </div>
      <img class="empanadas" :src="empanadas" alt="logo_empanadas">
      <img class="empanadas2" :src="empanadas2" alt="logo_empanadas">
    </div>
  </section>
</template>

<script>
import CardSidesComponent from "../../components/CardSidesComponent.vue";
import empanadas from "../../../assets/image/back-1 4.png"
import empanadas2 from "../../../assets/image/back-1 5.png"

export default {
  name: "SidesComponent",
  components: {
    CardSidesComponent,
  },
  data() {
    return {
      empanadas: empanadas,
      empanadas2: empanadas2,
    }
  }
}
</script>

<style scoped>
section {
  position: relative;
}

.container {
  padding-bottom: 90px;
  padding-right: 20px;
  padding-left: 20px;
  border: 3px solid #B66A54;
  position: relative;
  z-index: 4;
  margin: 30px 30px 20px;
}

.contentTitle {
  display: flex;
  height: 60px;
  position: absolute;
  background: #EBF0E4;
  top: 30px;
  width: 100%;
  margin-right: 30px;
  z-index: 1;
  justify-content: center;
  align-items: center;
}

.containerTitleBis {
  width: 100%;
  height: 90px;
}

.containerTitle h2 {
  display: none;
}

h2 {
  font-family: Rufina, sans-serif;
  font-weight: 700;
  font-size: 25px;
  text-align: center;
  margin: 10px 0 10px 0;
}

img {
  height: 70px;
  position: absolute;
  bottom: -20px;
  right: 30px;
  z-index: 10;
  background: white;
}

.empanadas2 {
  right: 90px;
  bottom: -20px;
}

@media screen and (min-width: 600px) {
  .container {
    width: 500px;
    margin-right: auto;
    margin-left: auto;
  }

  h2 {
    font-size: 30px;
  }
}

@media screen and (min-width: 900px) {
  .container {
    display: flex;
    justify-content: space-around;
    align-items: start;
    gap: 30px;
    width: 760px;
  }

  .containerTitleBis {
    display: none;
  }

  .test {
    width: 50%;
  }

  .containerTitle {
    background-color: #EBF0E4;
    height: 100%;
    width: 100%;
    margin-top: 30px;
  }

  .containerTitle h2 {
    margin: 0;
    padding-top: 20px;
    padding-bottom: 20px;
    display: block;
    font-size: 30px;
  }

  .contentTitle {
    display: none;
  }

  img {
    height: 205px;
    right: 40px;
    bottom: 190px;
  }

  .empanadas2 {
    bottom: 60px;
    right: 205px;
  }
}

@media screen and (min-width: 1300px) {
  .container {
    width: 960px;
  }

  .containerTitle h2 {
    font-size: 35px;
  }
}
</style>