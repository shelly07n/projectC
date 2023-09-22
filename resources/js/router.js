import { createRouter, createWebHistory } from 'vue-router';
import jwt_decode from 'jwt-decode';

const routes = [
    {
        path: '/login',
        name: 'authentication',
        component: () => import('./modules/login/authentication.vue'),
        children: [
            {
                path: '/login',
                name: 'Login',
                component: () => import('./modules/login/login.vue'),
            },
            {
                path: '/register',
                name: 'register',
                component: () => import('./modules/login/register.vue'),
            }
        ],
        meta: { requiresAuth: false },
    },
    {
        path: '/',
        name: 'home',
        component: () => import('./modules/home/home.vue'),
        children: [
            {
                path: '/',
                name: 'dashboard',
                component: () => import('./modules/dashboard/dashboard.vue'),
            },
            {
                path: '/contests',
                name: 'contests',
                component: () => import('./modules/contests/contests.vue'),
            },
            {
                path: '/contestants',
                name: 'contestants',
                component: () => import('./modules/contestants/contestants.vue'),
            },
            {
                path: '/contact',
                name: 'contact',
                component: () => import('./modules/contacts/contact.vue'),
            },
            {
                path: '/access-denied',
                name: 'access-denied',
                component: () => import('./components/accesDenied.vue'),
            },
        ],
        meta: { requiresAuth: true },

    },

];
const router = createRouter({
    history: createWebHistory(),
    routes,
});


// Global navigation guard
router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        // Check if the user is authenticated by validating the access_token
        const accessToken = localStorage.getItem('access_token'); // Retrieve the access_token from local storage (you can use cookies or a different storage mechanism)


        if (!accessToken) {
            // If the access_token is not present, redirect to the login page
            next('/login');
        } else {
            // User is authenticated, proceed to the requested route
            const decoded = jwt_decode(accessToken);
            console.log("router" + decoded.user_role);
            if (to.meta.requiresAdmin && decoded.user_role !== 'admin') {
                next('/');
            }else
            if (to.meta.requiresContestant && decoded.user_role !== 'contestant') {
                next('/');
            }
            else {
                next()
            }
        }
    } else {
        // For routes that don't require authentication, proceed
        next();
    }
});


export default router;
