<?php

namespace App\Http\Controllers;

use App\BusinessType;
use Illuminate\Http\Request;

class BusinessTypeController extends Controller
{
    public function getBusinessTypeData(){
        return BusinessType::get();
    }
    // getting specific business tpyes
    public function getSpecificBusinessTypes(Request $request)
    {
        

        // $validator = Validator::make($request->all(),[
        //     'business_values' => 'required| json',
        // ]);

        // if($validator->fails())
        // {
        //     return response()->json([
        //         'status'  => 401,
        //         'message' => 'Please Review All Fields',
        //         'errors'  => $validator->errors()
        //     ]);
        // }
        //dd($request->business_values);
        $business_ids = Array();


        foreach($request->business_values as $values){
           
                //$business_type_id = $single_value['id'];
                array_push($business_ids, $values['id']);

            

        }
        //dd($business_ids);









        //$business_ids = Array();

        // $business_values = json_decode($request->business_values, true);
           
        // if(count($business_values))
        // {
            // foreach ($business_values as $single_single_business_value) 
            // {
            //     $business_type_id = $single_single_business_value['id']; 

            //     array_push($business_ids, $single_single_business_value['id']);
            // }

            $all_business_types = BusinessType::whereIn('id', $business_ids)->get();

            return response()->json([
                'status'    => 200,
                'message'   => 'Business types',
                'data'   => $all_business_types
            ]);

        // }
        // else
        // {
        //     return response()->json([
        //         'status'    => 400,
        //         'message'   => 'Please select a business type'
        //     ]);
        // }
    }
}
