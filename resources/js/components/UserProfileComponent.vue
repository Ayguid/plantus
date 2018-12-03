<template>
  <div class="container">



    <div class="row justify-content-center">
      {{this.$root.authuser.name}}
      <!-- <div v-if="editMode" class="">
        <form action="/" @submit="formSubmit">
          <input type="text" name="name" :value="this.$root.authuser.name">&nbsp;
          <button @click="editMode=false"   class="btn btn-danger"><i class="fas fa-times"></i></button>
          <button id="submitPost"  type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
        </form>
      </div>
      <div v-else class="">
        {{this.$root.authuser.name}} <i @click="editMode=true" class="far fa-edit"></i>
      </div>
      <br>
      <br> -->
    </div>


    <feed-component :user_id="this.$root.authuser.id"></feed-component>



  </div>
</template>

<script>
export default {

  data(){
    return {
      editMode:null,
    }
  },

  methods:{
    // formSubmit(e) {
    //   e.preventDefault();
    //   var currentObj = this;
    //   var formData = new FormData(e.target);
    //   axios.post('api/user', formData)
    //   .then(function (response) {
    //     var userName = document.getElementById('userName');
    //     currentObj.authuser.name = userName.innerHTML = response.data.name;
    //     // this.$root.authuser.name = response.data.name;
    //     currentObj.editMode = null;
    //   })
    //   .catch(function (error) {
    //     currentObj.output = error;
    //   });
    // },
  },

  mounted() {
    console.log('Component mounted.');
  }
}
</script>
