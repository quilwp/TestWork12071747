<template>
  <div id="app">
    <sidebar />
    <div class="main-content">
      <navbar />
      <header-layout />
      <div class="container-fluid mt--6">
          <router-view />
      </div>
    </div> 
  </div>
</template>

<script>

import Sidebar from '@/components/layout/Sidebar'
import Navbar from '@/components/layout/Navbar'
import HeaderLayout from '@/components/layout/Header'

export default {
  name: 'App',
  components: {
    Sidebar,
    Navbar, 
    HeaderLayout
  }
}
</script>
