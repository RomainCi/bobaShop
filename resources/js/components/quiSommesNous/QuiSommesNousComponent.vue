<template>
    <section>
        <div class="containerBack" :style="{'background-image': `url(${backQui})`,}">
            <h1>Qui sommes-nous</h1>
        </div>
    </section>

    <section class="containerHistoire">
        <div class="contentHistoire">
            <histoire-component image="bobashopresize-histoire.avif"
                                :text="text"
                                title="Notre histoire"
                                logo="back-1 5.avif"
            ></histoire-component>
        </div>
        <div class="contentHistoire">
            <histoire-component image="bobashopresize-huminatas.avif"
                                :text="`Nos menus sont faits maison.\n\n Ils pourront varier au fil des saisons afin de vous proposer des aliments frais. Nous réalisons nos assemblages en amont et utilisons exclusivement la cuisson vapeur ou au four comme s'est réalisé traditionnellement. Ce procédé permet de préparer la commande à la minute. assurant un repas chaud et rapide à emporter. \n\nL’équipe s’engage également à proposer en permanence des recettes accessibles à différents régimes alimentaires.`"
                                title="Nos produits"
                                logo="back-1 5.avif"
                                logoRight="logoRight"
                                containerReverse="containerReverse"
                                contentImageStart="contentImageStart"

            ></histoire-component>
        </div>
        <div class="contentHistoire">
            <histoire-component image="bobashopresize-histoire.avif"
                                :text="'Situé au Passage de la Mésange, le Boba Shop est un salon de thé proposant principalement des bubble teas. Il constitue un point de vente destiné aux passants à la recherche de boissons et petits plats à emporter. \n\nÀ l’image de ses fondateurs, le Boba Shop propose des encas de fusion latino-asiatique, qui vous permettra de découvrir leurs cultures à travers des petits plats complets, rapide et de qualité.'"
                                title="Notre local"
                                logo="back-1 5.avif"
            ></histoire-component>
        </div>
    </section>
</template>

<script>
import backQuiDesktop from "../../../assets/image/QuiView/backQuiDesktop.avif";
import backQuiMobile from "../../../assets/image/QuiView/backQuiMobile.avif";
import HistoireComponent from "../../components/HistoireComponent.vue";

export default {
    name: "QuiSommesNousComponent",
    components: {
        HistoireComponent
    },
    mounted() {
        if (document.documentElement.scrollWidth > 550) {
            this.backQui = this.backQuiDesktop;
        } else {
            this.backQui = this.backQuiMobile;
        }
    },
    data() {
        return {
            backQui: "",
            backQuiMobile,
            backQuiDesktop,
            text: `Le Boba Shop est un projet mené par 3 associés, Marcelino Bloch, Franco-Chilien, Océane Chayavong, laotienne et Maria Mojica, colombienne.\n\n Nous nous sommes rencontrés dans un cadre professionnel et souhaitions avoir des valeurs communes telles que l'alimentation, le partage et la solidarité. Nous nous sommes donc investis pour vous proposer le phénomène mondialement connu qu’est le bubble tea, accompagné de recettes fusionnant le meilleur de nos cultures asiatique et sud-américaine. Ainsi s'est développé peu à peu l'identité du Boba Shop tel qu'il vous est présenté aujourd'hui avec ses créations originales conçues pour tous.`

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

.containerHistoire {
    margin-left: 30px;
    margin-right: 30px;
    display: flex;
    flex-direction: column;
    padding-bottom: 30px;
    margin-top: 30px;
}

.contentHistoire {
    margin-top: 30px;
    margin-bottom: 30px;
}

@media screen and (min-width: 600px) {
    .containerHistoire {
        width: 500px;
        margin-right: auto;
        margin-left: auto;
    }
    .containerBack h1 {
        font-size: 40px;
    }
}

@media screen and (min-width: 900px) {
    .containerHistoire {
        width: 800px;
        margin-top: 50px;
    }
    .containerBack {
        height: 91.5vh;
    }
}

@media screen and (min-width: 1300px) {
    .containerHistoire {
        width: 1000px;
    }
    .containerBack h1 {
        font-size: 50px;
    }
}

</style>
