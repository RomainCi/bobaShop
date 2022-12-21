<template>
  <section>
    <div class="contentTitle">
      <h2>Nos Bubble Tea à l'unité</h2>
      <p class="emporter">Uniquement à emporter</p>
    </div>
    <div class="container">
      <bubble-tea-prix-component class="border" title="Petit Bubble Tea 500ml" prix="5,50€"></bubble-tea-prix-component>
      <bubble-tea-prix-component title="Grand Bubble Tea 700ml" prix="6,60€"></bubble-tea-prix-component>
    </div>
  </section>
</template>

<script>
import bubbleTeaPrixComponent from "../BubbleTeaPrixComponent.vue";

export default {
  name: "BubbleTeaComponent",
  components: {
    bubbleTeaPrixComponent,
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

@media screen and (min-width: 600px) {
  .container{
    width: 540px;
    margin-right: auto;
    margin-left: auto;
  }
  h2{
    font-size: 30px;
  }
}


@media screen and (min-width: 900px) {
  .container {
    flex-wrap: nowrap;
    width: 800px;
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
  .container{
    width: 1000px;
  }
  h2 {
    font-size: 40px;
  }
  .emporter {
    font-size: 15px;
  }
}
</style>