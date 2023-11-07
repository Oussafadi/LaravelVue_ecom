import {ref, transformVNodeArgs} from 'vue';
export default function useProduct() {
     
     const products = ref([]);
     const cartCount=ref(0);

    const getCartProducts = async() => {
        let response = await axios.get('api/products');
        products.value = response.data.products;
        cartCount.value = response.data.cartCount;
    }

    const add =  async(productId) => {
        let response = await axios.post('api/products', {
            productId: productId
        });
        
          return response.data.count;
    }

    const getCount = async() => {
      let response = await axios.get('api/products/count');

      return response.data.count ;
    }

    const increment = async(productId) => {
         await axios.get('api/increment-product/'+ productId);
    };

    const decrement = async(productId) => {
        await axios.get('api/decrement-product/'+ productId);
    };

    const remove = async(productId)=> {
        await axios.delete('api/products/'+productId);
    };

    return {
        add,getCount,getCartProducts,products,increment , decrement , remove,cartCount
    }
}