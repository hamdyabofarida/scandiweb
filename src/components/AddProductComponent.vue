<template>
  <div class="container">
    <header>
      <h2>Product Add</h2>
      <div class="action">
        <button id="save" class="action-button" @click="addProductRequest()">Save</button>
        <button id="cancel" class="action-button"><router-link to="/">Cancel</router-link></button>
      </div>
    </header>
    <form name="form" id="product_form">
      <div class="input">
        <span ref="sku" name="error" class="error hidden sku">This field is required</span>
        <input v-model="sku" type="text" id="sku" name="sku" class="input-field valid" />
        <label class="input-label">SKU</label>
      </div>
      <div class="input">
        <span ref="name" name="error" class="error hidden name">This field is required</span>
        <input v-model="name" type="text" id="name" name="name" class="input-field valid" />
        <label class="input-label">Name</label>
      </div>
      <div class="input">
        <span ref="price" name="error" class="error hidden price">This field is required</span>
        <input v-model="price" type="number" id="price" name="price" class="input-field valid" />
        <label class="input-label">Price</label>
      </div>
      <div class="input">
        <span ref="type" name="error" class="error hidden type">This field is required</span>
        <select @change="getAttributes()" v-model="type" class="input-field select valid" name="type" id="productType">
          <option value="DefaultType" disabled>Type Switcher</option>
          <option value="DVD">DVD</option>
          <option value="Book">Book</option>
          <option value="Furniture">Furniture</option>
        </select>
      </div>
      <div id="attributes">
        <div v-for="attribute in attributes" :key="attribute['attr']" class="input">
          <input type="number" v-model="formValues[attribute['attr']]" :id="attribute['attr']" :name="attribute.attr"
            class="input-field valid">
          <label class="input-label">{{ attribute['attr'] }} ( {{ attribute.unit }} )</label>
          <span :ref="attribute['attr']" :class="'error hidden ' + attribute['attr']">This field is required</span>
        </div>
      </div>
    </form>
  </div>
</template>
  
<script>
import axios from 'axios';
import router from '@/router';
export default {
  name: 'AddProductComponent',
  data() {
    return {
      host: "./backend/init.php",
      name: '',
      sku: '',
      price: '',
      type: 'DefaultType',
      addProduct: true,
      formValues: {},
      attributes: [],
      errors: [],
      refsSpans: {}
    }
  },
  methods: {
    getAttributes() {
      axios
        .post(this.host, {
          type: this.type,
          getAttr: true
        })
        .then(response => this.attributes = response.data)
    },
    setFormValues() {
      this.formValues['sku'] = this.sku;
      this.formValues['name'] = this.name;
      this.formValues['price'] = this.price;
      this.formValues['type'] = this.type;
      this.formValues['addProduct'] = this.addProduct;
      for (let i = 0; i < this.attributes.length; i++) {
        if (typeof this.formValues[this.attributes[i]['attr']] == 'undefined') {
          this.formValues[this.attributes[i]['attr']] = ''
        }
      }
    },
    addProductRequest() {
      this.setFormValues();
      axios
        .post(this.host, JSON.stringify(this.formValues))
        .then(response => {
          if (response.data == 'succeed') {
            router.push({ name: 'ProductList' })
          } else {
            this.errors = response.data
            let difference = Object.keys(this.$refs).filter(x => !Object.keys(this.errors).includes(x));
            Object.keys(this.errors).forEach((error) => {
              if (typeof this.$refs[error] !== 'undefined') {
                let spanError = Array.isArray(this.$refs[error]) ? this.$refs[error][0] : this.$refs[error]

                if (spanError.classList.contains('hidden')) {
                  spanError.classList.remove("hidden")
                }
                spanError.innerText = this.errors[error]
              }
            });
            if (difference) {
              for (let i = 0; i < difference.length; i++) {
                let differenceEl = Array.isArray(this.$refs[difference[i]]) ? this.$refs[difference[i]][0] : this.$refs[difference[i]]
                differenceEl.classList.add("hidden")
              }
            }
          }
        })
    }
  }

}
</script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>
  