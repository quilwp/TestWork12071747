<template>
    <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <div class="row">
                <div class="col-lg-10">
                  <h3 class="mb-0">Products</h3>
                </div>
                <div class="col-lg-2 text-right">
                  <router-link :to="{name: 'product-create'}" class="btn btn-sm btn-default">Add product</router-link>
                </div>
              </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" >Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Last modify</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                  <tr v-for="product in products" :key="'product-' + product.id">
                    <td>
                      {{ product.id }}
                    </td>
                    <td>
                      <router-link :to="{ name:'product-edit', params: {id: product.id} }" class="media align-items-center">
<!--                        <a href="#" class="avatar rounded-circle mr-3">-->
<!--                          <img alt="Image placeholder" src="">-->
<!--                        </a>-->
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ product.name }}</span>
                        </div>
                      </router-link>
                    </td>
                    <td class="budget">
                      ${{ product.price }} USD
                    </td>
                    <td>
                      {{ product.quantity }}
                    </td>
                    <td>
                      {{ product.last_modify }}
                    </td>
                    <td class="text-right">

                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
              <pagination v-if="pagination" @changePage="changePage" :params="pagination" />
            </div>
          </div>
        </div>
      </div>
</template>
<script>
import Pagination from "@/components/Pagination";
export default {
  components: {
    Pagination
  },
  methods: {
    loadProducts(page) {
      this.$store.commit('SET_PAGE', page);
      this.$store.dispatch('getProducts');
    },
    changePage(page) {
      this.loadProducts(page)
    }
  },
  computed: {
    products() {
      return this.$store.state.products.products;
    },
    pagination() {
      return this.$store.state.products.pagination;
    }
  },
  mounted() {
    this.loadProducts(1);
  }
}
</script>