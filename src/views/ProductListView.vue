<template>
  <div class="ProductList">
    <ProductListComponent />
  </div>
</template>
  
<script>
// @ is an alias to /src
import ProductListComponent from '@/components/ProductListComponent.vue'

export default {
  name: 'ProductListView',
  components: {
    ProductListComponent
  }
}
</script>
  