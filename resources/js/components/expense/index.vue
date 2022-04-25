<template>
    <div>

        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3">
            <router-link to="/store-expense" class="btn btn-primary">Add Expense</router-link>
            </div>
        </div>
         <br>
         <input type="text" placeholder="Search" class="form-control" style="width:300px" v-model="searchTerm">
         <br>

        <div class="row">
            <div class="col-lg-10 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expenses List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Details</th>
                        <th>Amount</th>
                        <th>Expense Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="expense in filterSearch" :key="expense.id">
                        <td>{{expense.details}}</td>         
                        <td>{{expense.amount}}</td>         
                        <td>{{expense.expense_date}}</td>         
                        <td>
                        <router-link :to="{name: 'edit-expense', params:{id:expense.id} }" class="btn btn-sm btn-primary">Edit</router-link>
                        <a @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger" style="color: white">Delete</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">

export default {
  created() {
    if(!User.loggedIn()){
      this.$router.push({name: '/'})
    }
  },
  
  data(){
  return {
    expenses: [],
    searchTerm: ''
    }
},

computed: {
    filterSearch(){
        return this.expenses.filter(expense => {
            return expense.details.match(this.searchTerm)
        })
    }
},

methods:{
    allExpenses() {
        axios.get('/api/expenses/')
        .then(({data}) => (this.expenses = data))
        .catch()
    }, 
    
    deleteExpense(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                axios.get('/api/delete-expense/' +id )
                .then(() => {
                    this.expenses = this.expenses.filter(expense => 
                    {
                        return expense.id != id;
                    })
                })
                .catch(() => {
                    this.$router.push({name: 'expenses'})
                })
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
            this.allExpenses();
    },
  },

  created() {
      this.allExpenses();
  }
}

</script>

<style type="text/css">
#em_photo{
    height: 40px;
    width: 40px;
}

</style>