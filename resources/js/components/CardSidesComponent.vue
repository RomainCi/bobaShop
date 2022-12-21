<template>
  <div>
    <img :src="getImageUrl(image)" alt="nourriture">
    <p class="prix"></p>
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
    title: String,
    text: String,
    image: String,
  },
}
</script>

<style scoped>
div {
  margin-top: 30px;
  display: flex;
  flex-direction: column;
}

img {
  width: 100%;
  max-height: 300px;
  max-width: 350px;
  align-self: center;
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

.containerText {
  margin: 0 15px;
}

.containerText .title {
  font-family: Rufina, sans-serif;
  font-weight: 700;
  font-size: 20px;
  margin: 5px 0 0;
}

.containerText .text {
  font-family: Lato, sans-serif;
  font-weight: 400;
  font-size: 11px;
  margin: 5px 0 0;
}


@media screen and (min-width: 1300px) {
  .prix {
    border-bottom: 2px dashed black;
  }

  .containerText .text {
    font-size: 13px;
  }
  .containerText .title{
    font-size: 25px;
  }
}
</style>