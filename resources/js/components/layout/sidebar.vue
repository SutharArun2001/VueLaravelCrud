<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light text-align-right">
    <div class="d-flex flex-column flex-shrink-0 p-3" style="width: 280px;">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Sidebar</span>
      </a>
      <hr>
        <ul class="navbar-nav d-flex px-2 flex-column">
          <li class="nav-item">
            <router-link class="p-2 rounded" to="/">
              <svg class="bi me-2" width="16" height="16">
              </svg>
              Main
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="p-2 rounded" to="/home">
              <svg class="bi me-2" width="16" height="16">
              </svg>
              Home
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="p-2 rounded" to="/alluser">
              <svg class="bi me-2" width="16" height="16">
              </svg>
              All Users
            </router-link>
          </li>
          <li class="nav-item">
            <router-link @click="authStore.hangleLogout" class="p-2 rounded" to="/logout">
              <svg class="bi me-2" width="16" height="16">
              </svg>
              Logout
            </router-link>
          </li>
        </ul>
    </div>
  </nav>
</template>

<script setup>
import { useAuthStore } from '../../composable/auth';
const authStore = useAuthStore();

</script>

<style scoped>
nav {
  background: #415fdf;
}

ul {
  display: flex;
  gap: 10px;
  list-style: none;
  text-decoration: none;
}

ul a {
  display: block;
  width: 100%;
  text-decoration: none;
}
</style>
