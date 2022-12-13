<template>
  <section>
    <div class="contentTitle">
      <h2>Les sides</h2>
    </div>
    <div class="container">
      <div class="containerTitle"></div>
      <card-sides-component title="DimSum" prix="12€" text="Végétarien, au boeuf ou au poulet"
                            image="dimSum.png">

      </card-sides-component>
      <card-sides-component title="DimSum" prix="12€" text="Végétarien, au boeuf ou au poulet"
                            image="dimSum.png">

      </card-sides-component>
    </div>
    <img class="empanadas" :src="empanadas" alt="logo_empanadas">
    <img class="empanadas2" :src="empanadas2" alt="logo_empanadas">
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
  margin-left: 30px;
  margin-right: 30px;
  margin-top: 30px;
  border: 3px solid #B66A54;
  position: relative;
  z-index: 4;
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

.containerTitle {
  width: 100%;
  height: 90px;
  /*border-bottom: 1px dashed black;*/
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
  left: 48px;
  z-index: 10;
  background: white;
}

.empanadas2 {
  left: 120px
}
</style>