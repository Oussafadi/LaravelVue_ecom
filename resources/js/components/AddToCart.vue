<template>
    <div class="flex item-center justify-between py-4">
        <button v-on:click.prevent='addToCart' class="bg-yellow-400 text-red-800 p-2 font-bold" > Add to Cart</button>
    </div>
</template>

<script setup>
import axios from 'axios';

const productId = defineProps(['productId']);
const addToCart = async() => {
await axios.get('/sanctum/csrf-cookie');
await axios.get('api/user').then(async(result) => {
  let response = await axios.post('api/products', {
    productId:productId
   });
 console.log(response);
}).catch((err) => {
    console.log(err);
});
;
}
</script>

