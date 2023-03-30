import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Crear from '../components/Crear.vue'
import CrearCliente from '../components/CrearCliente.vue'
import EditarCliente from '../components/EditarCliente.vue'
import Editar from '../components/Editar.vue'
import Listar from '../components/Listar.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/crear',
    name: 'Crear',
    component: Crear
  },
  {
    path: '/crearCliente',
    name: 'CrearCliente',
    component: CrearCliente
  },
  {
    path: '/editar/:id',
    name: 'Editar',
    component: Editar
  },
  {
    path: '/editarCliente/:id',
    name: 'EditarCliente',
    component: EditarCliente
  },
  {
    path: '/listar',
    name: 'Listar',
    component: Listar
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
