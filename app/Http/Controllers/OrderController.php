<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Order;
use App\Item;

class OrderController extends BaseController
{

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= $this->user->orders()->get()->toArray();

        if(!$data)
        {
            return  $this->response(false,'no rows found',[]);  
        }
        
        return  $this->response(true,'rows  successfully  listed',$data);  
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $order = Order::find($id);
        
        if(!$order)
        {
            return  $this->response(false,'no rows found',[]);  
        }
        
        return  $this->response(true,'rows  successfully  listed',$order); 
       
    }

    /**
     * filtter the specified resource by username or order status.
     *
     * @param  int  $username
     * @param  int  $order status
     * @return \Illuminate\Http\Response
     */
    public function filtter(Request $request)
    {
        $userName     = $request->user_name;
        $orderStatus  = $request->order_status;

        $order        = Order::Join('users', function($join) use ($userName)
                          {
                              $join->on('users.id', '=', 'orders.user_id');
                              $join->where('users.name',$userName);
                          })
                       ->orWhere('orders.status',$orderStatus)   
                      ->get();
        
        if(!$order)
        {
            return  $this->response(false,'no rows found',[]);  
        }
        
        return  $this->response(true,'rows  successfully  listed',$order); 
       
    }

    /**
     * showByName the specified resource by name 
     *
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function showByName($name)
    {
        $order = Order::where('name',$name)->first();
        if(!$order)
        {
            return  $this->response(false,'no rows found',[]);  
        }
        
        return  $this->response(true,'rows  successfully  listed',$order); 
       
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
    
}
