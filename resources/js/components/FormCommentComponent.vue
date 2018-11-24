<template>
    <div class="">



<button class="btn btn-primary" type="button" name="button"><i class="fas fa-edit">{{type}}</i></button>





    </div>

</template>

<script>
    export default {
      props:['type'],
      data(){
        return  {

        }
      },


        mounted() {
            // console.log('Component mounted.');
        }
    }
</script>
