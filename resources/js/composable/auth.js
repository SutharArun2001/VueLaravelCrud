import axios from "axios";
import { defineStore } from "pinia";
export const useAuthStore = defineStore("auth", {
    state: () => ({
        authUser: null,
        authError: []
    }),
    getters: {
        user: (state) => state.authUser,
        errors: (state) => state.authError
    },
    actions: {
        async getToken() {
            await axios.get("/sanctum/csrf-cookie");
        },
        async setErrors() {
            this.authError = [];
        },
        async getUser() {
            await this.getToken();
            const data = await axios.get("/user/auth");
            this.authUser = data.data;
            if(!this.authUser) {
                this.router.push({name:"login"})
            }
        },
        async hangleLogin(data) {
            await this.getToken();
            try {
                await axios.post("login", data);
                this.router.push({name: "alluser"});
            } catch (error) {
                this.authError = error.response.data.errors;
            }
        },
        async hangleRegistration(data) {
            await this.getToken();
            try {
                await axios.post("user/create", data)
                this.router.push({name: "alluser"});
            } catch (error) {
                if(error.response.status === 422) {
                    this.authError = error.response.data.errors;
                }
            }
        },
        async hangleLogout(){
            await axios.get("logout")
            this.authUser = null;
            this.router.push({name:"login"})
        }

    }
})