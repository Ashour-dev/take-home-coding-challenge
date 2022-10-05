<template>
    <div class="position-relative card">
        <div class="content p-2 h-100 d-none text-center mt-5">
                <h2 class="pb-3">{{product.name}}</h2>
                <span class="fs-5 d-block pt-3">{{product.Item_price}} &euro;</span>
                <div class="buttons py-3 w-50 position-absolute bottom-0 start-50 translate-middle-x d-flex justify-content-around">
                    <a type="button" class="btn btn-primary" :href="product.link">
                        <span class="material-symbols-outlined align-middle">open_in_new</span>
                    </a>
                    <div>
                        <label class="position-absolute top-0 start-50 translate-middle" for="quantity">Qty</label>
                        <input class="form-control w-75 mx-auto" type="number" name="quantity" id="quantity" v-model="quantity" required min="1" max="5">
                    </div>
                    <a type="button" class="btn btn-dark" @click="addToCart(),$emit('itemAdded',itemAdded)">
                        <span class="material-symbols-outlined align-middle">add_shopping_cart</span>
                    </a>
                </div>
        </div>
        <img class="w-100 h-100 position-absolute rounded" :src="product.photo" :alt="product.name">
    </div>
</template>

<script>
export default {
    name:'Card',
    props:{product:Object},
    data(){
        return{
            quantity:1,
            productToCart:null,
            itemAdded:null,
        }
    },
    methods:{
        addToCart(){
            this.productToCart=this.product;
            this.productToCart['quantity']=this.quantity;
            axios.post('/api/addToCart', 
                this.productToCart
            )
            .then(function (response) {
                console.log(response)
            })
            .catch(function (error) {
                console.log(error);
            });
            this.itemAdded=!this.itemAdded;
        },
    },
}
</script>

<style lang="scss" scoped>
@import "~bootstrap/scss/bootstrap";

        img{
        object-fit: cover;
        object-position: middle;
        z-index: 1 !important;
        transition: opacity .5s, filter .5s;
    }
    .content{
        z-index: 2;
        transition: display;
    }
    .card{
        width: calc((100% / 3) - 2rem);
        height: 20rem !important;
        cursor: default;
    }
    .card:hover img{
            opacity: .75;
            filter: blur(.5rem);
    }
    .card:hover .content{
        display: block !important;
    }

</style>