<template>
  <nav>
    <ul class="pagination justify-content-end mb-0">
      <li class="page-item" :class="{active: page == params.currentPage}" v-for="(page, index) in params.totalPages" :key="'paginate-page-' + index">
        <a href="#" @click.prevent="changePage(page)" class="page-link">{{ page }}</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "Pagination",
  props: ['params'],
  methods: {
    changePage(page) {
      this.$emit('changePage', page);
    }
  }
}
</script>

<style scoped>

</style>