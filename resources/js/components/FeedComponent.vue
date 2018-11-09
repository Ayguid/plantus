<template>
  <div class="">


    <form-component @push-post="pushPost" >
    </form-component>


    <post-component v-for="(post, index)  in posts"
    :key="post.id" :post="post"
    @pop-post="popPost(index)">
  </post-component>


</div>
</template>




<script>
export default {

  data(){
    return  {
      posts: [],
      authuser:window.Laravel.user,
      authadmin:window.Laravel.admin,
      last_id:'',
    }
  },
  methods: {
    getPosts: function(last_id) {
      axios.get('api/posts/'+last_id).then((response) => {
        this.posts = response.data;
        // this.posts.push(response.data);
        // console.log(this.posts);
      });
    },
    handleScroll: function(e){
      var d = document.documentElement;
      var offset = d.scrollTop + window.innerHeight;
      var height = d.offsetHeight;
      // console.log('offset = ' + offset);console.log('height = ' + height);
      if (offset === height) {
        console.log('At the bottom');
        // this.last_id=this.posts[0].id;
        // console.log(this.posts[0].id);
      }
    },
    pushPost: function(post){
      this.posts.unshift(post);
    },
    popPost: function(index){
      this.posts.splice(index, 1);
    },
  },
    mounted(){
    this.getPosts(this.last_id);
    setInterval(()=>{
      this.getPosts(this.last_id);
    },9000);

    window.addEventListener('scroll', this.handleScroll);

  },
}
</script>
