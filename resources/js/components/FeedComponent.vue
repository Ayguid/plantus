<template>
  <div class="">

    <button @click="myPosts" class="btn btn-primary" type="button" name="button"> My posts</button>



    <categoriesmenu-component class="mb-4" @filter-category="updateCategory"></categoriesmenu-component>



    <form-component @push-post="pushPost" :category="category">
    </form-component>



    <post-component v-for="(post, index)  in posts"
    :key="post.id" :post="post"
    @pop-post="popPost(index)">
    </post-component>


    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>




    </div>
</template>




<script>
export default {

  data(){
    return  {
      category:'',
      posts: [],
      userId:'',
      authuser:window.Laravel.user,
      authadmin:window.Laravel.admin,
      post_qty_limit:3,
    }
  },

  methods: {
    getPosts() {
      axios.get('api/posts/'+this.post_qty_limit+'/'+this.category+'/'+this.userId).then((response) => {
        this.posts = response.data;
      });
    },
    handleScroll(e){
      var d = document.documentElement;
      var offset = d.scrollTop + window.innerHeight;
      var height = d.offsetHeight;
      // console.log('offset = ' + offset);console.log('height = ' + height);
      if (offset === height) {
        // console.log('llegaste-al-bottom');
        this.post_qty_limit += 3;
        this.getPosts();
      }
    },
    pushPost(post){
      this.posts.unshift(post);
    },
    popPost(index){
      this.posts.splice(index, 1);
    },
    updateCategory(category){
      console.log('e');
      this.category = category;
      this.getPosts();
    },
    myPosts(){
    this.userId = this.authuser.id;
    // this.getPosts();
    }
  },

  mounted(){
    this.getPosts();
    setInterval(()=>{
    this.getPosts();
    },9000);
    window.addEventListener('scroll', this.handleScroll);

  },
}
</script>
