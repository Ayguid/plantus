<template>
  <div class="bg-warning mb-1">

    <div  class="">
      {{comment.content}}
      <!-- <form-comment-component :type="'reply'"></form-comment-component> -->
    </div>




    <div v-if="comment.allchildren.length > 0" v-for="child in comment.allchildren" class="col-11">

      <comment-component  v-if="comment.allchildren.length > 0" :comment="child" ></comment-component>

    </div>






  </div>
</template>

<script>
export default {
  props: ['comment'],









  mounted() {
    // console.log('Component mounted.');
  }









}
</script>
