<!-- <template>
  <div class="">


    <div class="" v-for='post in posts' :key="post.id" >

      <div class="post_box">
        <p id="content" class="content" v-html="convertToTag(post.content)"></p>
        <br>
        <a href="#">{{post.user.name}}</a>
        <br>
        <img class="post_image" v-for='image in post.images'  :src="'storage/uploads/PostMedia/'+image.image_path" alt="">
        <br>
        <div class="likes">

          <button class="cacaButton">&#128169; &nbsp;</button> {{post.likes.length}}
        </div>
        <button v-if="authadmin == true" v-on:click="onClickDelete(post.id)"  type="button" name="button">Admin Delete</button>
        <button v-if="authuser.id == post.user_id" v-on:click="onClickDelete(post.id)" type="button" name="button">Delete My post</button>
      </div>
      <br>

    </div>


  </div>
</template>

<script>
export default {

  data(){
    return  {
      posts: [],
      authuser:window.Laravel.user,
      authadmin:window.Laravel.admin,
    }
  },
  methods: {
    showPosts: function() {
      axios.get('api/posts').then(response => this.posts = response.data
      );
    },
    onClickDelete(id){
      var sure = confirm('Are you sure?');
      if (sure) {
        axios.post('api/posts/' + id).then((response) => {
          this.posts = response.data;
          console.log(response);
        });
      }else {
        alert('no problem!');
      }
    },
    // for pat
    convertToTag(content){
      var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
      var match = content.match(regExp);
      if ( match && match[7].length == 11 ){
      var src = "https://www.youtube.com/embed/" + match[7];
      return '<iframe width="80%" height="200px" src='+ src +' frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
   }
   else
   {
     var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
     var text1=content.replace(exp, '<a target="_blank" href="$1">$1</a>');
     var exp2 =/(^|[^\/])(www\.[\S]+(\b|$))/gim;
     return text1.replace(exp2, '$1<a target="_blank" href="http://$2">$2</a>');
   }


    }
  },
  mounted(){
    this.showPosts();
    setInterval(()=>{
      this.showPosts()
    },7000);
    console.log(this.$parent.$data.posts);
  },
}
</script> -->
