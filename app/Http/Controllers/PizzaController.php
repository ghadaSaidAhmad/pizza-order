<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddPizzaRequest; 
use App\Http\Requests\updatePizzaRequest; 
use JWTAuth;
use App\Pizza;

class PizzaController extends BaseController
{


    public function index()
    {
        return Pizza::all()->toArray();
    }
    
    public function show($id)
    {
        $pizza = Pizza::find($id);
    
        if (!$pizza) {
            return  $this->response(false,'Sorry, Sorry with id ' . $id . ' cannot be found',400);
        }
    
        return $pizza;
    }

    public function store(AddPizzaRequest $request)
    {
        $pizza = new Pizza($request->except(['token']));

        if ($pizza->save())
        {
            return $this->response(true,'row  successfully  addes');
        }
        $this->response(false,'Sorry, Sorry could not be added',500);
 
    }

    public function update(updatePizzaRequest $request, $id)
    {
        $pizza = Pizza::find($id);

        if (!$pizza) {
            return  $this->response(false,'Sorry, Sorry with id ' . $id . ' cannot be found',400);

        }
        $updated = $pizza->fill($request->all())->save();
        
        if ($updated) {
           return $this->response(true,'row  successfully  updated');
           
        }
        $this->response(false,'Sorry, Sorry could not be updated',500);
        
        
    }

    public function destroy($id)
    {
        $pizza = Pizza::find($id);
    
        if (!$pizza) {
           
            return  $this->response(false,'Sorry, Sorry with id ' . $id . ' cannot be found',400);
        }

        if($pizza->delete())
        {
            return $this->response(true,'row  be deleted');
        }
        
          $this->response(false,'row could not be deleted',500);
   
    }

  
    
    
    
}