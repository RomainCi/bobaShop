<template>
  <section>
    <div class="container1">
      <h1>Votre magasin <br>de Bubble Tea <br>à Strasbourg</h1>
      <img class="food" :src="imageFood" alt="empanadas">
    </div>
    <div class="container">
      <div class="content">
        <img class="bubbleTea" :src="bubbleTea" alt="bubbleTea">
        <h2>Mets d'Amérique du Sud et d'Asie</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
      </div>
      <img class="logo" :src="imageLogoRed" alt="imageLogo">
    </div>
  </section>
</template>

<script>
import imageFood from "../../../assets/image/BOBApremierepartie-56 1.png"
import bubbleTea from "../../../assets/image/bubbleTea.png"
import imageLogoRed from "../../../assets/image/imageLogoRed.png"

export default {
  name: "MagasinComponent",
  data() {
    return {
      imageFood: imageFood,
      bubbleTea: bubbleTea,
      imageLogoRed: imageLogoRed
    }
  }
}
</script>

<style lang="scss" scoped>
$backgroundColor: #EAB99F;
section {
  background-color: $backgroundColor;
  padding-bottom: 30px;
}

h1 {
  font-size: 7vw;
  color: white;
  margin: 0 0 0 0;
  position: absolute;
  top: 30px;
  font-family: Rufina, sans-serif;
  font-weight: 700;
}

h2 {
  font-family: Rufina, sans-serif;
  font-weight: 700;
  font-size: 13px;
}

.container1 {
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  position: relative;
  padding-top: 30px;
  margin-left: 30px;
  margin-right: 30px;
}

.container {
  display: flex;
  justify-content: space-between;
  padding-top: 50px;
  margin-left: 30px;
  margin-right: 30px;
}

.content {
  color: white;
  align-self: center;
  font-size: 13px;
}

.container img {
  align-self: center;
}

.food {
  width: 50vw;
  align-self: end;
}

.container .bubbleTea {
  width: 45vw;
}

.logo {
  width: 30vw;
}
</style>