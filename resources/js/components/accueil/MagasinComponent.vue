<template>
  <section>
    <div class="containerMain">
      <div class="container1">
        <h1>Votre magasin <br>de Bubble Tea <br>à Strasbourg</h1>
        <img class="food" :src="imageFood" alt="empanadas">
      </div>
      <div class="container">
        <div class="content">
          <img class="bubbleTea" :src="bubbleTea" alt="bubbleTea">
          <p>Née d'Amérique du Sud et d'Asie</p>
        </div>
        <img class="logo" :src="imageLogoRed" alt="imageLogo">
      </div>
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

.containerMain {
  margin-right: 30px;
  margin-left: 30px;
}

.container1 {
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  position: relative;
  padding-top: 30px;
  margin-left: auto;
  margin-right: auto;
  align-items: center;
  //width: 100%;
  //background-color: red;
  max-width: 400px;
}

h1 {
  font-size: 30px;
  color: white;
  margin: 0 0 0 0;
  position: absolute;
  top: 30px;
  font-family: Rufina, sans-serif;
  font-weight: 700;
  max-font-size: 25px;
  left: 0;
}

p {
  font-family: Rufina, sans-serif;
  font-weight: 700;
  font-size: 18px;
  margin-bottom: 0;
  align-self: center;
}

.image {
  background-image: url("../../../assets/image/BOBApremierepartie-56 1.png");
  height: 300px;
  background-size: cover;
  width: 400px;
  position: relative;
}

.container {
  display: flex;
  justify-content: space-between;
  margin-top: 160px;
}

.content {
  color: white;
  align-self: center;
  font-size: 20px;
  width: 200px;
}

.container img {
  align-self: center;
}

.food {
  align-self: end;
  width: 250px;
}

.container .bubbleTea {
  width: 200px;
}

.logo {
  height: 196px;
}

@media screen and (min-width: 600px) {
  .containerMain {
    width: 500px;
    margin-right: auto;
    margin-left: auto;
  }
  .container1{
    max-width: 100%;
  }
  h1{
    font-size: 40Px;
  }
}
@media screen and (min-width: 900px) {
  .containerMain{
    width: 800px;
  }
  .food{
    width: 500px;
    height: 350px;
  }
  .container1{
    max-width: 80%;
  }
  .container .bubbleTea{
    width: 300px;
  }
  .logo{
    height: 267px;
  }
}
@media screen and (min-width: 1300px){
  .containerMain{
    width: 1000px;
  }
  h1{
    font-size: 50px;
  }
  .food{
    width: 600px;
    height: 400px;
  }
  .container{
    max-width: 80%;
    margin-left: auto;
    margin-right: auto;
  }
  p{
    font-size: 25px;
  }
}
</style>