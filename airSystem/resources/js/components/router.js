import {createRouter, createWebHistory} from 'vue-router';
import AdminComponent from './admin/Admin.vue';
import AnalystComponent from '../components/analyst/Analyst.vue';
import OperatorComponent from './operator/Operator.vue';
import LoginComponent from '../components/auth/LoginComponent.vue'
import RegisterComponent from '../components/auth/RegisterComponent.vue'
import UsersComponent from './admin/UsersComponent.vue';
import AirlineComponent from "./admin/AirlineComponent.vue";
import AirportComponent from "./admin/AirportComponent.vue";
import BoardComponent from "./admin/BoardComponent.vue";
import TypeComponent from "./admin/TypeComponent.vue";
import CountryComponent from "./admin/CountryComponent.vue";
import ModelComponent from "./admin/ModelComponent.vue";
import FlightComponent from "./operator/FlightComponent.vue";
import ScheduleComponent from "./operator/ScheduleComponent.vue";
import BoardingTakeoffComponent from "@/components/operator/BoardingTakeoffComponent.vue";
import DelayComponent from "@/components/operator/DelayComponent.vue";
import AirlineDelayComponent from "@/components/analyst/AirlineDelayComponent.vue";
import FlightDelayComponent from "@/components/analyst/FlightDelayComponent.vue";
import AvgDelayComponent from "@/components/analyst/AvgDelayComponent.vue";
import CategoryDelayComponent from "@/components/analyst/CategoryDelayComponent.vue";

const routes = [
    {
        path: '/admin',
        name: 'admin',
        component: AdminComponent,
        meta: {requiresAdmin: true}
    },
    {
        path: '/analyst',
        name: 'analyst',
        component: AnalystComponent,
        meta: {requiresAnalyst: true}
    },
    {
        path: '/analyst/airline',
        name: 'analystAirline',
        component: AirlineDelayComponent,
        meta: {requiresAnalyst: true}
    },
    {
        path: '/analyst/flight',
        name: 'analystFlight',
        component: FlightDelayComponent,
        meta: {requiresAnalyst: true}
    },
    {
        path: '/analyst/avg',
        name: 'analystAvg',
        component: AvgDelayComponent,
        meta: {requiresAnalyst: true}
    },
    {
        path: '/analyst/category',
        name: 'analystCategory',
        component: CategoryDelayComponent,
        meta: {requiresAnalyst: true}
    },
    {
        path: '/user/registration',
        name: 'registration',
        component: RegisterComponent
    },
    {
        path: '/login',
        name: 'login',
        component: LoginComponent
    },
    {
        path: '/admin/users',
        name: 'userManage',
        component: UsersComponent,
        meta: {requiresAdmin: true}
    },
    {
        path: '/admin/airlines',
        name: 'airlines',
        component: AirlineComponent,
        meta: {requiresAdmin: true}
    },
    {
        path: '/admin/airports',
        name: 'airports',
        component: AirportComponent,
        meta: {requiresAdmin: true}
    },
    {
        path: '/admin/boards',
        name: 'boards',
        component: BoardComponent,
        meta: {requiresAdmin: true}
    },
    {
        path: '/admin/countries',
        name: 'countries',
        component: CountryComponent,
        meta: {requiresAdmin: true}
    },
    {
        path: '/admin/models',
        name: 'models',
        component: ModelComponent,
        meta: {requiresAdmin: true}
    },
    {
        path: '/admin/categories',
        name: 'categories',
        component: TypeComponent,
        meta: {requiresAdmin: true}
    },
    {
        path: '/operator/',
        name: 'operator',
        component: OperatorComponent,
        meta: {requiresOperator: true}
    },
    {
        path: '/operator/flights',
        name: 'flights',
        component: FlightComponent,
        meta: {requiresOperator: true}
    },
    {
        path: '/operator/schedules',
        name: 'schedules',
        component: ScheduleComponent,
        meta: {requiresOperator: true}
    },
    {
        path: '/operator/boarding-takeoff',
        name: 'boarding-takeoff',
        component: BoardingTakeoffComponent,
        meta: {requiresOperator: true}
    },
    {
        path: '/operator/delay',
        name: 'delay',
        component: DelayComponent,
        meta: {requiresOperator: true}
    },
];

const router = createRouter({
        history: createWebHistory(),
        routes
    }
);
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token');
    const role = localStorage.getItem('user_role');
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
    if (to.meta.requiresOperator && role !== 'operator') {
        // Если маршрут требует роль оператора, но текущий пользователь не является оператором, перенаправляем его на страницу входа
        return next({name: role});
    }
    if (to.meta.requiresAdmin && role !== 'admin') {
        // Если маршрут требует роль оператора, но текущий пользователь не является оператором, перенаправляем его на страницу входа
        return next({name: role});
    }
    if (to.meta.requiresAnalyst && role !== 'analyst') {
        // Если маршрут требует роль оператора, но текущий пользователь не является оператором, перенаправляем его на страницу входа
        return next({name: role});
    }
    if (to.name === 'login' && to.name === 'register' && token) {
        return next({
            name: role
        })
    }
    next()
});
export default router;
