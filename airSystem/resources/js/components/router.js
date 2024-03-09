import {createRouter, createWebHistory} from 'vue-router';
import AdminComponent from '../components/Admin.vue';
import AnalyticsComponent from '../components/Analytics.vue';
import OperatorComponent from '../components/Operator.vue';
import LoginComponent from '../components/auth/LoginComponent.vue'
import RegisterComponent from '../components/auth/RegisterComponent.vue'
import UsersComponent from '../components/UsersComponent.vue';
import AirlineComponent from "../components/AirlineComponent.vue";
import AirportComponent from "../components/AirportComponent.vue";
import BoardComponent from "../components/BoardComponent.vue";
import TypeComponent from "../components/TypeComponent.vue";

const routes = [
    {
        path: '/admin',
        name: 'admin',
        component: AdminComponent
    },
    {
        path: '/analytics',
        name: 'analytics',
        component: AnalyticsComponent
    },
    {
        path: '/operator',
        name: 'operator',
        component: OperatorComponent
    },
    {
        path: '/user/registration',
        name: 'registration',
        component: RegisterComponent
    },
    {
        path: '/user/login',
        name: 'login',
        component: LoginComponent
    },
    {
        path: '/user/manage',
        name: 'userManage',
        component: UsersComponent
    },
    {
        path: '/airlines',
        name: 'airlines',
        component: AirlineComponent
    },
    {
        path: '/airports',
        name: 'airports',
        component: AirportComponent
    },
    {
        path: '/boards',
        name: 'boards',
        component: BoardComponent
    },
    {
        path: '/categories',
        name: 'categories',
        component: TypeComponent
    }
];

const router = createRouter({
        history: createWebHistory(),
        routes
    }
);
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token');
    //NavbarComponent.methods.setToken(token);
    if (!token) {
        if (to.name === 'login' || to.name === 'registration') {
            return next()
        } else {
            return next({
                name: 'login'
            })
        }
    }
        if (to.name === 'login' && to.name === 'register'  && token) {
            return next({
                name: 'admin'
            })
        }

        next()
});
export default router;
