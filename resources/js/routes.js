import Home from './views/Home'
import Account from './views/Account'
import NotFound from './views/NotFound'
import Ingredients from './views/Ingredients'
import Measurements from './views/Measurements'
import Users from './views/Users'
import Inventories from './views/Inventories'
import Recipes from './views/Recipes'
import Categories from './views/Categories'
import Suppliers from './views/Suppliers'
<<<<<<< HEAD
import Notifications from './views/Notifications'
=======
import GroceryList from './views/GroceryList'
>>>>>>> master

export default [{
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
        path: '/categories',
        name: 'categories',
        component: Categories
    },
    {
        path: '/recipes',
        name: 'recipes',
        component: Recipes
    },
    {
        path: '/suppliers',
        name: 'suppliers',
        component: Suppliers
    },
    {
        path: '/inventories',
        name: 'inventories',
        component: Inventories
    },
    {
<<<<<<< HEAD
        path: '/notifications',
        name: 'notifications',
        component: Notifications
=======
        path: '/groceries',
        name: 'groceries',
        component: GroceryList
>>>>>>> master
    },
    {
        path: '*',
        component: NotFound
    }
];
