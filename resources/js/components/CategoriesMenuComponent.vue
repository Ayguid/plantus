<style scoped>
.menuCat{
  overflow: hidden;
}
.menuCatItem{
  width: 33%;
  float: left;
  text-align: center;
}
</style>


<template>
<div class="">


    <div class="menuCat">
      <a href="#" class="menuCatItem">Calle</a>
      <a href="#" class="menuCatItem">Lugar</a>
      <a href="#" class="menuCatItem">Persona</a>
    </div>


</div>
</template>

<script>
export default {
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
