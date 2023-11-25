<template>
  <div class="container">
    <header>
      <h2>Product List</h2>
      <div class="action">
        <button id="add" class="action-button"><router-link to="/addProduct">ADD</router-link></button>
        <button @click="massDelete()" id="delete-product-btn" name="delete" class="action-button">MASS DELETE</button>
      </div>
    </header>
    <section class="checkbox-group"></section>
    <section class="checkbox-group">
      <div class="checkbox" v-for="product in products" :key="product.sku">
        <label class="checkbox-wrapper">
          <input class="checkbox-input delete-checkbox" type="checkbox" :value="product.sku" v-model="checkedProducts"
            :id="product.sku">
          <span class="checkbox-tile">
            <span class="checkbox-label">{{ product.sku }}<br></span>
            <span class="checkbox-label">{{ product.name }}<br></span>
            <span class="checkbox-label">{{ product.price }}<br></span>
            <span class="checkbox-label">{{ product.front_end }}<br></span>
          </span>
        </label>
      </div>
    </section>
  </div>
</template>
  
<script>
import axios from "axios";
export default {
  name: 'ProductListComponent',
  data() {
    return {
      host: "./backend/init.php",
      products: [],
      checkedProducts: [],
      toDelete: {}

    }
  },
  methods: {
    getProducts() {
      axios
        .get(this.host)
        .then(response => {
          console.log(response.data)
          this.products = response.data
        })
    },
    massDelete() {
      this.toDelete['toDelete'] = this.checkedProducts
      axios
        .post(this.host, JSON.stringify(this.toDelete))
        .then(response => {
          console.log(response)
          this.getProducts()
        })
    }
  },
  mounted() {
    this.getProducts();
  }
}

</script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  