<script setup>
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import useUser from '../../composable/users';
import PickUploader from '../../components/layout/widget/PickUploader.vue';

const {user, getUser,updateUser, errors}  = useUser();
const route = useRoute();
const userPhoto = ref('');

onMounted(async () => {
    await getUser(route.params.id);
    userPhoto.value = '/storage/profiles/'+user.value.profile_path;
})

function setImageValue(e) {
    user.value.profile_path = e.value;
}

</script>   

<template>
    <h2 class="py-2">Edit User</h2>
    <div class="container">
        <div class="sub-container">
        <div class="title">User Edit</div>
        <form @submit.prevent="updateUser(user.id)">
            <div class="user_details">
                <div v-if="user" class="image_pox " >
                    <PickUploader :user-profile="userPhoto" @file-value=" (e) => setImageValue(e)" />
                    <span class="datails d-block">Profile Picture</span>
                </div>
                <input :v-bind:value="user.profile_path" type="file" name="profile_path"  hidden />
                <div class="input_pox">
                </div>
                <div class="input_pox">
                    <span class="datails">First Name</span>
                    <input v-model="user.first_name" placeholder="Enter your firstname " />
                    <span v-if="errors.first_name" class="error">{{ errors.first_name[0] }}</span>

                </div>
                <div class="input_pox">
                    <span class="datails">Last Name</span>
                    <input v-model="user.last_name" placeholder="Enter your lastname " />
                    <span v-if="errors.last_name" class="error">{{ errors.last_name[0] }}</span>
                </div>
                <div class="input_pox">
                    <span class="datails">username</span>
                    <input v-model="user.user_name" placeholder="Enter your username " />
                    <span v-if="errors.user_name" class="error">{{ errors.user_name[0] }}</span>
                </div>
                <div class="input_pox">
                    <span class="datails">Phone Number</span>
                    <input v-model="user.phone_number" placeholder="Enter your phonenumber " />
                    <span v-if="errors.phone_number" class="error">{{ errors.phone_number[0] }}</span>
                </div>
                <div class="input_pox">
                    <span class="datails"> Gender</span>
                    <div class="category">
                        <input type="radio" name="gender" id="dot-1" value="male"  v-model="user.gender">
                        <span>Male</span>
                        <input type="radio" name="gender" id="dot-2" value="female" v-model="user.gender">
                        <span>Female</span>
                        <input type="radio" name="gender" id="dot-3" value="other" v-model="user.gender">
                        <span>Other</span>
                    </div>
                    <span v-if="errors.gender" class="error">{{ errors.gender[0] }}</span>
                </div>
                <!-- <div class="input_pox">
                    <span class="datails">password</span>
                    <input v-bind="password" type="password" placeholder="Enter password " />
                    <span class="error">{{ errors.password }}</span>
                </div>
                <div class="input_pox">
                    <span class="datails">Confirm password</span>
                    <input v-bind="confirmPassWord" type="password" placeholder="Re-enter password " />
                    <span class="error">{{ errors.confirmPassWord }}</span>
                </div> -->
            </div>
            <button class="vue-btn-primary" type="submit">Update</button>
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
.sub-container {
    max-width: 700px;
    width: 100%;
    box-shadow: 2px 2px 10px #cccccc;
    border-radius: 16px;
    padding: 25px 30px;
}

.sub-container .title {
    font-size: 25px;
    font-weight: 500;
    position: relative;
}

.sub-container form .user_details {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

form .user_details .image_pox,
form .user_details .input_pox {
    margin-bottom: 15px;
    margin: 12px 0;
    width: calc(100% / 2 - 20px);
}

.image_pox img {
    border-radius: 100%;
    width: 120px;
    height: 120px;
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