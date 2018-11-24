<template>
  <div class="bg-primary mb-1">

    <div  class="">

      {{comment.content}}<br>
      <!-- form -->
    </div>

    <div v-for="child in comment.allchildren" class="">

      <comment-component v-if="comment.allchildren.length > 0" :comment="child" ></comment-component>

    </div>

    <!-- <p v-if="comment.allchildren.length > 0 " v-for="child in comment.allchildren">{{child.content}}</p> -->

    <!-- {{comment.children}} -->
    <!-- <comments-list-component v-if="comment.allchildren.length > 0 && !comment.parent_id" v-for="child in comment.allchildren" :comments="comment.allchildren" ></comments-list-component > -->
    <!-- <comments-list-component v-if="comment.children.length > 0" v-for="child in comment.children" :comments="comment.children" ></comments-list-component> -->







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
