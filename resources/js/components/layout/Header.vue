<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import useUser from '../../composable/users';
import { useAuthStore } from '../../composable/auth';
const activePath = ref('');
const authStore = useAuthStore();
onMounted(() => {
    activePath.value = window.location.pathname;
});

</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light text-align-right">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li v-if="authStore.user" class="nav-item">
                        <router-link to="/">Main</router-link>
                    </li>
                    <li v-if="authStore.user" class="nav-item">
                        <router-link to="/home">Home</router-link>
                    </li>
                    <!-- <li class="nav-item">
                <router-link to="/signup">SignUp</router-link>
                </li> -->
                    <li v-if="!authStore.user" class="nav-item">
                        <router-link to="/login">Login</router-link>
                    </li>
                    <li v-if="!authStore.user" class="nav-item">
                        <router-link to="/register">Register</router-link>
                    </li>
                    <li v-if="authStore.user" @click="authStore.hangleLogout" class="nav-item">
                        <router-link to="/logout">logout</router-link>
                    </li>
                    <li v-if="authStore.user" class="nav-item">
                        <router-link to="/alluser">All Users</router-link>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                                id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                                    class="rounded-circle me-2">
                                <strong>mdo</strong>
                            </a>
                            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Sign out</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <hr>
            </div>
        </div>
    </nav>
</template>

<style scoped>
header {
    padding: 30px 20px;
}

ul {
    display: flex;
    gap: 20px;
    list-style: none;
    text-decoration: none;
}

ul a {
    color: #000;
    text-decoration: none;
}
</style>