<template>
  <div class="">





    <comment-component  v-for="comment in comments" :comment="comment"></comment-component>







  </div>
</template>

<script>
export default {
  props: ['comments'],






  mounted() {
    console.log('Component mounted.')
  }





}
</script>
