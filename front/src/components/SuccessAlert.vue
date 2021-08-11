<template>
  <div class="alert alert-success" role="alert">
    <strong>Success!</strong> {{ message }}
  </div>
</template>

<script>
export default {
  name: "SuccessAlert",
  props: ['message']
}
</script>

<style scoped>

</style>