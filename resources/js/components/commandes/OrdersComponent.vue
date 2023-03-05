<template>
<section>
  <h1>Commandes</h1>

  <button @click="buyArticles">commande</button>
</section>
</template>

<script>
export default {
  name: "OrdersComponent",
  methods:{
    buyArticles(){
      console.log('hey');
    }
  }
}
</script>

<style scoped>

</style>