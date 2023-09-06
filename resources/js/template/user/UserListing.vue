<template>
    <h2 class="py-2">All Users</h2>
    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SR No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Gender</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="user.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ user.id }}</td>
                    <td>{{ user.first_name }} {{ user.last_name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.phone_number }}</td>
                    <td>{{ user.gender }}</td>
                    <td><router-link :to="{ name: 'useredit', params: { id: user.id } }">Edit</router-link></td>
                    <td><button @click="openModals(user.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <Transition name="modals">
        <div v-if="modalOpen" class="modalss">
            <div class="content">
                <p>Are you sure you want Delete!</p>
                <button @click="modalOpen = false">No</button>
                <button @click="deleteUser(user)">Yes</button>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import useUser from '../../composable/users';
import { useAuthStore } from '../../composable/auth';

const authStore = useAuthStore();
const { users, getUsers, deleteUser, modalOpen } = useUser();
let user = ref(0);

onMounted(async () => {
    await authStore.getUser();
    getUsers();
});

function openModals(id) {
    modalOpen.value = true;
    user.value = id;
}
</script>

<style scoped>
.modalss {
    width: 400px;
    height: 200px;
    position: fixed;
    padding: 22px 24px;
    border-radius: 8px;
    margin-bottom: 1.2em;
    box-shadow: 4px 4px 10px #0000003d;
    background-color: #fff;
    z-index: 999;
    top: 20%;
    left: 50%;
    margin-left: -150px;
}

.modalss button {
    background-color: #cccccc;
    transition: background-color .5s;
    padding: 5px 12px;
    border: 1px solid #cccccc;
    border-radius: 8px;
    font-size: .9em;
    font-weight: 600;
}

.modals-enter-active,
.modals-leave-active {
    transition: all 0.5s ease;
}

.modals-enter-from,
.modals-leave-to {
    opacity: 0;
    /* transform: translateY(5px); */
    transform: scale(1.1);
}
.modalss .content {
    text-align: center;
    vertical-align: middle;
}

table a {
    text-decoration: none;
    color: #000;
}

table th,
table td {
    text-align: center;
    padding: 10px 10px;
}
</style>