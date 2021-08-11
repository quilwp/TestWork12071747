<template>
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scroll-wrapper scrollbar-inner" style="position: relative;">
      <div class="scrollbar-inner scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 535px;">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="https://demos.creative-tim.com/argon-dashboard/assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item" v-for="(item, index) in menu" :key="'menu-' + index">
              <router-link class="nav-link" :to="{name: item.route}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">{{ item.name }}</span>
              </router-link>
            </li>
          </ul>
        </div>
      </div>
      </div>
    </div>
  </nav>
</template>
<script>
    export default {
      name: 'Sidebar',
      data() {
        return {
          menu: [
            {
              name: 'Products',
              route: 'products'
            },
            {
              name: 'Categories',
              route: 'categories'
            }
          ]
        }
      }
    }
</script>