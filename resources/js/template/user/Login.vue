<script setup>
import axios from 'axios';
import { useForm } from 'vee-validate';
import { onMounted } from 'vue';
import * as yup from 'yup';
import router from '../../route';

const {handleSubmit, errors, defineInputBinds, setErrors } = useForm({
    validationSchema: yup.object({
        email: yup.string().email().required(),
        password: yup.string().required(),
    }),
});
const email = defineInputBinds('email');
const password = defineInputBinds('password');

const onSubmit = handleSubmit((values) => {
    const userCredential = values;
    console.log(userCredential);
    axios.post('api/login', userCredential)
        .then((res) => {
            console.log(res);
            if(res.data.success) {
                router.push({
                    name: 'alluser',
                });
            }
        })
        .catch((res) => {                     
            if(res.response.data.error.email) {
                setErrors({email: res.response.data.error.email})
            } else {
                setErrors({password: res.response.data.error.password})
            }
        })


});
</script>
<template>
    <div class="container">
        <div class="title">Login</div>
        <form @submit="onSubmit">
            <div class="user_details">
                <div class="input_pox">
                    <span class="datails">email</span>
                    <input v-bind="email" placeholder="Enter your email " />
                    <span class="error">{{ errors.email }}</span>
                </div>
                <div class="input_pox">
                    <span class="datails">Password</span>
                    <input v-bind="password" type="password" placeholder="Enter password " />
                    <span class="error">{{ errors.password }}</span>
                </div>
            </div>
            <button class="vue-btn-primary" type="submit">Login</button>
        </form>
    </div>
</template>

<style scoped>
.container {
    max-width: 400px;
    width: 100%;
    background: #e3e3e3;
    padding: 25px 30px;
    border-radius: 5px;
}

.container .title {
    font-size: 25px;
    font-weight: 500;
    position: relative;
}

.container form .user_details {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: space-between;
}

form .user_details .input_pox {
    margin-bottom: 15px;
    margin: 12px 0;
}
.error {
    color: #f00;
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
    border-color: #9b59b6;
}
</style>