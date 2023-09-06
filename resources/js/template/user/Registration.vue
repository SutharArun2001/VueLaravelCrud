<script setup>
import { onMounted, ref } from 'vue';
import { useAuthStore } from '../../composable/auth';
const authStore = useAuthStore();
import imageValidate from '../../composable/imageValidation'
const {validate, imageErrors, previewImage} = imageValidate();
const user = ref({
    profile: '',
    first_name: '',
    last_name: '',
    user_name: '',
    phone_number: '',
    email: '',
    gender: '',
    password: '',
});

onMounted(async () => {
    await authStore.setErrors();
    console.log(previewImage);

});

async function onImageChange(e) {
    console.log(e);
    await validate(e);
    console.log(imageErrors.value.profile);
    console.log(previewImage);
}

// const { handleSubmit, errors, defineInputBinds, setFieldValue } = useForm({
//     initialValues: {
//         gender: 'male', // Initialize the gender field
//     },
//     validationSchema: yup.object({
//         firstname: yup.string().required(),
//         lastname: yup.string().required(),
//         username: yup.string().required(),
//         email: yup.string().email().required(),
//         gender: yup.string().required(),
//         phonenumber: yup.string().matches(/^[0-9]+$/, 'Phone number must be a valid integer').min(10).max(10).required(),
//         password: yup.string().oneOf([yup.ref('confirmPassWord'),null],"Passwords Not match").required(),
//         confirmPassWord: yup.string().required('Confirm Password field required.'),
//     }),
// });

// const firstname = defineInputBinds('firstname');
// const lastname = defineInputBinds('lastname');
// const username = defineInputBinds('username');
// const email = defineInputBinds('email');
// const phonenumber = defineInputBinds('phonenumber');
// const password = defineInputBinds('password');
// const confirmPassWord = defineInputBinds('confirmPassWord');
// const gender = ref('male');
// const router = useRouter();

// // for handle gender validation
// const handleGenderChange = (selectedGender) => {
//     setFieldValue('gender', selectedGender);
// };

// // handle on-submit validation and API
// const onSubmit = handleSubmit((values) => {
//     const newUser = values;
//     axios.post('api/user/create', newUser)
//         .then(function () {
//             router.push({
//                 name: 'alluser'
//             })
//         })
//         .catch(error => {
//             if(error.response.status === 422) {
//                 backError.email = error.response.data.errors.email[0];
//             }
//     });
// });
</script>

<template>
    <div class="container">
        <div class="registration-container">
            <div class="title">Registeration</div>
            <form @submit.prevent="authStore.hangleRegistration(user)">
                <div class="user_details">
                    <div class="image_pox">
                        <span class="datails d-block">Profile Picture</span>
                        <img v-if="previewImage" src="" alt="" srcset="">
                        <input type="file" @change="onImageChange"/>
                        <span v-if="imageErrors.profile" class="error">{{ imageErrors.profile }}</span>
                        {{ previewImage }}
                    </div>
                    <div class="input_pox">
                    </div>
                    <div class="input_pox">
                        <span class="datails">First Name</span>
                        <input v-model="user.first_name" placeholder="Enter your firstname " />
                        <span v-if="authStore.errors.first_name" class="error">{{ authStore.errors.first_name[0] }}</span>

                    </div>
                    <div class="input_pox">
                        <span class="datails">Last Name</span>
                        <input v-model="user.last_name" placeholder="Enter your lastname " />
                        <span v-if="authStore.errors.last_name" class="error">{{ authStore.errors.last_name[0] }}</span>
                    </div>
                    <div class="input_pox">
                        <span class="datails">username</span>
                        <input v-model="user.user_name" placeholder="Enter your username " />
                        <span v-if="authStore.errors.user_name" class="error">{{ authStore.errors.user_name[0] }}</span>
                    </div>
                    <div class="input_pox">
                        <span class="datails">Phone Number</span>
                        <input v-model="user.phone_number" placeholder="Enter your phonenumber " />
                        <span v-if="authStore.errors.phone_number" class="error">{{ authStore.errors.phone_number[0]
                        }}</span>
                    </div>
                    <div class="input_pox">
                        <span class="datails">Email</span>
                        <input v-model="user.email" placeholder="Enter your email " />
                        <span v-if="authStore.errors.email" class="error">{{ authStore.errors.email[0] }}</span>
                    </div>
                    <div class="input_pox">
                        <span class="datails"> Gender</span>
                        <div class="category">
                            <input type="radio" name="gender" id="dot-1" value="male" v-model="user.gender">
                            <span>Male</span>
                            <input type="radio" name="gender" id="dot-2" value="female" v-model="user.gender">
                            <span>Female</span>
                            <input type="radio" name="gender" id="dot-3" value="other" v-model="user.gender">
                            <span>Other</span>
                        </div>
                        <span v-if="authStore.errors.gender" class="error">{{ authStore.errors.gender[0] }}</span>
                    </div>
                    <div class="input_pox">
                        <span class="datails">password</span>
                        <input v-model="user.password" type="password" placeholder="Enter password " />
                        <span v-if="authStore.errors.password" class="error">{{ authStore.errors.password[0] }}</span>
                    </div>
                    <div class="input_pox">
                        <span class="datails">Confirm password</span>
                        <input v-model="user.password_confirmation" type="password" placeholder="Re-enter password " />
                        <span v-if="authStore.errors.password_confirmation" class="error">{{
                            authStore.errors.password_confirmation[0] }}</span>
                    </div>
                </div>
                <button class="vue-btn-primary mt-2" type="submit">Register</button>
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

.registration-container {
    width: 100%;
    max-width: 700px;
    padding: 25px 30px;
    box-shadow: 2px 2px 10px #cccccc;
    border-radius: 16px;
}

.registration-container .title {
    font-size: 25px;
    font-weight: 500;
    position: relative;
}

.registration-container form .user_details {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

form .user_details .image_pox,
form .user_details .input_pox {
    margin-bottom: 15px;
    margin: 5px 0;
    width: calc(100% / 2 - 20px);
}

.image_pox img {
    width: 100px;
    height: 100px;
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
    background: linear-gradient(123deg, #71b8e7, #0d6efd);

}

form .button input :hover {
    background: linear-gradient(-123deg, #71b8e7, #0d6efd);
}

@media (max-width: 584px) {
    .registration-container {
        max-width: 100%;
    }

    form .user_details .input_pox {
        margin-bottom: 15px;
        width: 100%;
    }

    form .input_pox .category {
        width: 100%;
    }

    .registration-container form .user_details {
        max-height: 300px;
        overflow: scroll;
    }

    .user_details::-webkit-scrollber {
        width: 0;
    }
}</style>