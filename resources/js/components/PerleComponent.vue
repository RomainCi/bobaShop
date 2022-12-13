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
    color:String,
  }
}
</script>

<style lang="scss" scoped>
div{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.circle {
  height: 50px;
  width: 50px;
  border-radius: 100%;
}
p{
  font-size: 13px;
  font-family: Lato, sans-serif;
}
</style>