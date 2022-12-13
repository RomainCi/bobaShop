<template>
  <div>
    <img :src="getImageUrl(image)" alt="logo_food">
    <div class="contentText">
      <p class="title">{{ title }}</p>
      <p class="text">Prix à l'unité : {{ prix }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "LogoFoodComponent",
  setup() {
    const getImageUrl = (name) => {
      return new URL(`../../assets/image/${name}`, import.meta.url).href
    }
    return {getImageUrl}
  },
  props: {
    title: String,
    prix: String,
    image: String
  }
}
</script>

<style scoped>
div {
  display: flex;
  flex-direction: column;
  align-items: center;
}

img {
  height: 40px;
}

p {
  margin: 0;
}
.contentText{
  margin-top: 10px;
}
.title{
  font-family: Rufina, sans-serif;
  font-weight: 700;
  font-size: 14px;
}
.text{
  font-family: Lato, sans-serif;
  font-weight: 400;
  font-size: 10px;
  margin-top:5px;
}
</style>