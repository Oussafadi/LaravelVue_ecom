<?php

namespace App\Repositories;

use App\Models\Product;
use Darryldecode\Cart\Cart;

class CartRepository
{

    public function add(Product $product)
    {
        \Cart::session(auth()->user()->id)->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        return $this->count();
    }

    public function content()
    {
        return  \Cart::session(auth()->user()->id)->getContent();
    }

    public function count()
    {
        return  $this->content()->sum('quantity');
    }

    public function increment(int $id)
    {

        \Cart::session(auth()->user()->id)->update($id, [
            'quantity' => +1,
        ]);
    }
    public function decrement(int $id)
    {

        $quantity = \Cart::session(auth()->user()->id)->get($id)->quantity;

        if ($quantity === 1) {
            return $this->delete($id);
        }

        \Cart::session(auth()->user()->id)->update($id, [
            'quantity' => -1,
        ]);
    }

    public function delete(int $id)
    {
        \Cart::session(auth()->user()->id)->remove($id);
    }
}
