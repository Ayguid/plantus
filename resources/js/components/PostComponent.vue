<template>

  <div class="post_box">

    <p id="content" class="content"
    v-html="convertToTag(post.content)">
  </p>

    <br>
    <a href="#">{{post.user.name}}</a>
    <br>
    <img  @click="resizeImage($event.target)" class="post_image" v-for='image in post.images'
    :src="'storage/uploads/PostMedia/'+image.image_path" alt="">
    <br>


    <div class="likes">
      <a @click="likePost(post.id)" class="cacaButton">&#128169; &nbsp;{{likes.length}}</a>
    </div>

    <br>

    <div class="" v-if="post.location">
      <p>
        <button  class="btn btn-primary" type="button" data-toggle="collapse" :data-target="'#id'+post.id" aria-expanded="false" >
          Show Location
        </button>
      </p>
      <div class="collapse" :id="'id'+post.id">
        <div class="card card-body">
          <iframe  width="100%" height="" frameborder="0" style="border:0"
          :src="'https://www.google.com/maps/embed/v1/place?q=' + this.location.latitude + ',+' + this.location.longitude + '&key='+g_maps_key" allowfullscreen></iframe>
        </div>
      </div>
    </div>


    <button  v-if="authuser !== null && authuser.id == post.user_id " @click="onClickDelete(post.id)" type="button" name="button">Delete My post</button>
    
    <br>

  </div>

</template>

<script>
export default {
  props: ['post'],
  data(){
    return  {
      likes:this.post.likes,
      authuser:window.Laravel.user,
      authadmin:window.Laravel.admin,
      location: JSON.parse(this.post.location),
      g_maps_key:process.env.MIX_GOOGLE_MAPS_KEY,
    }
  },
  methods: {
    onClickDelete(id){
      if (confirm('Are you sure?')) {
        axios.post('api/posts/destroy/' + id).then((response) => {
          this.$emit('pop-post', id);
        });
      }else{
        alert('no problem!');
      }
    },
    convertToTag(content){
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
    resizeImage(target){
      var modal = document.getElementById('image_modal');
      var modalImg = document.getElementById("imgModal");
      modal.style.display = "block";
      modalImg.src = target.src;
      modalImg.onclick = function() {
        modal.style.display = "none";
      }
    },
    likePost(post_id){
      axios.post('api/postlikes/'+post_id).then((response) => {
        // console.log(response.data);
        var like = {};
        if (response.data == 'saved') {
          this.likes.push(like);
        }
        if (response.data == 'deleted') {
          this.likes.pop(like);
        }
      });
    },
  },
  mounted(){
    console.log(this.g_maps_key);
  },
}
</script>
