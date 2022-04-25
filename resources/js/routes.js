let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
//End Authentication
let home = require('./components/home.vue').default;
//Employees 
let storeemployee = require('./components/employee/create.vue').default;
let employees = require('./components/employee/index.vue').default;
let editemployee = require('./components/employee/edit.vue').default;
//Suppliers
let suppliers = require('./components/supplier/index.vue').default;
let storesupplier = require('./components/supplier/create.vue').default;
let editsupplier = require('./components/supplier/edit.vue').default;
//Categories
let categories = require('./components/category/index.vue').default;
let storecategory = require('./components/category/create.vue').default;
let editcategory = require('./components/category/edit.vue').default;
//Products
let products = require('./components/product/index.vue').default;
let storeproduct = require('./components/product/create.vue').default;
let editproduct = require('./components/product/edit.vue').default;
//Expenses
let expenses = require('./components/expense/index.vue').default;
let storeexpense = require('./components/expense/create.vue').default;
let editexpense = require('./components/expense/edit.vue').default;
//Salaries
let salary = require('./components/salary/all_employees.vue').default;
let paysalary = require('./components/salary/create.vue').default;
let allsalary = require('./components/salary/index.vue').default;
let viewsalary = require('./components/salary/view.vue').default;
let editsalary = require('./components/salary/edit.vue').default;
//Stock
let stock = require('./components/product/stock.vue').default;
let editstock = require('./components/product/edit-stock.vue').default;
//Customers
let storecustomer = require('./components/customer/create.vue').default;
let customers = require('./components/customer/index.vue').default;
let editcustomer = require('./components/customer/edit.vue').default;
//POS
let pos = require('./components/pos/pointofsale.vue').default;
//Order
let order = require('./components/order/order.vue').default;
let vieworder = require('./components/order/view.vue').default;
let searchorder = require('./components/order/search.vue').default;

export const routes = [
    { path: '/', component: login, name:'/' },
    { path: '/register', component: register, name:'register' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/logout', component: logout, name:'logout' },
    { path: '/home', component: home, name:'home' },

    // Employees
    { path: '/store-employee', component: storeemployee, name:'store-employee' },
    { path: '/employees', component: employees, name:'employees' },
    { path: '/edit-employees/:id', component: editemployee, name:'edit-employee' },

    // Suppliers
    { path: '/suppliers', component: suppliers, name:'suppliers' },
    { path: '/store-supplier', component: storesupplier, name:'store-supplier' },
    { path: '/edit-supplier/:id', component: editsupplier, name:'edit-supplier' },

    // Categories
    { path: '/categories', component: categories, name:'categories' },
    { path: '/store-category', component: storecategory, name:'store-category' },
    { path: '/edit-category/:id', component: editcategory, name:'edit-category' },

    // Products
    { path: '/products', component: products, name:'products' },
    { path: '/store-product', component: storeproduct, name:'store-product' },
    { path: '/edit-product/:id', component: editproduct, name:'edit-product' },

    // Expenses
    { path: '/expenses', component: expenses, name:'expenses' },
    { path: '/store-expense', component: storeexpense, name:'store-expense' },
    { path: '/edit-expense/:id', component: editexpense, name:'edit-expense' },

    // Salaries
    { path: '/given-salary', component: salary, name:'given-salary' },
    { path: '/pay-salary/:id', component: paysalary, name:'pay-salary' },
    { path: '/salary', component: allsalary, name:'all-salary' },
    { path: '/view-salary/:id', component: viewsalary, name:'view-salary' },
    { path: '/edit-salary/:id', component: editsalary, name:'edit-salary' },

    //Stock
    { path: '/stock', component: stock, name:'stock' },
    { path: '/edit-stock/:id', component: editstock, name:'edit-stock' },

    // Customers
    { path: '/store-customer', component: storecustomer, name:'store-customer' },
    { path: '/customers', component: customers, name:'customers' },
    { path: '/edit-customer/:id', component: editcustomer, name:'edit-customer' },

    //POS
    { path: '/pos', component: pos, name:'pos' },

    //Order
    { path: '/order', component: order, name:'order' },
    { path: '/view-order/:id', component: vieworder, name:'view-order' },
    { path: '/search-order', component: searchorder, name:'search-order' },
 
  ]