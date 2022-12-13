<template>
  <div>
    <img :src="getImageUrl(image)" alt="logo_food">
    <div>
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
  justify-content: space-between;
  height: 100px;
}

img {
  height: 50px;
}

p {
  margin: 0;
}
.title{
  font-family: Rufina, sans-serif;
  font-weight: 700;
  font-size: 16px;
}
.text{
  font-family: Lato, sans-serif;
  font-weight: 400;
  font-size: 13px;
}
</style>