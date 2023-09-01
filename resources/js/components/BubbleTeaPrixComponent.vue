<template>
  <div class="content" :class="{ 'borderBottom': length-1 !== index}">
    <div class="containerText">
      <p>{{ name }} {{ size }} <span class="size">ml</span></p>
      <p class="prix"><span>Prix</span>{{ prix }} €</p>
    </div>
    <div class="contentImage">
      <img :src="image" alt="bubbleTea">
    </div>
    <button @click="eventModal(id)">commander</button>
  </div>
</template>

<script>
import imageBubbleTea from "../../assets/image/homView/imageBubbleTea.avif"

export default {
  name: "BubbleTeaPrixComponent",
  props: {
    name: String,
    prix: String,
    id: Number,
    size: Number,
    index: Number,
    length: Number,
  },
  data() {
    return {
      image: imageBubbleTea
    }
  },
  methods: {
    eventModal() {
      const choice = {
        "id": this.id,
        "name": this.name,
        "size": this.size,
        "price": this.prix
      };
      this.$emit("eventChild", choice);
      this.$emit("eventChildModal", true);
    }
  }
}
</script>

<style scoped>
p {
  font-family: Rufina, sans-serif;
  font-weight: 700;
  margin: 0;
  font-size: 18px;
  text-transform: capitalize;
}

.size {
  font-family: Rufina, sans-serif;
  font-weight: 700;
  margin: 0;
  font-size: 18px;
  text-transform: lowercase;
}

.content {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 15px;
}

.borderBottom {
  border-bottom: 1px dashed black;
}

.contentImage {
  display: flex;
  align-items: flex-end;
}

img {
  width: 66px;
  height: 100px;
}

.containerText {
  display: flex;
  flex-direction: column;
}

.containerText .prix {
  align-self: flex-end;
  display: flex;
}

span {
  font-size: 10px;
  align-self: center;
  margin-right: 5px;
  font-family: Lato, sans-serif;
  font-weight: 400;
}
button {
    background-color: #EAB99F;
    color: #ffffff;
    font-family: 'Lato', serif;
    font-size: 1rem;
    font-weight: bold;
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    display: flex;
    margin-right: auto;
    margin-left: auto;
    height: 30px;
    line-height: 16px;
    margin-top: 15px;
    transition: all 0.3s ease;
}

button:hover {
    outline: none;
    box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.25);
}
/*@media screen and (min-width: 650px){*/
/*  p{*/
/*    font-size: 25px;*/
/*  }*/
/*  img{*/
/*    width: 86px;*/
/*    height: 120px;*/
/*  }*/
/*  span{*/
/*    font-size: 15px;*/
/*  }*/
/*}*/
@media screen and (min-width: 900px) {
  .content {
    border-bottom: none;
    width: 368.4px;
    margin-top: 30px;
  }

  span {
    font-size: 10px;
  }

  img {
    width: 66px;
    height: 100px;
  }

  p {
    font-size: 18px;
  }
}

@media screen and (min-width: 1300px) {
  span {
    font-size: 15px;
  }

  .content {
    border-bottom: none;
    width: 569px;
  }

  img {
    height: 120px;
    width: 86px;
  }

  p {
    font-size: 25px;
  }
}
</style>
