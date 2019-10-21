import Home from './views/Home'
import Account from './views/Account'
import NotFound from './views/NotFound'
import Ingredients from './views/Ingredients'
import Measurements from './views/Measurements'
import Users from './views/Users'

export default [
    {
        path: '/home',
        name: 'home',
        component: Home,
    },
    {
        path: '/account',
        name: 'account',
        component: Account
    },
    {
        path: '/ingredients',
        name: 'ingredients',
        component: Ingredients
    },
    {
        path: '/measurements',
        name: 'measurements',
        component: Measurements
    },
    {
        path: '/users',
        name: 'users',
        component: Users
    },
    {
        path: '*',
        component: NotFound
    }
];
