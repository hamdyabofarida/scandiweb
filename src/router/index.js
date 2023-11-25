import { createRouter, createWebHistory } from 'vue-router'
import ProductListView from '../views/ProductListView.vue'
import AddProductView from '../views/AddProductView.vue'

const routes = [
  {
    path: '/',
    name: 'ProductList',
    component: ProductListView
  },
  {
    path: '/addProduct',
    name: 'AddProduct',
    component: AddProductView
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
