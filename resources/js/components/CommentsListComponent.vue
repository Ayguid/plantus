<template>
  <div class="">

<!-- {{JSON.stringify(comments)}} -->



    <comment-component  v-for="comment in comments" :comment="comment" ></comment-component>







  </div>
</template>

<script>
export default {
  props: ['comments'],
  data(){
    return  {

    }
  },





  mounted() {
    console.log('Component mounted.')
  }





}
</script>
