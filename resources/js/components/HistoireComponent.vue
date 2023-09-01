<template>
  <div class="container" :class="containerReversed">
    <div class="contentText">
      <div class="contentLogo" :class="displayContent">
        <img class="logo" :src="getImageUrl(logo)" alt="logo_nourriture">
        <h2>{{ title }}</h2>
        <div class="box"></div>
      </div>
      <p>{{ text }}</p>
    </div>
    <div class="contentImage" :class="contentImageStarted">
      <img class="image" :src="getImageUrl(image)" alt="photo_nourriture">
    </div>
  </div>
</template>

<script>
export default {
  name: "HistoireComponent",
  setup() {
    const getImageUrl = (name) => {
        console.log(name);
      return new URL(`../../assets/image/QuiView/${name}`, import.meta.url).href
    }
    return {getImageUrl}
  },
  props: {
    text: String,
    title: String,
    image: String,
    logo: String,
    logoRight: String,
    containerReverse: String,
    contentImageStart: String,
  },
  data() {
    return {
      displayContent: this.logoRight,
      containerReversed: this.containerReverse,
      contentImageStarted: this.contentImageStart,
    }
  }
}
</script>

<style scoped>
.contentText {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.contentText .contentLogo h2 {
  font-family: Rufina, sans-serif;
  font-weight: 700;
  font-size: 25px;
}

.contentText p {
  font-family: Lato, sans-serif;
  font-weight: 400;
  font-size: 15px;
  letter-spacing:1px;
  white-space: pre-line;

}

.contentImage {
  display: flex;
  justify-content: center;
}

.image {
  width: 80%;
  max-width: 300px;
  align-self: center;
}

.contentLogo {
  display: flex;
  justify-content: space-around;
  width: 100%;
  align-items: center;
  background-color: #EBF0E4;
}

.contentLogo img {
  width: 50px;
}

.box {
  width: 50px;
  height: 20px;
}

.logoRight {
  flex-direction: row-reverse;
}

@media screen and (min-width: 600px) {
  .image {
    width: 60%;
  }
}

@media screen and (min-width: 900px) {
  .container {
    display: flex;
    gap: 30px;
    margin-bottom: 20px;
    align-items: center;
    justify-content: space-around;
  }

  .contentText {
    width: 50%;
  }

  .contentImage {
    width: 50%;
    display: flex;
    justify-content: end;
  }

  .contentImageStart {
    justify-content: start;
  }

  .containerReverse {
    flex-direction: row-reverse;
  }

}

@media screen and (min-width: 1300px) {
  .contentText p {
    font-size: 17px;
    letter-spacing: 1px;
  }

  .contentText .contentLogo h2 {
    font-size: 30px;
  }

  .contentLogo img {
    width: 90px;
  }

  .box {
    width: 90px;
    height: 20px;
  }
}

</style>
