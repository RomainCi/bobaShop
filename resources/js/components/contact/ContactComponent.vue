<template>
    <section>
        <div class="containerBack" :style="{'background-image': `url(${backContact})`,}">
            <h1>Contactez-nous</h1>
            <p>Venir, réserver</p>
        </div>
        <div class="containerMain">
            <div class="container">
                <div class="contentText">
                    <h2>Contact</h2>
                    <p>email : contact@boba-shop.fr</p>
                    <p>telephone : 03 88 68 31 98</p>
                </div>
                <img :src="bubbleTea" alt="bubble_tea">
            </div>
            <div class="container container1">
                <div class="contentText">
                    <h2>Adresse</h2>
                    <p>26 rue de la mésange, 67000 Strasbourg</p>
                    <button class="button" @click="openMap">Voir sur map</button>
                </div>
                <div class="contentMap">
                    <l-map style="height: 100%; width: 100%;border-radius: 6px" :min-zoom="minZoom" :max-zoom="maxZoom"
                           :zoom="zoom"
                           :center="center">
                        <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                        <l-marker :lat-lng="markerLatLng">
                            <l-popup>Boba-shop</l-popup>
                        </l-marker>

                        <div v-if="myPosition !=null">
                            <l-marker :lat-lng="myPosition">
                                <l-popup>vous êtes ici</l-popup>
                            </l-marker>
                        </div>
                    </l-map>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import backContactMobile from "../../../assets/image/contactView/backgroundContactMobile-1.avif"
import backContactDesktop from "../../../assets/image/contactView/backgroundContactDesktop.avif"
import {LCircle, LIcon, LMap, LMarker, LPopup, LTileLayer} from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css"
import bubbleTea from "../../../assets/image/contactView/bobashopresize-adresse.avif"
import {Icon} from 'leaflet';

export default {
    name: "ContactComponent",
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LIcon,
        LPopup,
        LCircle
    },
    data() {
        return {
            url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            attribution:
                '&copy; <a target="_blank" href="https://osm.org/copyright">OpenStreetMap</a> contributors',
            backContact: "",
            zoom: 15,
            center: [48.584342, 7.74842],
            markerLatLng: [48.584342, 7.74842],
            minZoom: 3,
            maxZoom: 18,
            myPosition: null,
            bubbleTea: bubbleTea,
            backContactMobile,
            backContactDesktop
        }
    },
    mounted() {
        if (document.documentElement.scrollWidth > 550) {
            this.backContact = this.backContactDesktop;
        } else {
            this.backContact = this.backContactMobile;
        }
    },
    methods: {
        async geolocation() {
            navigator.geolocation.getCurrentPosition(async (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    console.log(latitude, longitude)
                    this.myPosition = [latitude, longitude];
                    window.open(`https://www.google.com/maps/dir/${this.myPosition[0]},${this.myPosition[1]}/26+Rue+de+la+M%C3%A9sange,+67000+Strasbourg,+France/@28.9140328,-76.7547121,3z/data=!3m1!4b1!4m10!4m9!1m1!4e1!1m5!1m1!1s0x4796c851f795309b:0x87de8232c91dd0ae!2m2!1d7.7484238!2d48.5843079!3e0`);
                },
                function (positionError) {
                    window.open('https://www.google.com/maps/place/26+Rue+de+la+M%C3%A9sange,+67000+Strasbourg,+France/@48.5843114,7.7462351,17z/data=!3m1!4b1!4m6!3m5!1s0x4796c851f795309b:0x87de8232c91dd0ae!8m2!3d48.5843079!4d7.7484238!16s%2Fg%2F11bw3gfvdr');
                });
        },
        openMap() {
            this.geolocation()
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

img {
    width: 100%;
    max-width: 400px;
    border-radius: 6px;
}

.containerMain {
    margin-right: 30px;
    margin-left: 30px;
    margin-bottom: 30px;
    background-color: #EAB99F;
    padding: 20px;
    border-radius: 0 0 6px 6px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    margin-top: 20px;
    margin-bottom: 20px;
}

.container p {
    font-family: Lato, sans-serif;
    font-size: 15px;
    color: white;
}

.container h2 {
    margin: 0;
    font-family: Rufina, sans-serif;
    font-weight: 700;
    font-size: 25px;
    color: white;
}

.contentText {
    width: 100%;
    max-width: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.contentText h2 {
    margin-bottom: 20px;
}

.contentMap {
    width: 100%;
    height: 300px;
    max-width: 400px;
    border-radius: 6px;
}
button {
    padding: 0.8rem 1.8rem;
    background-color: #ffffff;
    color: #EAB99F;
    font-size: 1.3rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
    font-family: Lato, sans-serif;
    margin-top: 20px;
}

button:hover {
    outline: none;
    box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.25);
}

@media screen and (min-width: 600px) {
    .containerMain {
        width: 500px;
        margin-right: auto;
        margin-left: auto;
    }
    .containerBack h1 {
        font-size: 40px;
    }
    .container p {
        font-size: 15px;
    }
}

@media screen and (min-width: 900px) {
    .containerMain {
        width: 800px;
    }
    .containerBack {
        height: 91.5vh;
    }
    .container {
        display: flex;
        flex-direction: row-reverse;
        width: 100%;
        justify-content: space-between;
    }
    .container1 {
        flex-direction: row;
        justify-content: space-between;
    }
}

@media screen and (min-width: 1300px) {
  .containerMain {
    width: 1000px;
    margin-top: 50px;
  }
  .container h2 {
    font-size: 30px;
  }
  .containerBack h1 {
    font-size: 50px;
  }
  .containerBack p {
    font-size: 18px;
  }
  img {
    max-width: 500px;
  }
  .contentMap {
    max-width: 500px;
    height: 400px;
  }
  .container p {
    font-family: Lato, sans-serif;
    margin: 0;
    font-size: 17px;
  }
}
</style>
