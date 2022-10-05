<template>
    <div>
        <h1>Home Page</h1>
    </div>
</template>

<script>
import Axios from 'axios';
export default {
    name:'App',
    components:{
        // Card,
    },
    data(){
        return{
            products:[]
        }
    },
    methods:{
        getProducts(){
            Axios.get('/api/products')
                .then(response=>{
                    this.products=response.data;
                    console.log(this.products);
                })
        },
    },
    created(){
        this.getProducts();
    }
}
</script>

<style>

</style>