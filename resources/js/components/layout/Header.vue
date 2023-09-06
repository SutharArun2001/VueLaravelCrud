<script setup>
import { onMounted, ref } from 'vue';
import { useAuthStore } from '../../composable/auth';
const activePath = ref('');
const authStore = useAuthStore();
let userProfile = '';

onMounted(async () => {
    activePath.value = window.location.pathname;
    console.log(await authStore.getUser());
    userProfile = '/storage/profiles/'+authStore.authUser.profile_path;
});


</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li v-if="!authStore.user" class="nav-item">
                        <router-link class="rounded" to="/login">Login</router-link>
                    </li>
                    <li v-if="!authStore.user" class="nav-item">
                        <router-link class="rounded" to="/register">Register</router-link>
                    </li>
                    <li v-if="authStore.user"  class="nav-item">
                        
                    </li>
                    <li v-if="authStore.user">
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                                id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img :src="userProfile" alt="" width="32" height="32"
                                    class="rounded-circle me-2">
                                <strong>{{ authStore.authUser.first_name }}</strong>
                            </a>
                            <ul class="dropdown-menu text-small shadow start-10" aria-labelledby="dropdownUser2">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><router-link @click="authStore.hangleLogout" class="rounded" to="/logout">logout</router-link></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>
nav {
    background: #415fdf;
}

ul {
    display: flex;
    gap: 20px;
    list-style: none;
    text-decoration: none;
}

ul a {
    padding: 10px;
    text-decoration: none;
}

.dropdown-menu {
    display: none;
}

.dropdown-menu.show {
    display: block;
}
</style>