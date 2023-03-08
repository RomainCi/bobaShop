<template>
  <div class="contentTea">
    <img :src="getImageUrl(image)" alt="épice">
    <p>{{ text }}</p>
  </div>
</template>

<script>
export default {
  name: "ContentTeaComponent",
  setup() {
    const getImageUrl = (name) => {
      return new URL(`../../assets/image/${name}`, import.meta.url).href
    }
    return {getImageUrl}
  },
  props: {
    text: String,
    image: String,
  },
}
</script>

<style scoped>
img {
  height: 60px;
  width: 60px;
}

.contentTea {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 70px;
  height: 110px;
}

p {
  font-family: Lato, sans-serif;
  font-size: 13px;
  text-align: center;
}




@media screen and (min-width: 900px) {
  img {
    height: 40px;
    width: 40px;
  }

  .contentTea {
    width: 60px;
    height: 100px;
  }

  p {
    font-size: 11px;
  }
}


@media screen and (min-width: 1300px) {
  img {
    height: 50px;
    width: 50px;
  }

  .contentTea {
    width: 70px;
    height: 110px;
  }

}
</style>