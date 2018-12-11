<template>

  <div class="post_box" >
<!-- {{post}} -->


     <p id="content" class="content"
     v-html="convertToTag(post.content)">
   </p>

   <br>
   <a href="#">{{post.user.name}}</a>

   <br>

   <img  @click="emitImage($event.target)" class="post_image" v-for='image in post.images'
   :src="'storage/uploads/PostMedia/'+image.image_path" alt="">
   <br>

 <span>{{post.created_at}}</span>
   <div class="likes">
     <a @click="likePost(post.id)" class="cacaButton" v-bind:class="{cacaUserLikes: user_likes}" >&#128169; &nbsp;{{post.likes.length}}</a>
   </div>

   <br>
   <div class="" v-if="post.location && !post.parent_id">
     <p>
       <button  class="btn btn-primary" type="button" data-toggle="collapse" :data-target="'#id'+post.id" aria-expanded="false" >
         Show Location
       </button>
     </p>
     <div class="collapse" :id="'id'+post.id">
       <div class="card card-body">
         <iframe  width="100%" height="" frameborder="0" style="border:0"
         :src="'https://www.google.com/maps/embed/v1/place?q=' + this.location.latitude + ',+' + this.location.longitude + '&key='+$root.g_maps_key" allowfullscreen></iframe>
       </div>
     </div>
   </div>


   <button  v-if="$root.authuser !== null && $root.authuser.id == post.user_id " @click="onClickDelete(post.id)" type="button" name="button"><span v-if="!post.parent_id">Delete My post</span><span v-else>Delete My Comment</span> </button>

<div v-if="$root.authadmin ==true" class="">
  <button  @click="onClickDelete(post.id)" type="button" name="button">Delete post Admin style</button>
</div>

   <br>


   <button v-if="$root.authuser" type="button" name="comment" @click="emitComment(post)">
     <span v-if="!post.parent_id">Comment</span>
     <span v-else>Reply</span>
   </button>



   <div class="" v-if="post.allchildren && post.allchildren.length > 0" class="col-11" >
     <post-component v-for="child in post.allchildren"
     :post="child"
     :key="child.id">
   </post-component>
 </div>


</div>

</template>

<script>
import { EventBus } from '../event-bus.js';
import _ from 'lodash';
Object.defineProperty(Vue.prototype, '$_', { value: _ });

export default {
  props: ['post'],
  data(){
    return  {
      location: JSON.parse(this.post.location),
      user_likes: '',
    }
  },
  methods: {
    emitComment: function(post){
      EventBus.$emit('push-post', post);
    },
    emitImage: function(target){
      EventBus.$emit('resizeImage', target);
    },

    likedByUser: function(){
      this.user_likes  = (_.filter(this.post.likes, {user_id: this.$root.authuser.id}).length)? true : false;
    },

    onClickDelete: function(id){
      if (confirm('Are you sure?')) {
        axios.post('api/posts/destroy/' + id).then((response) => {
          console.log(response.data);
          // this.$emit('pop-post', id);
          EventBus.$emit('pop-post', id);
        });
      }else{
        alert('no problem!');
      }
    },
    convertToTag: function(content){
      var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
      var match = content.match(regExp);
      if ( match && match[7].length == 11 ){
        var src = "https://www.youtube.com/embed/" + match[7];
        return '<div class="iframe_container"><iframe src='+ src +' frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>';
      }
      else
      {
        var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
        var text1=content.replace(exp, '<a target="_blank" href="$1">$1</a>');
        var exp2 =/(^|[^\/])(www\.[\S]+(\b|$))/gim;
        return text1.replace(exp2, '$1<a target="_blank" href="http://$2">$2</a>');
      }
    },
    likePost: function(post_id){
      this.user_likes = (this.user_likes)? null : true;
      axios.post('api/postlikes/'+post_id).then((response) => {
        var like = {};
        if (response.data == 'saved') {
          this.post.likes.push(like);
        }
        if (response.data == 'deleted') {
          this.post.likes.pop(like);
        }
      });
    },


  },

  created(){
    this.likedByUser();
  },
  mounted(){
  },
}
</script>
