<template>
    <div class="flex item-center justify-between py-4">
        <button v-on:click.prevent='addToCart' class="bg-yellow-400 text-red-800 p-2 font-bold flex item-center" > Add to Cart <svg class="mx-2  h-6 w-5 text-indigo-600"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="10" />  <line x1="12" y1="8" x2="12" y2="16" />  <line x1="8" y1="12" x2="16" y2="12" /></svg> </button>
    </div>
</template>

<script setup>

import useProduct from '../composables/products';
import emitter from 'tiny-emitter/instance';

// tiny emitter package to listen to custom event
//const emitter = require('tiny-emitter/instance');

const { add } = useProduct();
const productId = defineProps(['productId']);

const addToCart = async() => {
await axios.get('/sanctum/csrf-cookie');
await axios.get('api/user').then(async(result) => {
   let cartCount = await add(productId);
   emitter.emit('CartCountChanged' , cartCount);

}).catch((err) => {
    console.log(err);
}).catch((err) => {
    console.log(err);
});
;
}
</script>

