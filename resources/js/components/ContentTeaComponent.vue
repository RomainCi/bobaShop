<template>
  <div class="contentTea">
    <img :src="getImageUrl(image)" alt="épice">
    <p>{{text}}</p>
  </div>
</template>

<script>
export default {
  name: "ContentTeaComponent",
  setup() {
    const getImageUrl = (name) => {
      return new URL(`../../assets/image/${name}`, import.meta.url).href
    }
    return { getImageUrl }
  },
  props:{
    text:String,
    image:String,
  },
}
</script>

<style scoped>
img{
  height: 60px;
  width: 60px;
}
.contentTea{
  display: flex;
  flex-direction: column;
  align-items: center;
}
p{
  font-family: Lato, sans-serif;
  font-size: 13px;
}
</style>