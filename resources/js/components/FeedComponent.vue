<template>
  <div class="">

    <div id="image_modal" class="image_modal">
      <!-- Modal Content (The Image) -->
      <img class="imgModal" id="imgModal">
      <!-- Modal Caption (Image Text) -->
    </div>



    <div v-if="this.$root.authuser" class="post_button">
      <button id="post_button" type="button" name="button" v-on:click="displayForm(); resetParent_id()">PLANK IT!!</button>
    </div>



    <div id="form_modal" class="form_modal">
      <form-component @push-post="pushPost" :parent_post="parent_post" >
      </form-component>
    </div>


    <post-component v-for="(post, index)  in posts"
    :key="post.id" :post="post"
    @pop-post="popPost(index)"
    @push-comment="pushComment"
    @image-bus="resizeImage">
  </post-component>


  <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>


</div>
</template>




<script>
export default {
  props:['user_id'],
  data(){
    return  {
      parent_post:'',
      posts: [],
      post_qty_limit:3,
    }
  },

  methods: {
    resetParent_id(){
      this.parent_post = '';
    },
    displayForm(){
      var post_input = document.getElementById('post_input');
      if (post_input.style.display === "block") {
        post_input.style.display = "none";
      } else {
        post_input.style.display = "block";
      }
    },
    resizeImage(target){
      console.log(target);
      var modal = document.getElementById('image_modal');
      var modalImg = document.getElementById("imgModal");
      modal.style.display = "block";
      modalImg.src = target.src;
      modalImg.onclick = function() {
      modal.style.display = "none";
      }
    },
    getPosts() {
        axios.get('api/posts/'+this.post_qty_limit+'/'+this.user_id).then((response) => {
          this.posts = response.data;
        });
    },
    handleScroll(e){
      var d = document.documentElement;
      var offset = d.scrollTop + window.innerHeight;
      var height = d.offsetHeight;
      // console.log('offset = ' + offset);console.log('height = ' + height);console.log('d.scrollTop = ' + d.scrollTop);
      if (offset === height) {
        // console.log('llegaste-al-bottom');
        this.post_qty_limit += 3;
        this.getPosts();
      }
      if (d.scrollTop == 0) {
        this.getPosts();
      }

    },
    pushPost(post){
      this.displayForm();
      if (!post.parent_id) {
        this.posts.unshift(post);
      }
      else{
        this.getPosts();
      }
    },
    pushComment(post){
      this.displayForm();
      this.parent_post = post;
    },
    popPost(index){
      // this.posts.splice(index, 1);
      this.getPosts();
    },
  },

  mounted(){
    this.getPosts();
    window.addEventListener('scroll', this.handleScroll);
  },
}
</script>
