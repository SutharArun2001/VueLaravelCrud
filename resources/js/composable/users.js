import axios from "axios"
import { ref } from "vue"
import { useRouter } from "vue-router";
axios.defaults.baseURL = "/api/"
const config = {
    headers: {
        'content-type': 'multipart/form-data'
    }
}
export default function useUser() {
    const users = ref([]);
    const user = ref([]);
    const router = useRouter();
    const modalOpen = ref(false);
    var errors = ref([]);
    
    const getUsers = async () => {
        const res = await axios.get("user/show");
        users.value = res.data.users;
    }
    
    const logoutUser = async () => {
        await axios.get("logout");
        await router.push({name: "login"})
    }
    const loginUsers = async (data) => {
        await this.getToken();
        errors = [];
        try {
            await axios.post("login", data);
            await router.push({name: "alluser"});
        } catch (error) {
            errors.value = error.response.data.errors;
        }   
    }
    
    const getUser = async (id) => {
        const res = await axios.get("user/edit/"+id);
        user.value = res.data.user;
        console.log(user.value.profile_path);
    }

    const createUser = async (data) => {
        try {
            await axios.post("user/create", data)
            await router.push({name: "alluser"});
        } catch (error) {
            if(error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        }
    }

    const updateUser = async (id) => {
        console.log(user);
        try {
            await axios.post("user/update/"+id,user.value, config);
            await router.push({name: 'alluser'})
        } catch (error) {
            if(error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        }
    }

    const deleteUser = async (id) => {
        await axios.get("user/delete/" + id);
        await getUsers();
        modalOpen.value = false;
    }

    return {
        user,
        users,
        modalOpen,
        getUser,
        getUsers,
        createUser,
        updateUser,
        deleteUser,
        loginUsers,
        logoutUser,
        errors,
    }
}