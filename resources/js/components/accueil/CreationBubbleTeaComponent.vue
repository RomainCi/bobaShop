<template>
  <section>
    <div class="contentTitle">
      <h2>Créez votre Bubble Tea</h2>
      <p>Au choix : 1 thé + un gout perle</p>
    </div>
    <div class="container">
      <div class="containerTitle">
      </div>
      <div class="containerTea">
        <content-tea-component text="Gout du thé" image="spices1.png"></content-tea-component>
        <content-tea-component text="Gout du thé" image="spices1.png"></content-tea-component>
        <content-tea-component text="Gout du thé" image="spices1.png"></content-tea-component>
      </div>
      <div class="containerPerle">
        <perle-component text="fraise" color="red"></perle-component>
        <perle-component text="cerise" color="#D0FFB2"></perle-component>
        <perle-component text="pomme" color="#EBFF00"></perle-component>
        <perle-component text="pomme" color="#EBFF00"></perle-component>
        <perle-component text="pomme" color="#EBFF00"></perle-component>
        <perle-component text="pomme" color="#EBFF00"></perle-component>
        <perle-component text="pomme" color="#EBFF00"></perle-component>
      </div>
    </div>
  </section>
</template>

<script>
import PerleComponent from "../../components/PerleComponent.vue";
import ContentTeaComponent from "../../components/ContentTeaComponent.vue";

export default {
  name: "CreationBubbleTeaComponent",
  components: {
    PerleComponent,
    ContentTeaComponent,
  },
  data() {
    return {}
  }
}
</script>

<style lang="scss" scoped>
section {
  position: relative;
}

.container {
  padding-bottom: 20px;
  padding-right: 20px;
  padding-left: 20px;
  margin-left: 30px;
  margin-top: 30px;
  margin-right: 30px;
  border: 3px solid #B66A54;
  position: relative;
  z-index: 4;
}

h2 {
  font-family: Rufina, sans-serif;
  font-weight: 700;
  font-size: 25px;
  text-align: center;
  margin: 10px 0 10px 0;
}

p {
  font-family: Rufina, sans-serif;
  font-size: 13px;
  text-align: center;
}

.containerTitle {
  width: 100%;
  height: 150px;
  border-bottom: 1px dashed black;
}

.contentTitle {
  height: 100px;
  position: absolute;
  background: #EBF0E4;
  top: 30px;
  width: 100%;
  margin-right: 30px;
  z-index: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.containerTea {
  display: flex;
  justify-content: space-between;
  padding-top: 30px;
  padding-bottom: 30px;
  align-items: center;
  border-bottom: 1px dashed black;
}

.containerPerle {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
  justify-content: space-between;
  padding-top: 30px;
  align-items: center;
}
</style>