<template>
  <div class="container">



    <div v-if="this.$root.authuser" class="">
      <h3>User Details</h3>
      <div class="">
        <strong>Name </strong>{{$root.authuser.name}}<br>
        <strong>Email </strong>{{$root.authuser.email}}<br>
      </div>
      <br>

      <h3>Followers</h3>{{$root.authuser.my_followers.length}}
      <div class="" v-for="follower in $root.authuser.my_followers">
        <strong>{{follower.name}}</strong>
        {{follower.email}}
      </div>
      <br>
      <h3>Following</h3>{{$root.authuser.my_followers.length}}
      <div class="" v-for="followE in $root.authuser.i_follow">
        <strong>{{followE.name}}</strong>
        {{followE.email}}
      </div>
      <br>

    </div>


    <!-- <div class="">
    {{$root.authuser.name}}
  </div> -->
  <!-- <div v-if="editMode" class="">
  <form action="/" @submit="formSubmit">
  <input type="text" name="name" :value="$root.authuser.name">&nbsp;
  <button @click="editMode=false"   class="btn btn-danger"><i class="fas fa-times"></i></button>
  <button id="submitPost"  type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
</form>
</div>
<div v-else class="">
{{$root.authuser.name}} <i @click="editMode=true" class="far fa-edit"></i>
</div>
<br>
<br> -->


<feed-component :user_id="$root.authuser.id"></feed-component>



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
    // console.log('Component mounted.');
  }
}
</script>
