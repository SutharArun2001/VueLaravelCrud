<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
const activePath = ref('');

onMounted(() => {
  activePath.value = window.location.pathname;
})

function setActivePath(e){
  activePath.value = e.target.innerText;
  if(activePath.value == '/logout') {
    axios.post('/api/logout')
    .then((res) => {
      console.log(res);
    })
    .catch((error) => {
      console.log(error);
    })
  }
}
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link @click="setActivePath" to="/">Main</router-link>
        </li>
        <li class="nav-item">
          <router-link @click="setActivePath" to="/home">Home</router-link>
        </li>
        <!-- <li class="nav-item">
          <router-link @click="setActivePath" to="/signup">SignUp</router-link>
        </li> -->
        <li class="nav-item">
          <router-link @click="setActivePath" v-if="activePath != 'SignUp' && activePath != '/signup'" to="/login">Login</router-link>
        </li>
        <li class="nav-item">
          <router-link @click="setActivePath" to="/register">Register</router-link>
        </li>
        <li class="nav-item">
          <router-link @click="setActivePath" to="/logout">logout</router-link>
        </li>
        <li class="nav-item">
          <router-link @click="setActivePath" to="/alluser">All Users</router-link>
        </li>
      </ul>
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