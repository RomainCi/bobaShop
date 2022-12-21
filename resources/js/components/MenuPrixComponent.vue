<template>
  <div class="content">
    <div class="containerText">
      <p>{{ menu }}</p>
      <p class="prix"><span>Prix</span> {{ prix }}</p>
    </div>
    <div class="contentImage">
      <img :src="image" alt="bubbleTea">
      <p>{{ side }}</p>
    </div>
  </div>
</template>

<script>
import imageBubbleTea from "../../assets/image/imageBubbleTea.png"

export default {
  name: "MenuPrixComponent",
  props: {
    menu: String,
    prix: String,
    side: String
  },
  data() {
    return {
      image: imageBubbleTea
    }
  }
}
</script>

<style lang="scss" scoped>
p {
  font-family: Rufina, sans-serif;
  font-weight: 700;
  margin: 0;
  font-size: 18px;
}

img {
  width: 66px;
  height: 100px;
}

.content {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  border-bottom: 1px dashed black;
  padding: 15px;
}

.contentImage {
  display: flex;
  align-items: flex-end;
}

.containerText {
  display: flex;
  flex-direction: column;
}

.containerText .prix {
  align-self: flex-end;
  display: flex;
}

span {
  font-size: 10px;
  align-self: center;
  margin-right: 5px;
  font-family: Lato, sans-serif;
  font-weight: 400;
}

//@media screen and (min-width: 650px) {
//  span {
//    font-size: 15px;
//  }
//  img {
//    height: 120px;
//    width: 86px;
//  }
//  p {
//    font-size: 25px;
//  }
//}

@media screen and (min-width: 900px) {
  .content {
    border-bottom: none;
  }
  span {
    font-size: 10px;
  }
  img {
    width: 66px;
    height: 100px;
  }
  p {
    font-size: 18px;
  }
}
@media screen and (min-width: 1300px){
  span {
    font-size: 15px;
  }
  img {
    height: 120px;
    width: 86px;
  }
  p {
    font-size: 25px;
  }
}
</style>