<template>
  <div class="container">
    <div class="contentLogo" :class="displayContent">
      <img class="logo" :src="getImageUrl(logo)" alt="logo_food">
      <h2>{{ title }}</h2>
      <div class="box"></div>
    </div>
    <div class="contentQuestion" :class="contentQuestionReverse">
      <div class="contentImage" :class="contentImageStart">
        <img class="image" :src="getImageUrl(image)" alt="photo_nourriture">
      </div>
      <div class="array">
        <div v-for="(tableau,index) in tableaux" :key="index">
          <div>
            <p class="question">{{ tableau.element.question }}</p>
            <p class="answer">{{ tableau.element.answer }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "QuestionComponent",
  setup() {
    const getImageUrl = (name) => {
      return new URL(`../../assets/image/${name}`, import.meta.url).href
    }
    return {getImageUrl}
  },
  props: {
    title: String,
    image: String,
    tableaux: Array,
    logo: String,
    logoRight: String,
    contentQuestionReverse: String,
    contentImageStart: String,
  },
  data() {
    return {
      displayContent: this.logoRight,
    }
  }
}
</script>

<style scoped>
.contentImage {
  display: flex;
  justify-content: center;
}

.image {
  width: 80%;
  max-width: 300px;
  align-self: center;
}

.contentQuestion {
  display: flex;
  flex-direction: column;
}

.logo {
  width: 50px;
}

.box {
  width: 50px;
  height: 20px;
}

.contentLogo {
  display: flex;
  justify-content: space-around;
  width: 100%;
  align-items: center;
  background-color: #EBF0E4;
  margin-bottom: 40px;
}

.logoRight {
  flex-direction: row-reverse;
}

.contentLogo h2 {
  font-family: Rufina, sans-serif;
  font-size: 25px;
  font-weight: 700;
}

.question {
  font-family: Rufina, sans-serif;
  font-size: 19px;
  font-weight: 700;
  text-align: center;
  width: 76%;
  margin-left: auto;
  margin-right: auto;
}

.answer {
  font-family: Lato, sans-serif;
  font-size: 15px;
  font-weight: 400;
  letter-spacing:1px;
}

@media screen and (min-width: 600px) {
  .container {
    width: 500px;
    margin-right: auto;
    margin-left: auto;
  }
}

@media screen and (min-width: 900px) {
  .contentQuestion {
    display: flex;
    flex-direction: row-reverse;
    margin-bottom: 20px;
    align-items: center;
    justify-content: space-around;
  }

  .container {
    width: 800px;
  }

  .logo {
    width: 90px;
  }

  .box {
    width: 90px;
  }

  .array {
    width: 50%;
    display: flex;
    flex-direction: column;
  }

  .contentImage {
    width: 50%;
    display: flex;
    justify-content: end;
  }

  .contentQuestionReverse {
    flex-direction: row;
  }

  .contentImageStart {
    justify-content: start;
  }

  .contentLogo h2 {
    font-size: 30px;
  }
}

@media screen and (min-width: 1300px) {
  .container {
    width: 1000px;
  }

  .answer {
    font-size: 17px;
    letter-spacing:1px;
  }
  .question{
    font-size: 25px;
  }
  .contentLogo h2 {
    font-size: 35px;
  }
  .logo{
    width: 110px;
  }
  .box{
    width: 110px;
  }
}
</style>