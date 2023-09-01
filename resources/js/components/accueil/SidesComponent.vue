<template>
    <section>
        <div class="contentTitle">
            <h2>Les sides</h2>
        </div>
        <div class="containerMain">
            <div class="container">
                <div class="containerTitleBis">
                </div>
                <div class="test">
                    <div class="contentCardSides">
                        <div v-for="(value,index) in sides" :key="index">
                            <card-sides-component v-if="index % 2 === 0" class="cardSides" :title="value.name"
                                                  :text="value.description"
                                                  :image="value.image_url"></card-sides-component>
                        </div>
                        <div class="imageEmpanadas" v-if="countPeer < countOdd">
                            <img class="empanadas" :src="empanadas" alt="logo_empanadas">
                            <img class="empanadas2" :src="empanadas2" alt="logo_empanadas">
                        </div>

                    </div>
                </div>
                <div class="test bis">
                    <div class="containerTitle">
                        <h2>Les sides</h2>
                    </div>
                    <div v-for="(value,index) in sides" :key="index">
                        <card-sides-component v-if="index % 2 !== 0" class="cardSides" :title="value.name"
                                              :text="value.description"
                                              :image="value.image_url"></card-sides-component>
                    </div>
                    <div class="imageEmpanadas" v-if="countPeer>countOdd">
                        <img class="empanadas" :src="empanadas" alt="logo_empanadas">
                        <img class="empanadas2" :src="empanadas2" alt="logo_empanadas">
                    </div>
                </div>

            </div>
            <div v-if="countPeer === countOdd" class="imageEmpanadasBottom">
                <img class="empanadasB" :src="empanadas" alt="logo_empanadas">
                <img class="empanadas2B" :src="empanadas2" alt="logo_empanadas">
            </div>
        </div>
    </section>
</template>

<script>
import CardSidesComponent from "../../components/CardSidesComponent.vue";
import empanadas from "../../../assets/image/homView/back-1 4.avif"
import empanadas2 from "../../../assets/image/homView/back-1 5.avif"

export default {
    name: "SidesComponent",
    components: {
        CardSidesComponent,
    },
    props: {
        sides: Array,
    },
    watch: {
        sides: {
            immediate: true,
            handler(newItems) {
                this.countOdd = newItems.filter((item, index) => index % 2 !== 0).length;
                this.countPeer = newItems.filter((item, index) => index % 2 === 0).length;
            }
        }

    },
    data() {
        return {
            empanadas: empanadas,
            empanadas2: empanadas2,
            countPeer: 0,
            countOdd: 0,
        }
    }
}
</script>

<style scoped>
section {
    position: relative;
}

.containerMain {
    padding-bottom: 40px;
    padding-right: 20px;
    padding-left: 20px;
    border: 3px solid #B66A54;
    position: relative;
    z-index: 4;
    margin: 30px 30px 20px;
}

.container {
    /*padding-bottom: 90px;*/
    /*padding-right: 20px;*/
    /*padding-left: 20px;*/
    /*border: 3px solid #B66A54;*/
    /*position: relative;*/
    /*z-index: 4;*/
    /*margin: 30px 30px 20px;*/
}

.contentTitle {
    display: flex;
    height: 60px;
    position: absolute;
    background: #EBF0E4;
    top: 30px;
    width: 100%;
    margin-right: 30px;
    z-index: 1;
    justify-content: center;
    align-items: center;
}

.containerTitleBis {
    width: 100%;
    height: 90px;
}

.containerTitle h2 {
    display: none;
}

h2 {
    font-family: Rufina, sans-serif;
    font-weight: 700;
    font-size: 25px;
    text-align: center;
    margin: 10px 0 10px 0;
}

/*img {*/
/*    height: 70px;*/
/*    !*position: absolute;*!*/
/*    bottom: -20px;*/
/*    right: 30px;*/
/*    z-index: 10;*/
/*    background: white;*/
/*    align-self: flex-end;*/
/*}*/
img {
    height: 100px;
}

.imageEmpanadas {
    display: flex;
    justify-content: space-around;
}


@media screen and (min-width: 600px) {
    .containerMain {
        width: 500px;
        margin-right: auto;
        margin-left: auto;
    }


    h2 {
        font-size: 30px;
    }
}

@media screen and (min-width: 900px) {
    .containerMain {
        width: 760px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding-bottom: 90px;
    }

    .container {
        display: flex;
        justify-content: space-around;
        align-items: start;
        gap: 30px;

    }

    .containerTitleBis {
        display: none;
    }

    .test {
        width: 50%;
    }

    .containerTitle {
        background-color: #EBF0E4;
        height: 100%;
        width: 100%;
        margin-top: 30px;
    }

    .containerTitle h2 {
        margin: 0;
        padding-top: 20px;
        padding-bottom: 20px;
        display: block;
        font-size: 30px;
    }

    .contentTitle {
        display: none;
    }

    /*img {*/
    /*    height: 205px;*/
    /*    right: 40px;*/
    /*    bottom: 190px;*/
    /*}*/
    img {
        height: 200px;
        align-self: center;
    }

    .imageEmpanadas {
        height: 350px;
        justify-content: center;
    }
    .imageEmpanadasBottom{
        height: 100px;
        display: flex;
       justify-content: space-around;
    }
    .empanadasB,.empanadas2B{
        height: 100px;
    }
}

@media screen and (min-width: 1300px) {
    .containerMain {
        width: 960px;
    }

    .containerTitle h2 {
        font-size: 35px;
    }

}
</style>
