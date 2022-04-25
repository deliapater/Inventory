<template>
    <div>

        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3">
            <router-link to="/store-product" class="btn btn-primary">Add Product</router-link>
            </div>
        </div>
         <br>
         <input type="text" placeholder="Search" class="form-control" style="width:300px" v-model="searchTerm">
         <br>

        <div class="row">
            <div class="col-lg-12 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Root</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in filterSearch" :key="product.id">
                        <td>{{product.product_name}}</td>
                        <td>{{product.product_code}}</td>
                        <td><img :src="product.image" id="em_photo"></td>
                        <td>{{product.category_name}}</td>
                        <td>{{product.buying_price}}</td>
                        <td>{{product.selling_price}}</td>
                        <td>{{product.root}}</td>
                        <td>
                        <router-link :to="{name: 'edit-product', params:{id:product.id} }" class="btn btn-sm btn-primary">Edit</router-link>
                        <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger" style="color: white">Delete</a>
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
    products: [],
    searchTerm: ''
    }
},

computed: {
    filterSearch(){
        return this.products.filter(product => {
            return product.product_name.match(this.searchTerm)
        })
    }
},

methods:{
    allProducts() {
        axios.get('/api/products/')
        .then(({data}) => (this.products = data))
        .catch()
    }, 
    
    deleteProduct(id) {
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
                axios.get('/api/delete-product/' +id )
                .then(() => {
                    this.products = this.products.filter(product => 
                    {
                        return product.id != id;
                    })
                })
                .catch(() => {
                    this.$router.push({name: 'products'})
                })
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
            this.allProducts();
    },
  },

  created() {
      this.allProducts();
  }
}

</script>

<style type="text/css">
#em_photo{
    height: 40px;
    width: 40px;
}

</style>