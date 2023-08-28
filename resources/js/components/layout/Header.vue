<script setup>
import { onMounted, ref } from 'vue';
const activePath = ref('');

onMounted(() => {
  activePath.value = window.location.pathname;
  console.log(window.location.pathname);
  console.log(activePath.value);
})

function setActivePath(e){
  activePath.value = e.target.innerText;
}
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link @click="setActivePath" to="/">Main</router-link>
        </li>
        <li class="nav-item">
          <router-link @click="setActivePath" to="/home">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link @click="setActivePath" to="/signup">SignUp</router-link>
        </li>
        <li class="nav-item">
          <router-link @click="setActivePath" v-if="activePath != 'SignUp' && activePath != '/signup'" to="/login">Login</router-link>
        </li>
        <li class="nav-item">
          <router-link @click="setActivePath" to="/register">Register</router-link>
        </li>
        <li class="nav-item">
          <router-link @click="setActivePath" to="/alluser">All Users</router-link>
        </li>
      </ul>
    </div>
  </div>
</nav>
</template>

<style scoped>
  header{
    padding: 30px 20px;
  }

  ul{
    display: flex;
    gap: 20px;
    list-style: none;
    text-decoration: none;
  }

  ul a{
    color: #000;
    text-decoration: none;
  }
</style>