<template>
  <div v-if="authuser !== null" class="">




    <div class="post_button">
      <button id="post_button" type="button" name="button">PLANK IT!!</button>
    </div>


    <div id="post_input" class="card post_input">

      <form action="/" @submit="formSubmit" enctype="multipart/form-data">

        <div class="form-group">
          <textarea rows="4" id="content" class="form-control" type="text"  name="content"  placeholder="Post Something" required></textarea>
        </div>
        <div class="form-group">
          <input id="has_image"class="form-control-file" v-on:change="onImageChange" type="file" placeholder="Something cool" multiple>
        </div>

        <select class="" name="post_category_id">
          <option selected value="">Elegi cat si queres</option>
          <option v-for="category in categories"
          :value="category.id" >{{category.category_description}}</option>
        </select>

        <button id="submitPost"  type="submit" class="btn btn-primary">Submit</button>

      </form>


    </div>
    <br>





  </div>
</template>

<script>
export default {

  data(){
    return  {
      success:'',
      categories:[],
      content:'',
      has_image: '',
      location:'',
      authuser:window.Laravel.user,
      authadmin:window.Laravel.admin
    }
  },


  methods: {
    getCategories() {
      axios.get('api/categories').then((response) => {
        this.categories = response.data;
      });
    },
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
        // navigator.geolocation.watchPosition(this.returnPosition);
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
    this.getCategories();
  }

}
</script>
