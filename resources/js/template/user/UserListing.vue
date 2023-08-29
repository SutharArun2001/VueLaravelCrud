<template>
    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SR No.</th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">email</th>
                    <th scope="col">phone number</th>
                    <th scope="col">gender</th>
                    <th scope="col">action</th>
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
        <div v-if="open" class="modalss">
            <p>Are you sure you want Delete!</p>
            <button @click="open = false">No</button>
            <button @click="deleteUser(user.id)">Yes</button>
        </div>
    </Transition>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
let users = ref([]);
let open = ref(false);
const routes = useRouter();

onMounted(() => {
    getAllUsers()
});

async function getAllUsers() {
    await axios.get('/api/user/index')
        .then(function (res) {
            users.value = res.data.users;
        })
        .catch(error => {
            if (error.response.status === 422) {
                backError.email = error.response.data.errors.email[0];
            }
        });
}

function openModals(id) {
    open.value = true;
}

function deleteUser(id) {
    axios.get(`/api/user/delete/${id}`)
        .then(function (res) {
            getAllUsers();
        })
        .catch(error => {
            if (error.response.status === 422) {
                backError.email = error.response.data.errors.email[0];
            }
        });
}
</script>

<style scoped>
.modalss {
  position: fixed;
  padding: 22px 24px;
  border-radius: 8px;
  box-shadow: #cccccc;
  margin-bottom: 1.2em;
  transition: background-color .5s ease;
  box-shadow: 4px 4px 10px #0000003d;
  background-color: #fff;
  z-index: 999;
  top: 20%;
  left: 50%;
  width: 300px;
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
</style>