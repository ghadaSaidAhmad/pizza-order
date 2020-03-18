<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Order;
use App\Item;

class OrderController extends BaseController
{

    public function index()
    {
        $data= $this->user->orders()->get()->toArray();

        if(!$data)
        {
            return  $this->response(false,'no rows found',[]);  
        }
        
        return  $this->response(true,'rows  successfully  listed',$data);  
        
    }
    public function show($id)
    {
        $order = Order::find($id);
        
        if(!$order)
        {
            return  $this->response(false,'no rows found',[]);  
        }
        
        return  $this->response(true,'rows  successfully  listed',$order); 
       
    }


    public function store(Request $request)
    {

        $order = new Order();
        $order->name = $request->name;
        $this->user->orders()->save($order);
        if(count($request->items)>0)
        {
            $order=$this->user->orders()->save($order);
            $flag=true;

            //add order items (pizzas)
            foreach($request->items as $item)
            {
               
                $itemObject =new Item([
                    'order_id' => $order->id,
                    'pizza_id' => $item['pizza_id'],
                    'size' => $item['size'],
                    'number' => $item['number'],
                ]);

                $flag=$order->items()->save($itemObject)?true:false; 
            }
            if ($flag) {
                  return $this->response(true,'order added successfuly');
            }
             $this->response(false,'sorry,faild to add order ',500);
  
            //
        }
        

        
    }


    public function update(Request $request, $id)
    {
   
        $order = Order::find($id);
        if (!$order) {

            return $this->response(false,[],'Sorry, product with id ' . $id . ' cannot be found',400);
        }
        $order->status = $request->status;

        if ($order->save()) {
            return $this->response(true,'order updated successfuly');
           
        }
            $this->response(false,'sorry,faild to update order ',500);
        
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return $this->response(false,[],'Sorry, row with id ' . $id . ' cannot be found',400);
        }
        if ($order->status!=0) {
          
            if($order->delete())
            {
                return $this->response(true,'row  be deleted');
            }
  
        }
        return $this->response(false,'row could not be deleted',500);
        


    }
    //
}
