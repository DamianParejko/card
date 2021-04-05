export const routes = [
    { path: '/', 
        component: require('./components/Card/ListCard.vue').default },
    
    { path: '/edit/:id', 
        name: 'edit', 
        component: require('./components/Card/EditCard.vue').default },
    
    { path: '/add', 
        name: 'add', 
        component: require('./components/Card/AddCard.vue').default },
    
    { path: '/nav', 
        name: 'nav', 
        component: require('./components/Nav/Navbar.vue').default },
]