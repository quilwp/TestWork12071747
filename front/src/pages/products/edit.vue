<template>
  <div class="row">
    <div class="col-xl-8 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Edit product</h3>
            </div>
            <div class="col-4 text-right">
              <button class="btn btn-sm btn-danger" @click="deleteProduct">delete</button>
              <button class="btn btn-sm btn-primary" @click="updateProduct">save</button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <errors :errors="errors" />
          <success-alert message="Product updated!" v-if="isUpdated" />
          <form>
            <h6 class="heading-small text-muted mb-4">Base information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-username">Name</label>
                    <input type="text" id="input-username" class="form-control" placeholder="Name" v-model="product.name">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-email">Slug</label>
                    <input type="email" id="input-email" class="form-control" v-model="product.slug" placeholder="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-first-name">Price</label>
                    <input type="text" id="input-first-name" class="form-control" placeholder="First name" v-model="product.price">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-last-name">Quantity</label>
                    <input type="text" id="input-last-name" class="form-control" placeholder="Last name" v-model="product.quantity">
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <!-- Address -->
            <h6 class="heading-small text-muted mb-4">Contact information</h6>
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
                  <select multiple style="height: 500px"  class="form-control" v-model="selectedCategories">
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
  import SuccessAlert from "@/components/SuccessAlert"
  import isEmptyObject from "@/helpers/isEmptyObject"

  export default {
    components: {SuccessAlert, Errors},
    data() {
      return {
        selectedCategories:[],
        isUpdated: false
      }
    },
    methods: {
      deleteProduct() {
        this.$store.dispatch('deleteProduct', this.product.id)
        this.$router.back();
      },
      async updateProduct() {
        let product = this.product;

        await this.$store.dispatch('updateProduct', {
          id: product.id,
          data: {
            name: product.name,
            slug: product.slug,
            price: product.price,
            quantity: product.quantity,
            description: product.description,
            category_ids: this.selectedCategories
          }
        })

        isEmptyObject(this.errors) ? this.isUpdated = true : this.isUpdated = false

      }
    },
    computed: {
      product() {
        return this.$store.state.products.product
      },
      categories() {
        return this.$store.state.categories.categories
      },
      errors() {
        return this.$store.state.products.errors
      }
    },
    async mounted() {
      await this.$store.dispatch('getProduct', this.$route.params.id)

      if (this.product == null) {
        await this.$router.push({name: '404'});
      }

      await this.$store.dispatch('getAllCategories')


      this.selectedCategories = this.product.categories.map((category) => category.id)
    },
    beforeDestroy() {
      this.$store.dispatch('resetProductState')
    }
  }
</script>