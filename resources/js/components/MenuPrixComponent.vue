<template>
    <div class="content"
         :class="{ 'border': length-1 !== index, 'borderPair': (index+1) % 3 === 2 , 'borderPaire' : (index+1) === lastLength}">
        <div class="containerText">
            <p>{{ menu }} {{ size }} <span class="size">ml</span></p>
            <p class="prix"><span>Prix</span> {{ prix }} €</p>
        </div>
        <div class="contentImage">
            <img :src="image" alt="bubbleTea">
            <p>{{ side }}</p>
        </div>
        <button @click="eventModal(id)">commander</button>
    </div>
</template>

<script>
import imageBubbleTea from "../../assets/image/imageBubbleTea.png"

export default {
    name: "MenuPrixComponent",
    props: {
        menu: String,
        prix: String,
        side: String,
        size: Number,
        id: Number,
        index: Number,
        length: Number,
        lastLength: Number,
    },
    data() {
        return {
            image: imageBubbleTea,
            border: "",
        }
    },
    methods: {
        eventModal() {
            const choice = {
                "id": this.id,
                "name": this.menu,
                "size": this.size,
                "price": this.prix
            };
            this.$emit("eventChild", choice);
            this.$emit("eventChildModal", true);
        }
    }
}
</script>

<style lang="scss" scoped>
.size {
    font-family: Rufina, sans-serif;
    font-weight: 700;
    margin: 0;
    font-size: 18px;
    text-transform: lowercase;
}

p {
    font-family: Rufina, sans-serif;
    font-weight: 700;
    margin: 0;
    font-size: 18px;
    text-transform: capitalize;
}

img {
    width: 66px;
    height: 100px;
}

.border {
    border-bottom: 1px dashed black;
}

.content {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 15px;
}

.contentImage {
    display: flex;
    align-items: flex-end;
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
    font-family: Lato, sans-serif;
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

//@media screen and (min-width: 650px) {
//  span {
//    font-size: 15px;
//  }
//  img {
//    height: 120px;
//    width: 86px;
//  }
//  p {
//    font-size: 25px;
//  }
//}

@media screen and (min-width: 900px) {
    .border {
        border-bottom: none;
    }
    .borderPair {
        border-right: 2px dashed black;
        border-left: 2px dashed black;
    }
    .borderPaire {
        border-right: 2px dashed black;
        border-left: 2px dashed black;
    }
    .content {
        border-bottom: none;
        width: 230px;
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
    img {
        height: 120px;
        width: 86px;
    }
    .content {
        width: 360px;
    }
    p {
        font-size: 25px;
    }
}
</style>
