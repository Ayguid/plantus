<template>
  <div class="container">
    <div class="row justify-content-center">


      <div v-if="editMode" class="">
        <form action="/" @submit="formSubmit">
          <input type="text" name="name" :value="authuser.name">&nbsp;
          <button @click="editMode=false"   class="btn btn-danger"><i class="fas fa-times"></i></button>
          <button id="submitPost"  type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
        </form>
      </div>

      <div v-else class="">
        {{authuser.name}} <i @click="editMode=true" class="far fa-edit"></i>
      </div>

      <br>
      <br>





    </div>
  </div>

</template>

<script>
export default {

  data(){
    return {
      editMode:null,
      authuser:window.Laravel.user,
    }
  },

  methods:{
    formSubmit(e) {
      e.preventDefault();
      var currentObj = this;
      var formData = new FormData(e.target);
      axios.post('api/user', formData)
      .then(function (response) {
        var userName = document.getElementById('userName');
        currentObj.authuser.name = userName.innerHTML = response.data.name;
        currentObj.editMode = null;
      })
      .catch(function (error) {
        currentObj.output = error;
      });
    },
  },

  mounted() {
    console.log('Component mounted.')
  }
}
</script>
