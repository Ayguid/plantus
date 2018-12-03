<template>
  <div v-if="this.$parent.authuser !== null" class="">
    <!-- <div class="post_button">
    <button id="post_button" type="button" name="button" v-on:click="displayForm(); resetParent_id()">PLANK IT!!</button>
  </div> -->


  <div id="post_input" class="card post_input">

    <div class="" v-if="parent_post">
      Le estas respondiendo a {{parent_post.user.name}}
      {{parent_post.id}}
    </div>
    <div class="" v-else>
      Estas Plankeandola
    </div>


    <form action="/" @submit="formSubmit" enctype="multipart/form-data">
      <div class="form-group">
        <textarea rows="4" id="content" class="form-control" type="text"  name="content"  placeholder="Post Something" required></textarea>
      </div>
      <div class="form-group">
        <input id="has_image"class="form-control-file" v-on:change="onImageChange" type="file" placeholder="Something cool" multiple>
      </div>
      <input v-if="parent_post" type="text" name="parent_id" :value="parent_post.id" hidden>
      <button id="submitPost"  type="submit" class="btn btn-primary">Submit</button>
    </form>


  </div>
  <br>





</div>
</template>

<script>
export default {
  props:['parent_post'],
  data(){
    return  {
      success:'',
      content:'',
      has_image: '',
      location:'',
    }
  },


  methods: {

    onImageChange(e){

      if (parseInt(e.target.files.length) > 3){
        alert("You are only allowed to upload a maximum of 3 files");
        e.target.value = null;
        return;
      }
      this.has_image = e.target.files;
    },
    formSubmit(e) {
      e.preventDefault();
      var currentObj = this;
      const config = {
        headers: {'content-type': 'multipart/form-data'}
      }
      var formData = new FormData(e.target);
      formData.append('location', currentObj.location);
      for( var i = 0; i < this.has_image.length; i++ ){
        var files = this.has_image[i];
        formData.append('has_image[' + i + ']', files);
      }
      axios.post('api/upload', formData, config)
      .then(function (response) {
        if (response.data.success) {
          var post = response.data.success;
          currentObj.$emit('push-post', post);
          e.target.reset();
        }
        if (response.data.errors) {
          alert(JSON.stringify(response.data.errors));
        }
      })
      .catch(function (error) {
        currentObj.output = error;
      });
    },
    getLocation(){
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(this.returnPosition);
      }
      else{
        console.log('location-error');
      }
    },
    returnPosition(position) {
      this.location = JSON.stringify({
        latitude:position.coords.latitude,
        longitude:position.coords.longitude
      });
    },
  },


  mounted(){
    this.getLocation();
  }

}
</script>
