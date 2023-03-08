<template>
  <div>
    <div class="circle" :style="{'background':color}"></div>
    <p>{{ text }}</p>
  </div>
</template>

<script>
export default {
  name: "PerleComponent",
  props: {
    text: String,
    color: String,
  }
}
</script>

<style lang="scss" scoped>
div {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 70px;
  height: 110px;
}

.circle {
  height: 50px;
  width: 50px;
  border-radius: 100%;
}

p {
  font-size: 13px;
  font-family: Lato, sans-serif;
  text-align: center;
}

@media screen and (max-width: 390px) {
  p {
    font-size: 12px;
  }
  .circle {
    height: 45px;
    width: 45px;
  }
  div{
    width: 60px;
  }
}

@media screen and (min-width: 900px) {
  .circle {
    height: 40px;
    width: 40px;
  }
  div {
    width: 60px;
    height: 100px;
  }
  p {
    font-size: 11px;
  }
}

@media screen and (min-width: 1300px) {
  .circle {
    height: 50px;
    width: 50px;
  }
  div {
    width: 70px;
    height: 110px;
  }
  p {
    font-size: 13px;
  }
}

</style>