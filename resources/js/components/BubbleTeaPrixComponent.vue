<template>
  <div class="content">
    <div class="containerText">
      <p>{{ title }}</p>
      <p class="prix"><span>Prix</span>{{ prix }}</p>
    </div>
    <div class="contentImage">
      <img :src="image" alt="bubbleTea">
    </div>
  </div>
</template>

<script>
import imageBubbleTea from "../../assets/image/imageBubbleTea.png"

export default {
  name: "BubbleTeaPrixComponent",
  props: {
    title: String,
    prix: String,
  },
  data() {
    return {
      image: imageBubbleTea
    }
  }
}
</script>

<style scoped>
p {
  font-family: Rufina, sans-serif;
  font-weight: 700;
  margin: 0;
  font-size: 18px;
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

img {
  width: 66px;
  height: 100px;
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
/*@media screen and (min-width: 650px){*/
/*  p{*/
/*    font-size: 25px;*/
/*  }*/
/*  img{*/
/*    width: 86px;*/
/*    height: 120px;*/
/*  }*/
/*  span{*/
/*    font-size: 15px;*/
/*  }*/
/*}*/
@media screen and (min-width: 900px){
  .content{
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