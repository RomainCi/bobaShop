<template>
  <div>
    <img :src="getImageUrl(image)" alt="nourriture">
    <p class="prix">{{ prix }}</p>
    <div class="containerText">
      <p class="title">{{ title }}</p>
      <p class="text">{{ text }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "CardSidesComponent",
  setup() {
    const getImageUrl = (name) => {
      return new URL(`../../assets/image/${name}`, import.meta.url).href
    }
    return {getImageUrl}
  },
  props: {
    prix: String,
    title: String,
    text: String,
    image: String,
  },
}
</script>

<style scoped>
div{
  margin-top: 30px;
}
img {
  width: 100%;
}

.prix {
  font-family: Rufina, sans-serif;
  font-weight: 700;
  text-align: end;
  border-bottom: 1px dashed black;
  padding-top: 5px;
  padding-bottom: 5px;
  font-size: 17px;
  margin: 0 15px;
}
.containerText{
  margin: 0 15px;
}
.containerText .title {
  font-family: Rufina, sans-serif;
  font-weight: 700;
  font-size: 25px;
  margin: 5px 0 0;
}
.containerText .text{
  font-family: Lato, sans-serif;
  font-weight: 400;
  font-size: 10px;
  margin: 5px 0 0;
}
</style>