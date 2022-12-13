<template>
  <div>
    <img :src="getImageUrl(image)" alt="sauce">
    <p class="title">{{title}}</p>
    <p class="text">{{text}}</p>
  </div>
</template>

<script>
export default {
  name: "SaucesComponent",
  setup() {
    const getImageUrl = (name) => {
      return new URL(`../../assets/image/${name}`, import.meta.url).href
    }
    return { getImageUrl }
  },
  props:{
    title:String,
    text:String,
    image:String
  }
}
</script>

<style scoped>
img{
  height: 60px;
  width: 60px;
}
div{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
div .title{
  font-family: Rufina, sans-serif;
  font-weight: 700;
  font-size: 20px;
  margin: 0;
}
div .text{
  font-family: Lato, sans-serif;
  font-weight: 400;
  font-size: 13px;
  margin: 10px 0;
}

</style>