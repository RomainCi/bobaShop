<template>
  <section>
    <div class="containerBack" :style="{'background-image': `url(${backQui})`,}">
      <h1>FAQ</h1>
    </div>
  </section>
  <section class="containerQuestion">
    <question-component image="bobashopresize-composer.avif"
                        logo="back-1 5.avif"
                        title="Bubble Tea"
                        :tableaux="question1">

    </question-component>
    <question-component image="bobashopresize-3formules.avif"
                        logo="back-1 5.avif"
                        logoRight="logoRight"
                        title="Menu"
                        :tableaux="question2"
                        contentQuestionReverse="contentQuestionReverse"
                        contentImageStart="contentImageStart">
    </question-component>
    <question-component image="bobashopresize-huminatas.avif"
                        logo="back-1 5.avif"
                        title="Plat"
                        :tableaux="question3">
    </question-component>
  </section>
</template>

<script>
import backgroundFaqDesktop from "../../../assets/image/faqView/backgroundFaqDesktop.avif"
import backgroundFaqMobile from "../../../assets/image/faqView/backgroundFaqMobile.avif"
import QuestionComponent from "../QuestionComponent.vue";

export default {
  name: "FaqComponent",
  components: {
    QuestionComponent,
  },
  mounted() {
    if (document.documentElement.scrollWidth > 550) {
      this.backQui = this.backgroundFaqDesktop;
    }else{
      this.backQui = this.backgroundFaqMobile;
    }
  },
  data() {
    return {
      backQui: "",
      backgroundFaqDesktop,
      backgroundFaqMobile,
      question1: [
        {
          element: {
            question: "Comment je peux composer un bubble tea ?",
            answer: "Tout d'abord, vous choisissez la taille (50/70 cl), le type de thé (noir/jasmin/vert), le sirop et finalement les perles."
          }
        },
      ],
      question2: [
        {
          element: {
            question: "Quelle est la différence entre les trois formules ?",
            answer: "Dans la petite formule, vous pouvez choisir une option de plat, dans la moyenne, vous pourrez choisir deux plats et la grande trois plats."
          }
        },
      ],
      question3: [
        {
          element: {
            question: "Combien y a-t-il d’empanadas dans une portion ?",
            answer: "Il y a 3 petites empanadas par portion"
          }
        },
        {
          element: {
            question: "Est ce que vous proposez des plats véganes ?",
            answer: " Vous aurez le choix entre des dim sums ou des humitas."
          }
        },
      ]
    }
  }
}
</script>

<style lang="scss" scoped>
.containerBack {
  height: 60vh;
  background-size: cover;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background-position: center;
}

.containerBack h1 {
  margin: 0;
  font-family: Rufina, sans-serif;
  font-size: 30px;
  color: white;
  font-weight: 700;
}

.containerBack p {
  font-family: Rufina, sans-serif;
  color: white;
  font-weight: 700;
}

.containerQuestion {
  margin-left: 30px;
  margin-right: 30px;
  padding-bottom: 20px;
  padding-top: 20px;
}

@media screen and (min-width: 600px) {
  .containerBack h1 {
    font-size: 40px;
  }
}

@media screen and (min-width: 900px) {
  .containerBack {
    height: 91.5vh;
  }
}

@media screen and (min-width: 1300px) {
  .containerBack h1 {
    font-size: 50px;
  }
}
</style>
