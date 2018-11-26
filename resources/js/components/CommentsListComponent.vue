<template>
  <div class="">


    <!-- <form-comment-component :type="'comment'"></form-comment-component> -->
    <comment-component  v-for="comment in comments" :comment="comment" :key="comment.parent_id"></comment-component>



  </div>
</template>

<script>
export default {
  props: ['post_id'],
  data(){
    return  {
      comments:'',
    }
  },

methods:{
  getComments() {
    axios.get('api/postComments/'+this.post_id).then((response) => {
      this.comments = response.data;
    });
  },
},



  mounted() {
    console.log('Component mounted.');
    this.getComments();
  }





}
</script>
