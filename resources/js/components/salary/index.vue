<template>
    <div>

        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3">
            <router-link to="/given-salary" class="btn btn-primary">Pay Salary</router-link>
            </div>
        </div>
         <br>
         <input type="text" placeholder="Search" class="form-control" style="width:300px" v-model="searchTerm">
         <br>

        <div class="row">
            <div class="col-lg-12 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Salary Details</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Month</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="salary in filterSearch" :key="salary.id">
                        <td>{{salary.salary_month}}</td>
                        <td>
                        <router-link :to="{name: 'view-salary', params:{id:salary.salary_month} }" class="btn btn-sm btn-primary">View Salary</router-link>
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
    salaries: [],
    searchTerm: ''
    }
},

computed: {
    filterSearch(){
        return this.salaries.filter(salary => {
            return salary.salary_month.match(this.searchTerm)
        })
    }
},

methods:{
    allSalary() {
        axios.get('/api/salary/')
        .then(({data}) => (this.salaries = data))
        .catch()
    }, 
    
    deleteEmployee(id) {
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
                axios.get('/api/delete-employee/' +id )
                .then(() => {
                    this.employees = this.employees.filter(employee => 
                    {
                        return employee.id != id;
                    })
                })
                .catch(() => {
                    this.$router.push({name: 'employees'})
                })
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
            this.allEmployees();
    },
  },

  created() {
      this.allSalary();
  }
}

</script>

<style type="text/css">
#em_photo{
    height: 40px;
    width: 40px;
}

</style>