<template>

      <div class="flex justify-center my-6">
      <div class="flex flex-col w-full p-8 rounded-md text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
          <div class=" py-2 container">
          <table class="w-full text-sm lg:text-base " cellspacing="0">
              <thead>
              <tr class=" h-12 uppercase">
                  <th class=" md:table-cell"></th>
                  <th class="text-left">Produits</th>
                  <th class="lg:text-right text-left pl-5 lg:pl-0">    
                  <span class=" lg:inline">Quantity</span>
                  </th>
                  <th class=" text-right md:table-cell">Price unit</th>
                  <th class="text-right">Total price</th>
              </tr>
              </thead>
              <tbody>
                  <template v-for="product in products" v-bind:key="product.id">
                      <tr>
                          <td class="pb-4 md:table-cell">
                          <a href="#">
                              <img :src="product.associatedModel.image"  class="w-20 rounded" alt="Thumbnail">
                          </a>
                          </td>
                          <td>
                          <a href="#">
                              <p v-text="product.name" class="mb-2 md:ml-4" > </p>
                              <form action="" method="POST">
                              <button v-on:click.prevent="removeProduct(product.id)" type="submit" class="text-gray-700 md:ml-4">
                                  <small class="text-red-600" >(Delete)</small>
                              </button>
                              </form>
                          </a>
                          </td>
                          <td class="justify-center md:justify-end md:flex mt-6">
                          <div class="w-20 h-10">
                              <div class="relative flex w-full h-8 space-x-5">
                                  <button v-on:click.prevent="decrementProduct(product.id)" >-</button>
                              <input
                                  readonly
                                  type="input"
                                  :value="product.quantity"
                                  class="w-full font-semibold text-center text-black bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" />
                              <button v-on:click.prevent="incrementProduct(product.id)" >+</button>
                              </div>
                          </div>
                          </td>
                          <td class="text-right md:table-cell">
                          <span v-text="product.price" class="text-sm lg:text-base font-medium" ></span>
                          </td>
                          <td class="text-right">
                          <span v-text="product.price*product.quantity" class="text-sm lg:text-base font-medium" >
                          </span>
                          </td>
                      </tr> 
                  </template>
              </tbody>
          </table>
          <hr class="pb-6 mt-6">
          <div class="my-4 mt-6 w-1/2 mx-auto">    
            <div class="px-2">
              <div class=" text-center p-4 bg-gray-100 rounded-full">
                  <h1 class="ml-2 font-bold uppercase">Command Details</h1>
              </div>
              <div class="p-4">
                 
                      <div class="flex justify-between pt-4 border-b">
                      <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                          Total
                      </div>
                      <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                           {{ totalCart }}
                      </div>
                      </div>
                  <a href="/checkout">
                      <button class="flex justify-center w-full px-8 py-6 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                      <span class="ml-2  mt-5px">Checkout</span>
                      </button>
                  </a>
              </div>
            </div>
          </div>
          </div>
      </div>
      </div>
   
  </template>

<script setup>
import { onMounted , ref ,computed } from 'vue';
import useProduct from '../composables/products';
import emitter from 'tiny-emitter/instance';

   
   const {products,getCartProducts,increment,decrement,remove,cartCount} = useProduct();

   const totalCart = computed( ()=> {
    const price = Object.values(products.value).reduce((acc,product)=>acc= acc+(product.quantity*product.price) ,0);
    return price ;
   }
   );
   
   onMounted(async() => {
   await getCartProducts();
   });

   const incrementProduct = async (id) => {
        await increment(id);
        await getCartProducts();
        emitter.emit('CartCountChanged' , cartCount.value);
   };

   const decrementProduct = async(id) => {
     await decrement(id);
     await getCartProducts();
     emitter.emit('CartCountChanged' , cartCount.value);
   };

   const removeProduct = async (id) => {
      await remove(id);
      await getCartProducts();
      emitter.emit('CartCountChanged' , cartCount.value);
   };
</script>