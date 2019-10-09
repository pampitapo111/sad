<?php

namespace App\Http\Controllers;
use Hash;
use App\Order;
use App\Cart;
use App\Item;
use App\User;
use Auth;
use Image;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NotifyCart;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

  

    public function add_cart(Request $request)
    {   
        $id=Auth::user()->id;
        $qty = $request->quantity;
        $item_id = $request->product;
        $items = Item::where('id','=',$item_id)->get();
        $price = $items->get(0)->price;
        $total = $qty*$price;

        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->item_id = $request->product;
        $cart->quantity = $request->quantity;
        $cart->status = 'not paid';
        $cart->price = $total;
        $cart->save();
        $request->session()->flash('alert-success', 'Item successfully added to cart!');
        return redirect()->back();
    }


    public function delete_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();

    }

    public function show_cart($id)
    {
        $cart = Cart::where('user_id','=',$id)
        ->where('status','=','not paid')
        ->get();
        $total = 0;
        foreach($cart as $i){
                $total = $total+$i->price;
        }
        
        return view('user.showcart',['cart'=>$cart,'total'=>$total]);
    }

    
    public function show_checkout($id)
    {
        $cart = Cart::where('user_id','=',$id)
        ->where('status','=','not paid')
        ->get();
        $total = 0;
        foreach($cart as $i){
                $total = $total+$i->price;
        }
        
        return view('user.checkout',['cart'=>$cart,'total'=>$total]);
    }

    public function checkout(Request $request,$id)
    {
     $carts = Cart::with('items','users')->where('user_id','=',$id)
     ->where('status','=','not paid')
     ->get();

foreach($carts as $i){
        $cart = Cart::find($i->id);
        $cart->status = 'paid';
        $cart->payment_option = $request->payment_option;
        $cart->card_name = $request->card_name;
        $cart->card_number = $request->card_number;
        $cart->expiry_date = $request->expiry_date;
        $cart->cvv = $request->cvv;
        $cart->save();
      
        $user=User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->contact = $request->contact;
        $user->address = $request->address;
        $user->save();

        $order = new Order();
        $order->cart_id = $i->id;
        $order->status = 'Waiting for confirmation';
        $order->save();
        $request->session()->flash('alert-success', 'Order Successful!');
        return redirect()->route('purchase',Auth::user()->id);
      
    }
    }
 

    public function show_order()
    {
        $id = Auth::user()->id;
        $order = Order::with('cart')->whereHas('cart', function ($q) use($id){
            $q->where('user_id', $id);
        })->get();

    return view('user.order',['order'=>$order]);
    }

   

    public function account()
    {
        $id = Auth::user()->id;
        $user = User::where('id','=',$id)->get();
        return view('user.account',['user'=>$user]);
    }

    public function update_account(Request $request,$id)
    {
        $this->validate($request, [
            'password' => 'required|confirmed'
        ], [
  

        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->contact = $request->contact;
        $user->password = Hash::make($request['password']);
        $user->save();
        $request->session()->flash('alert-success', 'Account successfully updated!');
        return redirect()->back();
    }

    public function deliver(Request $request,$id)
    {
        $order = Order::find($id);
        $order->status = 'Completed';
        $order->save();
        $request->session()->flash('alert-success', 'Order successfully completed!');
        return redirect()->back();

    }

}
