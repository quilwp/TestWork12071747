<template>
  <div class="errors" v-if="errors">
    <template v-for="group in errors">
      <div class="alert alert-danger" v-for="(error, index) in group" :key="'error-' + index" >
        {{ error }}
      </div>
    </template>
  </div>
</template>

<script>
export default {
  name: "Errors",
  props: ['errors']
}
</script>

<style scoped>

</style>