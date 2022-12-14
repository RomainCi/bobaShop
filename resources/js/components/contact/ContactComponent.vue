<template>
  <section>
    <div class="containerBack" :style="{'background-image': `url(${backContact})`,}">
      <h1>Contactez-nous</h1>
      <p>Venir, réserver</p>
    </div>
    <div class="container">
      <h2>Contact</h2>
      <p>email : contact@boba-shop.fr</p>
      <p>telephone : +33 7 53 69 72 81</p>
      <img :src="bubbleTea" alt="bubble_tea">
    </div>
    <div class="container container1">
      <l-map style="height: 300px; width: 100%;" :min-zoom="minZoom" :max-zoom="maxZoom" :zoom="zoom"
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
      <p>26 rue de la mésange, 67000 Strasbourg</p>
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
.test {
  color: red;
  filter: hue-rotate(120deg)
}

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
  font-size: 7vw;
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
}

.container {
  margin-right: 30px;
  margin-left: 30px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
  margin-top: 20px;
}

.container p {
  font-family: Lato, sans-serif;
  margin: 0;
}

.container h2 {
  margin: 0;
  font-family: Rufina, sans-serif;
  font-weight: 700;
  font-size: 25px;
}
.container1{
  padding-bottom: 30px;
}
</style>