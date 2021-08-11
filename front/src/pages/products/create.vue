<template>
  <div class="row">
    <div class="col-xl-8 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Create product</h3>
            </div>
            <div class="col-4 text-right">
              <button class="btn btn-sm btn-primary" @click="createProduct">create</button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <errors :errors="errors"/>
          <form>
            <h6 class="heading-small text-muted mb-4">Base information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-name">Name</label>
                    <input type="text" id="input-name" class="form-control" v-model="product.name">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-slug">Slug</label>
                    <input type="email" id="input-slug" class="form-control" v-model="product.slug">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-price">Price</label>
                    <input type="text" id="input-price" class="form-control" v-model="product.price">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-quantity">Quantity</label>
                    <input type="text" id="input-quantity" class="form-control" v-model="product.quantity">
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <!-- Address -->
            <h6 class="heading-small text-muted mb-4">More information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label" for="input-address">Description</label>
                    <textarea v-model="product.description" class="form-control" rows="4"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <div class="pl-lg-4">
              <div class="form-group">
                <label class="form-control-label">Categories</label>
                <div class="form-group">
                  <select multiple style="height: 500px"  class="form-control" v-model="product.category_ids">
                    <option v-for="category in categories" :value="category.id" :key="'category-option-' + category.id">{{ category.name }}</option>
                  </select>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Errors from "@/components/Errors"
import isEmptyObject from "@/helpers/isEmptyObject"

export default {
  components: {Errors},
  data() {
    return {
      product: {
        name: null,
        slug: null,
        price: null,
        quantity: null,
        description: null,
        category_ids:[]
      }
    }
  },
  methods: {
    async createProduct() {
      await this.$store.dispatch('createProduct', this.product);

      if (isEmptyObject(this.errors)) {
        this.$router.push({name: 'product-edit', params: {id: this.$store.state.products.product.id}});
      }
    }
  },
  computed: {
    categories() {
      return this.$store.state.categories.categories;
    },
    errors() {
      return this.$store.state.products.errors;
    }
  },
  async mounted() {
    await this.$store.dispatch('getAllCategories');
  }
}
</script>