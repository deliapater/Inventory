<template>
    <div>
         <br>
         <input type="text" placeholder="Search" class="form-control" style="width:300px" v-model="searchTerm">
         <br>

        <div class="row">
            <div class="col-lg-10 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Today's Orders</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Customer Name</th>
                        <th>Total Amount</th>
                        <th>Paid</th>
                        <th>Due</th>
                        <th>Pay By</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in filterSearch" :key="order.id">
                        <td>{{order.name}}</td>         
                        <td>{{order.total}} $</td>         
                        <td>{{order.pay}} $</td>         
                        <td>{{order.due}} $</td>         
                        <td>{{order.payBy}}</td>         
                        <td>
                        <router-link :to="{name: 'view-order', params:{id:order.id} }" class="btn btn-sm btn-primary">View</router-link>
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
    orders: [],
    searchTerm: ''
    }
},

computed: {
    filterSearch(){
        return this.orders.filter(order => {
            return order.name.match(this.searchTerm)
        })
    }
},

methods:{
    allOrders() {
        axios.get('/api/orders/')
        .then(({data}) => (this.orders = data))
        .catch()
    }, 
    
  },

  created() {
      this.allOrders();
  }
}

</script>

<style type="text/css">
#em_photo{
    height: 40px;
    width: 40px;
}

</style>