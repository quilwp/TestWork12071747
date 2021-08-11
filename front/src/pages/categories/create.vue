<template>
  <div class="row">
    <div class="col-xl-8 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Create category</h3>
            </div>
            <div class="col-4 text-right">
              <button class="btn btn-sm btn-primary" @click="createCategory">create</button>
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
                    <input type="text" id="input-name" class="form-control" v-model="category.name">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-slug">Slug</label>
                    <input type="text" id="input-slug" class="form-control" v-model="category.slug">
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
import isEmptyObject from "@/helpers/isEmptyObject";

export default {
  components: {Errors},
  data() {
    return {
      category: {
        name: null,
        slug: null,
      }
    }
  },
  methods: {
    async createCategory() {
      await this.$store.dispatch('createCategory', this.category);

      if (isEmptyObject(this.errors)) {
        this.$router.push({name: 'category-edit', params: {id: this.$store.state.categories.category.id}})
      }
    }
  },
  computed: {
    errors() {
      return this.$store.state.categories.errors;
    }
  }
}
</script>