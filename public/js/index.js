// 1. Define route components.
// These can be imported from other files
const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }
const MakeController = { template: '<div>Make Controller</div>' }

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
const routes = [
  { path: '/', component: Foo, name: 'Dashboard'},
  { path: '/bar', component: Bar, name: 'Bar'},
  { path: '/make:controller', component: MakeController, name: 'Create Controller Class'}
]

// 3. Create the router instance and pass the `routes` option
const router = new VueRouter({
  base: '/slimapp/artisan/',
  linkExactActiveClass: "active",
  mode: 'history',
  routes // short for `routes: routes`
})

const v = new Vue({
    router,
    delimiters: ['${', '}'],
    el: "#main",
    data: {
        title: 'Dashboard'
    },
    watch: {
      // whenever $route changes, this function will run
      $route: function (to, from) {
        this.title = to.name;
      }
    },
    methods: {
        page(event){
          let href = event.target.href;
          console.log(event);
        }
    }
});