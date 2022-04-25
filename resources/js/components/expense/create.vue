
<template>
    <div>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3">
            <router-link to="/expenses" class="btn btn-primary">All Expenses</router-link>
            </div>
        </div>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Expense</h1>
                  </div>
                  <form method="post"  class="user" @submit.prevent="expenseInsert">  
                    <div class="form-group">
                        <div class="form-group">
                            <div class="form-row">
                            
                                <div class=" col-md-6">
                                    <textarea class="form-control"  placeholder="Enter Expense Details" id="exampleFormControlTextarea1" rows="3"  v-model="form.details"></textarea>
                                     <small class="text-danger" v-if="errors.details">{{errors.details[0]}}</small>
            
                                </div>
                                <div class=" col-md-6">
                                     <input type="text" class="form-control"  placeholder="Enter Expense Amount"
                                    v-model="form.amount">
                                    <small class="text-danger" v-if="errors.amount">{{errors.amount[0]}}</small>
                                    <br>
                
                                </div>
                                         <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                 
                            </div>
                        </div>
                    </div>
                    <hr>
                  </form> 
                  <hr>
                  <div class="text-center">
                 
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
</template>
<script type="text/javascript">import axios from "axios";

export default {
  created() {
    if(!User.loggedIn()){
      this.$router.push({name: '/'})
    }
  },
  
  data(){
  return {
    form: {
      details: null,
      amount: null,
      expense_date: null,
    },
    errors: {}
  }
},
methods:{
    expenseInsert() {
        axios.post('/api/store-expense', this.form)
        .then(() => {
         this.$router.push({name: 'expenses'})
            Notification.success()
        }) 
        .catch(error => this.errors = error.response.data.errors);
    },
 
  }
}
</script>
<style type="text/css">
</style>
