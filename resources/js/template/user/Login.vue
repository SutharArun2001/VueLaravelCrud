<script setup>
import axios from 'axios';
import { useForm } from 'vee-validate';
import { onMounted, ref } from 'vue';
import * as yup from 'yup';
import router from '../../route';
import { useAuthStore } from '../../composable/auth';

const authUser = useAuthStore();

const user = ref({
    email: '',
    password: ''
});

onMounted(async () => {
    await authUser.setErrors();
});

const {handleSubmit, errors, defineInputBinds, setErrors } = useForm({
    validationSchema: yup.object({
        email: yup.string().email().required(),
        password: yup.string().required(),
    }),
});
const email = defineInputBinds('email');
const password = defineInputBinds('password');

// const onSubmit = handleSubmit((values) => {
//     authUser.hangleLogin(user);
// });
</script>
<template>
    <div class="container">
        <div class="login-container">
            <div class="title">Login</div>
            <form @submit.prevent="authUser.hangleLogin(user)">
                <div class="user_details">
                    <div class="input_pox">
                        <span class="datails">email</span>
                        <input v-model="user.email" placeholder="Enter your email " />
                        <span v-if="authUser.errors.email" class="error">{{ authUser.errors.email[0] }}</span>
                    </div>
                    <div class="input_pox">
                        <span class="datails">Password</span>
                        <input v-model="user.password" type="password" placeholder="Enter password " />
                        <span v-if="authUser.errors.password" class="error">{{ authUser.errors.password[0] }}</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Login</button>
            </form>
        </div>
    </div>
</template>

<style scoped>
.container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: calc(100% - 70px);
}
.login-container {
    max-width: 400px;
    box-shadow: 2px 2px 10px #cccccc;
    border-radius: 16px;
    width: 100%;
    padding: 25px 30px;
}

.login-container .title {
    font-size: 25px;
    font-weight: 500;
    position: relative;
}

.login-container form .user_details {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: space-between;
}

form .user_details .input_pox {
    margin-bottom: 15px;
    margin: 12px 0;
}

.user_details .input_pox .datails {
    display: block;
    font-weight: 500;
    margin-bottom: 5px;
}

.user_details .input_pox input {
    height: 35px;
    width: 100%;
    outline: none;
    border-radius: 5px;
    border: 1px solid #ccc;
    padding-left: 15px;
    font-size: 16px;
    border-bottom-width: 2px;
    transition: all 0.3s ease;

}

.user_details .input_pox input:focus,
.user_details .input_pox input:valid {
    border-color: #0d6efd;
}
</style>