<template>
  <div class="containerMain">
    <div class="contentImage">
      <img :src="bobaWhite" alt="logo">
      <div class="contentText">
        <p>©2022 Boba Shop</p>
        <p>Mention légale</p>
      </div>
      <div class="contentLogo">
        <a target="_blank" href="https://www.instagram.com/boba.shop67/?hl=fr"> <img class="insta" :src="logoInsta"
                                                                                     alt="instagram"></a>
      </div>
    </div>
    <p class="text">Intégration : RC Tech Web & Design : HBZ Communication</p>
  </div>
</template>

<script>
import bobaWhite from "../../assets/image/footerView/bobadefblanc 1.avif"
import logoInsta from "../../assets/image/footerView/VectorInsta.png"

export default {
  name: "FooterComponent",
  data() {
    return {
      bobaWhite: bobaWhite,
      logoInsta: logoInsta,
    }
  }
}
</script>

<style scoped>
.containerMain {
  background: #233000;
}

.contentImage {
  display: flex;
  justify-content: space-between;
  margin-right: 30px;
  margin-left: 30px;
  align-items: center;
  margin-bottom: 20px;
}

.contentImage img {
  height: 70px;
  margin-top: 20px;
}

.contentLogo img {
  height: 20px;
  margin-top: 20px;
}

.insta {
  margin-right: 10px;
}

.contentText {
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
  margin-top: 20px;
  margin-left: 10px;
}

.contentText p {
  margin: 0;
}

.text {
  text-align: center;
  padding-bottom: 10px;
  margin: 0 30px;
}

p {
  font-family: Lato, sans-serif;
  font-size: 14px;
  color: white;
}
</style>
