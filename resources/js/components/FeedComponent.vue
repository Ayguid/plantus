<template>
  <div class="">


    <div id="image_modal" class="modal">
      <!-- Modal Content (The Image) -->
      <img class="insideModal" id="imgModal">
      <!-- Modal Caption (Image Text) -->
    </div>


    <div v-if="$root.authuser" class="post_button">
      <button id="post_button" type="button" name="button" v-on:click="displayForm(); resetParent_id()">PLANK IT!!</button>
    </div>
    <!-- {{this.$root.authadmin}} -->

    <div id="saving_modal" class="saving_modal">
      <div class="spinner">


        <div class="dot1"></div>
        <div class="dot2"></div><p class="bancala">Aguanta!</p>
      </div>

    </div>
    <div id="form_modal" class="modal">
      <div class="insideModal">

        <span id="close_modal" class="close_modal">X close</span>
        <form-component  @push-post="pushPost" :parent_post="parent_post" >
        </form-component>

      </div>
    </div>



    <post-component v-for="(post, index)  in posts"
    :key="post.id" :post="post">
  </post-component>
  <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>


</div>
</template>




<script>
import { EventBus } from '../event-bus.js';


export default {
  props:['user_id'],
  data(){
    return  {
      parent_post:'',
      posts: [],
      post_qty_limit:10,
    }
  },

  methods: {
    resetParent_id: function(){
      this.parent_post = '';
    },
    displayForm: function(){
      var modal = document.getElementById('form_modal');
      var close_modal = document.getElementById('close_modal');
      modal.style.display = "block";
      close_modal.onclick = function() {
        modal.style.display = "none";
      }
    },
    resizeImage: function(target){
      var modal = document.getElementById('image_modal');
      var modalImg = document.getElementById("imgModal");
      modal.style.display = "block";
      modalImg.src = target.src;
      modalImg.onclick = function() {
        modal.style.display = "none";
      }
    },
    getPosts: function() {
      axios.get('api/posts/'+this.post_qty_limit+'/'+this.user_id+ '?nocache=' + new Date().getTime()).then((response) => {
        this.posts = response.data;
      });
    },
    handleScroll: function(){
      var d = document.documentElement;
      var offset = d.scrollTop + window.innerHeight;
      var height = d.offsetHeight;
      console.log('offset = ' + offset);console.log('height = ' + height);console.log('d.scrollTop = ' + d.scrollTop);
      if (offset === height) {
        console.log('request');
        this.post_qty_limit += 10;
        this.getPosts();
      }
      if (d.scrollTop == 0) {
        this.getPosts();
      }

    },
    pushPost: function(post){
      this.parent_post = post;
      this.displayForm();
      if (!post.parent_id) {
        this.posts.unshift(post);
      }
      else{
        this.getPosts();
      }
    },

    popPost: function(index){
      // this.posts.splice(index, 1);
      this.getPosts();
    },
  },



  created: function () {
    this.getPosts();
    window.addEventListener('scroll', this.handleScroll);
  },
  mounted(){
    EventBus.$on('pop-post', this.popPost);
    EventBus.$on('push-post', this.pushPost);
    EventBus.$on('resizeImage', this.resizeImage);
  },
}
</script>
