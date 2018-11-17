<style scoped>
.menuCat{
  overflow: hidden;
}
.menuCatItem{
  width: 25%;
  float: left;
  text-align: center;
}
</style>


<template>
<div class="">


    <div class="menuCat">
      <button class="menuCatItem" v-for="category in categories" type="button" name="button" @click="filterByCategory(category.post_category_id)">{{category.category_description}}</button>
      <button class="menuCatItem" type="button" name="button" :value="defaultCat" @click="filterByCategory(defaultCat)">ALL Cats</button>
    </div>


</div>
</template>

<script>
export default {
  data(){
    return  {
      defaultCat:"",
      categories:[],
    }
  },
  //
  //
  //
  methods:{
    getCategories() {
      axios.get('api/categories').then((response) => {
        this.categories = response.data;
        // console.log(this.categories);
      });
    },
    filterByCategory(category_id){
        this.$emit('filter-category', category_id);
    },
},
  mounted() {
    this.getCategories();
    // console.log('Component mounted.');
  }
}
</script>
