<template>
    <div>
        <div class="products w-100 d-flex flex-wrap justify-content-between gap-4 p-5">
            <Card v-for="(product,index) in products" :key="index" :product="product" @itemAdded="notificationExecution" />
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
import Vue from "vue";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

Vue.use(Toast, {
    transition: "my-custom-fade",
    maxToasts: 6,
    newestOnTop: true
});
import Card from '../components/Card';
export default {
    name:'App',
    components:{
        Card,
    },
    data(){
        return{
            products:[],
            nItemAdded:false,
        }
    },
    methods:{
        getProducts(){
            Axios.get('/api/products')
                .then(response=>{
                    this.products=response.data;
                })
        },
        notification(){
        this.$toast.success("Item added to Cart", {
            position: "bottom-right",
            timeout: 1041,
            closeOnClick: true,
            pauseOnFocusLoss: true,
            pauseOnHover: true,
            draggable: true,
            draggablePercent: 0.6,
            showCloseButtonOnHover: true,
            hideProgressBar: true,
            closeButton: "button",
            icon: true,
            rtl: false
        });
        },
        notificationExecution(itemAdded){
            if(itemAdded!=this.nItemAdded)
                this.notification();
            this.nItemAdded=itemAdded;
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