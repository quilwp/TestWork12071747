<template>
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <div class="row">
            <div class="col-lg-10">
              <h3 class="mb-0">Categories</h3>
            </div>
            <div class="col-lg-2 text-right">
              <router-link :to="{name: 'category-create'}" class="btn btn-sm btn-default">Add category</router-link>
            </div>
          </div>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
            <tr>
              <th scope="col" >#</th>
              <th scope="col" >Name</th>
              <th scope="col">Last modify</th>
              <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="list">
            <tr v-for="category in categories" :key="'product-' + category.id">
              <td scope="row">
                  {{ category.id }}
              </td>
              <td scope="row">
                <router-link :to="{ name:'category-edit', params: {id: category.id} }" class="media align-items-center">
                  <!--                        <a href="#" class="avatar rounded-circle mr-3">-->
                  <!--                          <img alt="Image placeholder" src="">-->
                  <!--                        </a>-->
                  <div class="media-body">
                    <span class="name mb-0 text-sm">{{ category.name }}</span>
                  </div>
                </router-link>
              </td>

              <td>
                {{ category.last_modify }}
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
    loadCategories(page) {
      this.$store.commit('SET_CATEGORIES_PAGE', page);
      this.$store.dispatch('getCategories');
    },
    changePage(page) {
      this.loadCategories(page)
    }
  },
  computed: {
    categories() {
      return this.$store.state.categories.categories;
    },
    pagination() {
      return this.$store.state.categories.pagination;
    }
  },
  mounted() {
    this.loadCategories(1);
  }
}
</script>