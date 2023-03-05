<template>
  <section>
    <div class="containerBack" :style="{'background-image': `url(${backQui})`,}">
      <h1>FAQ</h1>
    </div>
  </section>
  <section class="containerQuestion">
    <question-component image="bobashopresize-composer.jpg"
                        logo="back-1 4.png"
                        title="Bubble Tea"
                        :tableaux="question1">

    </question-component>
    <question-component image="bobashopresize-3formules.jpg"
                        logo="back-1 4.png"
                        logoRight="logoRight"
                        title="Menu"
                        :tableaux="question2"
                        contentQuestionReverse="contentQuestionReverse"
                        contentImageStart="contentImageStart">
    </question-component>
    <question-component image="dimSum.png"
                        logo="back-1 4.png"
                        title="Plat"
                        :tableaux="question3">
    </question-component>
  </section>
</template>

<script>
import backQui from "../../../assets/image/backQui.png"
import QuestionComponent from "../QuestionComponent.vue";

export default {
  name: "FaqComponent",
  components: {
    QuestionComponent,
  },
  data() {
    return {
      backQui: backQui,
      question1: [
        {
          element: {
            question: "Comment je peux composer un bubble tea ?",
            answer: "Tout d'abord, vous choisissez la taille (50/70 cl), le type de thé (noir/jasmin/vert), le sirop et finalement les billes."
          }
        },
      ],
      question2: [
        {
          element: {
            question: "Quelle est la différence entre les trois formules ?",
            answer: "Dans la petite formule, vous pouvez juste choisir une option de plat, dans la moyenne, vous pourrez choisir deux plats et la grande trois plats."
          }
        },
      ],
      question3: [
        {
          element: {
            question: "Combien d’empanadas sont dans une portion?",
            answer: "Il y a 3 petites empanadas par portion"
          }
        },
        {
          element: {
            question: "Est ce que vous proposer des plats véganes ?",
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