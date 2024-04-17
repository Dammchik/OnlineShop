<?php

namespace App\Http\Controllers;

use App\Enum\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use Darryldecode\Cart\ItemCollection;
use Illuminate\Http\Request;
use function Sodium\add;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function makeOrder(Request $request)
    {
        \Cart::session(auth()->id());

        $cartContents = \Cart::getContent();

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => OrderStatus::NEW,
        ]);

        /** @var ItemCollection $cartContent */
        foreach ($cartContents as $cartContent){
            $order->orderProducts()->create([
                'name'=> $cartContent->get('name'),
                'quantity'=> $cartContent->get('quantity'),
                'price'=> $cartContent->get('price'),
            ]);
        };

        \Cart::clear();

        return redirect()
            ->route('home')
            ->with('message', 'Order created');
    }

    public function clearCart(Request $request)
    {
        \Cart::session(auth()->id())
        ->clear();
        return redirect()
            ->back()
            ->with('message', 'Cart cleared');
    }

    public function cart()
    {
        \Cart::session(auth()->id());
        $cartContent = \Cart::getContent();


        return view('carts.cart')->with('cartContent', $cartContent);

    }

    public function removeProduct(Request $request){
        $validated = \Validator::validate($request->input(), [
            'product_id' => 'required|exists:products,id',
        ]);
        $product = Product::find($validated['product_id']);

        \Cart::session(auth()->id())->remove($validated['product_id']);
        return redirect()->back()->with('message', 'Product removed from cart');
    }

    public function addProduct(Request $request)
    {
        $request->input('product_id');
        $validated = \Validator::validate($request->input(), [
            'product_id' => 'required|exists:products,id',
        ]);
        $product = Product::find($validated['product_id']);

        \Cart::session(auth()->id());

        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'article' => $product->article
            ],
            'associatedModel' => $product
        ]);
        return redirect()->back()->with('message', 'Product added to cart');
    }
}
