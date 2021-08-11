<template>
  <div class="row">
    <div class="col-xl-8 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Edit category</h3>
            </div>
            <div class="col-4 text-right">
              <button class="btn btn-sm btn-danger" @click="deleteCategory">delete</button>
              <button class="btn btn-sm btn-primary" @click="updateCategory">save</button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <errors :errors="errors" />
          <form>
            <h6 class="heading-small text-muted mb-4">Base information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-username">Name</label>
                    <input type="text" id="input-username" class="form-control" placeholder="Name" v-model="category.name">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-email">Slug</label>
                    <input type="email" id="input-email" class="form-control" v-model="category.slug" placeholder="">
                  </div>
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
import Errors from "@/components/Errors";
export default {
  components: {Errors},
  data() {
    return {

    }
  },
  methods: {
    async deleteCategory() {
      await this.$store.dispatch('deleteCategory', this.category.id);
      this.$router.back();
    },
    async updateCategory() {
      await this.$store.dispatch('updateCategory', {
        id: this.category.id,
        data: {
          name: this.category.name,
          slug: this.category.slug
        }
      });
    }
  },
  computed: {
    category() {
      return this.$store.state.categories.category;
    },
    errors() {
      return this.$store.state.categories.errors;
    }
  },
  async mounted() {
    await this.$store.dispatch('getCategory', this.$route.params.id);

    if (this.category == null) {
      this.$router.push({name: '404'});
    }
  },
  beforeDestroy() {
    this.$store.dispatch('resetCategoryState');
  }
}
</script>