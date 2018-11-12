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
      post_qty_limit:3,
    }
  },
  methods: {
    getPosts(last_id) {
      axios.get('api/posts/'+last_id).then((response) => {
        this.posts = response.data;
      });
    },
    handleScroll(e){
      var d = document.documentElement;
      var offset = d.scrollTop + window.innerHeight;
      var height = d.offsetHeight;
      // console.log('offset = ' + offset);console.log('height = ' + height);
      if (offset === height) {
        console.log('bottom-end');
        this.post_qty_limit++;
        this.getPosts(this.post_qty_limit);
        // console.log(this.posts[this.posts.length-1]);
      }
    },
    pushPost(post){
      this.posts.unshift(post);
    },
    popPost(index){
      this.posts.splice(index, 1);
    },
  },

    mounted(){
    this.getPosts(this.post_qty_limit);
    setInterval(()=>{
      this.getPosts(this.post_qty_limit);
    },9000);
    window.addEventListener('scroll', this.handleScroll);

  },
}
</script>
