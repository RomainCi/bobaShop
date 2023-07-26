<template>
  <section>
    <div class="contentTitle">
      <h2>Créez votre Bubble Tea</h2>
      <p>Au choix : 1 thé + 1 sirop + 1 gout perle</p>
    </div>
    <div class="container">
      <div class="containerTitleBubble">
        <div class="containerTitle">
          <h2>Créez votre Bubble Tea</h2>
          <p>Au choix : 1 thé + 1 sirop + 1 gout perle</p>
        </div>
      </div>
      <div class="test">
        <p class="title">Les thé</p>
        <div class="containerTea">
          <content-tea-component v-for="(value,index) in teas" :key="index" :text="value.name"
                                 :image="value.image_url"></content-tea-component>

        </div>
      </div>
      <div class="tata">
        <p class="title">Les sirops</p>
        <div class="containerPerle borderRight">
          <perle-component v-for="(value,index) in syrups" :key="index" :text="value.name" :color="value.color"></perle-component>

        </div>
      </div>
      <div class="tata">
        <p class="title">Les perles</p>
        <div class="containerPerle borderLeft">
          <perle-component v-for="(value,index) in pearls" :key="index" :text="value.name" :color="value.color"></perle-component>

        </div>
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
  props: {
    teas: Array,
    pearls: Array,
    syrups:Array,
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

.fakePerle {
  display: none;
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

.containerTitle h2 {
  display: none;
}

.containerTitle p {
  display: none;
}

.title {
  font-family: Rufina, sans-serif;
  font-size: 20px;
  font-weight: 700;
}

@media screen and (max-width: 380px) {
  .containerPerle {
    gap: 10px;
  }
}

@media screen and (min-width: 400px) {
  .containerPerle {
    gap: 10px;
  }
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
  //.tata{
  //  display: flex;
  //  flex-direction: column;
  //}
  .containerTitle h2 {
    font-size: 25px;
    margin-left: 10px;
    margin-right: 10px;
    display: inline-block;
  }
  .containerTitle p {
    font-size: 13px;
    display: inline-block;
  }
  .contentTitle {
    display: none;
  }
  section {
    padding: 0;
    margin: 0;
  }

  .container {
    display: flex;
    width: 800px;
    padding-right: 0;
    padding-left: 0;
    margin-right: auto;
    margin-left: auto;
    align-items: stretch;
  }
  .containerTitleBubble{
    align-self: center;
  }
  .containerTitle {
    width: 210px;
    border-bottom: none;
    background-color: #EBF0E4;
    height: 100%;
    margin-right: 20px;
    padding-left: 20px;
    padding-right: 20px;
  }
  .containerPerle {
    gap: 0;
    padding: 0 20px;
    //height: 80%;
    display: flex;
    align-items: flex-start;
  }
  .containerTea {
    flex-wrap: wrap;
    justify-content: center;
    border-bottom: none;
    border-left: 1px dashed black;
    margin: 0;
    width: 60px;
    padding: 0 20px;
    height: 80%;
  }
  .borderRight {
    border-left: 1px dashed black;
    border-right: 1px dashed black;
    max-width: 190.65px;
    height: 80%;
  }
  .borderLeft {
    //border-left: 1px dashed black;
    max-width: 190.65px;
  }
}

@media screen and (min-width: 1300px) {
  .container {
    width: 1000px;
  }
  .fakePerle {
    display: block;
    width: 70px;
    height: 110px;
  }
  .containerTitle h2 {
    font-size: 30px;
  }
  .containerPerle{
    //height: 600px;
  };
  .title {
    font-size: 25px;
  }
  .borderRight {
    border-left: 2px dashed black;
    border-right: 2px dashed black;
    min-width: 269.2px;
  }
  .borderLeft {
    //border-left: 2px dashed black;
    min-width: 269.2px;
  }
  .containerTea {
    width: 70px;
    border-left: 2px dashed black;
  }
}

</style>
