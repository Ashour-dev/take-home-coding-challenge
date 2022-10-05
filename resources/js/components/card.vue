<template>
    <div class="position-relative card">
        <div class="content p-2 h-100 d-none text-center mt-5">
                <h2 class="pb-3 text-capitalize">{{product.name}}</h2>
                <span>{{product.Item_price}} &euro;</span>
                <div class="buttons py-3 w-50 position-absolute bottom-0 start-50 translate-middle-x d-flex justify-content-around">
                    <a type="button" class="btn btn-primary" :href="product.link">View</a>
                    <a type="button" class="btn btn-dark" href="">
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