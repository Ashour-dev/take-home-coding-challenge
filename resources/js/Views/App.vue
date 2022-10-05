<template>
    <div>
        <h1>Posy-commerce</h1>
        <div class="products w-100 d-flex flex-wrap justify-content-between gap-4 p-5">
            <Card v-for="(product,index) in products" :key="index" :product="product" />
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
import Card from '../components/Card';
export default {
    name:'App',
    components:{
        Card,
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

<style lang="scss">
@import "~bootstrap/scss/bootstrap";
@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');
#app {
    font-family: 'Oswald', sans-serif;
}

</style>