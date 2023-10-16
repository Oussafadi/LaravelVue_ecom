<template>
    <div class="flex item-center justify-end py-4">
        <button  class="bg-yellow-400 text-red-800 p-2 font-bold"  v-on:click.prevent="addToCart"> Add to Cart</button>
    </div>
</template>

<script setup>

const addToCart = () => console.log('added');
</script>

