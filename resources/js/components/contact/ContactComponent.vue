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
          <p>telephone : +33 7 53 69 72 81</p>
        </div>
        <img :src="bubbleTea" alt="bubble_tea">
      </div>
      <div class="container container1">
        <div class="contentText">
          <h2>Adresse</h2>
          <p>26 rue de la mésange, 67000 Strasbourg</p>
        </div>
        <div class="contentMap">
          <l-map style="height: 100%; width: 100%;" :min-zoom="minZoom" :max-zoom="maxZoom"
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
import backContact from "../../../assets/image/backContact.png"
import {LCircle, LIcon, LMap, LMarker, LPopup, LTileLayer} from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css"
import bubbleTea from "../../../assets/image/bubbleTea.png"

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
          '&copy; <a target="_blank" href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      backContact,
      zoom: 15,
      center: [48.584342, 7.74842],
      markerLatLng: [48.584342, 7.74842],
      minZoom: 3,
      maxZoom: 18,
      myPosition: null,
      bubbleTea: bubbleTea,
    }
  },
  mounted() {
    this.geolocation()
  },
  methods: {
    async geolocation() {
      navigator.geolocation.getCurrentPosition(async (position) => {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
        console.log(latitude, longitude)
        this.myPosition = [latitude, longitude];
      });
    },
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

img {
  width: 100%;
  max-width: 400px;
}

.containerMain {
  margin-right: 30px;
  margin-left: 30px;
  margin-bottom: 30px;
}

.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
  margin-top: 20px;
}

.container p {
  font-family: Lato, sans-serif;
  margin: 0;
  font-size: 13px;
}

.container h2 {
  margin: 0;
  font-family: Rufina, sans-serif;
  font-weight: 700;
  font-size: 25px;
}

.contentText h2 {
  margin-bottom: 20px;
}

.contentMap {
  width: 100%;
  height: 300px;
  max-width: 400px;
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
    margin-top: 50px;
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
}
</style>