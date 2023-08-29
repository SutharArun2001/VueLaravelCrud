import { createRouter,  createWebHistory } from 'vue-router';
import signup from './template/SignUp.vue';
import home from './template/Home.vue';
import login from './template/user/Login.vue';
import main from './template/Main.vue';
import register from './template/user/Registration.vue'
import alluser from './template/user/UserListing.vue'
import UserEdit from './template/user/UserEdit.vue'


const routes = [
    {
        path: '/',
        name: 'main',
        component: main,
    },
    {
        path: '/home',
        name: 'home',
        component: home,
    },
    {
        path: '/signup',
        name: 'signup',
        component: signup,
    },
    {
        path: '/register',
        name: 'register',
        component: register,
    },
    {
        path: '/login',
        name: 'login',
        component: login,
    },
    {
        path: '/alluser',
        name: 'alluser',
        component: alluser,
    },
    {
        path: '/user/edit/:id',
        name: 'useredit',
        component: UserEdit,
    },
    {
        path: '/user/delete/:id',
        name: 'userdelete',
    },
    {
        path: '/logout',
        name: 'logout',
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
}) ;

// for authenication for routes
// router.beforeEach((to, from, next) => {
//     const authUser = store.getters["auth/authUser"];
//     const reqAuth = to.matched.some((record) => record.meta.requiresAuth);
//     const loginQuery = { path: "/login", query: { redirect: to.fullPath } };
  
//     if (reqAuth && !authUser) {
//       store.dispatch("auth/getAuthUser").then(() => {
//         if (!store.getters["auth/authUser"]) next(loginQuery);
//         else next();
//       });
//     } else {
//       next(); // make sure to always call next()!
//     }
//   });

export default router;