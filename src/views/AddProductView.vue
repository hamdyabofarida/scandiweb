<template>
    <div class="AddProduct">
        <AddProductComponent />
    </div>
  </template>
  
  <script>
  // @ is an alias to /src
  import AddProductComponent from '@/components/AddProductComponent.vue'
  
  export default {
    name: 'AddProductView',
    components: {
      AddProductComponent
    }
  }
  </script>
  