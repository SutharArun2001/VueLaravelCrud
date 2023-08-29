<script setup>
import axios from 'axios';
import { useForm } from 'vee-validate';
import { ref } from 'vue';
import * as yup from 'yup';
import { useRouter } from 'vue-router';

const { handleSubmit, errors, defineInputBinds, setFieldValue } = useForm({
    initialValues: {
        gender: 'male', // Initialize the gender field
    },
    validationSchema: yup.object({
        firstname: yup.string().required(),
        lastname: yup.string().required(),
        username: yup.string().required(),
        email: yup.string().email().required(),
        gender: yup.string().required(),
        phonenumber: yup.string().matches(/^[0-9]+$/, 'Phone number must be a valid integer').min(10).max(10).required(),
        password: yup.string().oneOf([yup.ref('confirmPassWord'),null],"Passwords Not match").required(),
        confirmPassWord: yup.string().required('Confirm Password field required.'),
    }),
});

const firstname = defineInputBinds('firstname');
const lastname = defineInputBinds('lastname');
const username = defineInputBinds('username');
const email = defineInputBinds('email');
const phonenumber = defineInputBinds('phonenumber');
const password = defineInputBinds('password');
const confirmPassWord = defineInputBinds('confirmPassWord');
const gender = ref('male');
const router = useRouter();

// for handle gender validation
const handleGenderChange = (selectedGender) => {
    setFieldValue('gender', selectedGender);
};

// handle on-submit validation and API
const onSubmit = handleSubmit((values) => {
    const newUser = values;
    axios.post('api/user/create', newUser)
        .then(function () {
            router.push({
                name: 'alluser'
            })
        })
        .catch(error => {
            if(error.response.status === 422) {
                backError.email = error.response.data.errors.email[0];
            }
    });
});
</script>

<template>
    <div class="container">
        <div class="title">Registeration</div>
        <form @submit="onSubmit">
            <div class="user_details">
                <div class="input_pox">
                    <span class="datails">First Name</span>
                    <input v-bind="firstname" placeholder="Enter your firstname " />
                    <span class="error">{{ errors.firstname }}</span>

                </div>
                <div class="input_pox">
                    <span class="datails">Last Name</span>
                    <input v-bind="lastname" placeholder="Enter your lastname " />
                    <span class="error">{{ errors.lastname }}</span>
                </div>
                <div class="input_pox">
                    <span class="datails">username</span>
                    <input v-bind="username" placeholder="Enter your username " />
                    <span class="error">{{ errors.username }}</span>
                </div>
                <div class="input_pox">
                    <span class="datails">email</span>
                    <input v-bind="email" placeholder="Enter your email " />
                    <span class="error">{{ errors.email }}</span>
                </div>
                <div class="input_pox">
                    <span class="datails">Phone Number</span>
                    <input v-bind="phonenumber" placeholder="Enter your phonenumber " />
                    <span class="error">{{ errors.phonenumber }}</span>
                </div>
                <div class="input_pox">
                    <span class="datails"> Gender</span>
                    <div class="category">
                        <input type="radio" name="gender" id="dot-1" value="male" @change="handleGenderChange('male')" v-model="gender">
                        <span>Male</span>
                        <input type="radio" name="gender" id="dot-2" value="female" @change="handleGenderChange('female')" v-model="gender">
                        <span>Female</span>
                        <input type="radio" name="gender" id="dot-3" value="other" @change="handleGenderChange('other')" v-model="gender">
                        <span>Other</span>
                    </div>
                    <span class="error">{{ errors.gender }}</span>
                </div>
                <div class="input_pox">
                    <span class="datails">password</span>
                    <input v-bind="password" type="password" placeholder="Enter password " />
                    <span class="error">{{ errors.password }}</span>
                </div>
                <div class="input_pox">
                    <span class="datails">Confirm password</span>
                    <input v-bind="confirmPassWord" type="password" placeholder="Re-enter password " />
                    <span class="error">{{ errors.confirmPassWord }}</span>
                </div>
            </div>
            <button class="vue-btn-primary" type="submit">Signup</button>
        </form>
    </div>
</template>
<style scoped>
.container {
    max-width: 700px;
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
    flex-wrap: wrap;
    justify-content: space-between;
}

form .user_details .input_pox {
    margin-bottom: 15px;
    margin: 12px 0;
    width: calc(100% / 2 - 20px);
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

.user_details .input_pox input[type="radio"] {
    width: 15px;
    height: 15px;
}

form .input_pox .gender_title {
    font-size: 20px;
    font-weight: 500;
}

form .input_pox .category {
    display: flex;
    width: 80%;
    margin: 14px 0;
    justify-content: space-between;
}

.error {
    color: red;
}

form .button {
    height: 45px;
    margin: 45px 0;
}

form .button input {
    height: 100%;
    width: 100%;
    outline: none;
    color: #fff;
    border: none;
    font-size: 18px;
    font-weight: 500;
    border-radius: 5px;
    letter-spacing: 1px;
    background: linear-gradient(123deg, #71b8e7, #9b59b6);

}

form .button input :hover {
    background: linear-gradient(-123deg, #71b8e7, #9b59b6);
}

@media (max-width: 584px) {
    .container {
        max-width: 100%;
    }

    form .user_details .input_pox {
        margin-bottom: 15px;
        width: 100%;
    }

    form .input_pox .category {
        width: 100%;
    }

    .container form .user_details {
        max-height: 300px;
        overflow: scroll;
    }

    .user_details::-webkit-scrollber {
        width: 0;
    }
}
</style>