<template>
  <div class="bg-primary mb-1">

      <p>
        {{comment.content}}
      </p>



    <div v-if="comment.children.length > 0" v-for="child in comment.children">
      {{child.content}}
    </div>




  </div>
</template>

<script>
export default {
  props: ['comment'],









  mounted() {
    console.log('Component mounted.')
  }









}
</script>
