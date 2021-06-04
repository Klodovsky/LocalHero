<?php

namespace App\Http\Controllers;

use App\SalesPerson;
use Illuminate\Http\Request;

class ValidatorController extends Controller
{
    public function getValidatorData(){
        return SalesPerson::get();
    }
    public function getPersonData(Request $request){
        dd($request->name);
        // return SalesPerson::get();
    }

    // checking conflict
    public function checkConflict(Request $request){

        $sales_person = SalesPerson::find($request->sales_person);
        $stored_codes = explode(",", $sales_person->post_code);
        $user_codes = Array();

        $conflict = false;

        foreach($request->codes as $single_user_code)
        {
            array_push($user_codes, $single_user_code['code']);

        }

        foreach($stored_codes as $single_stored_code)
        {
            foreach($user_codes as $single_user_code)
            {
                if($single_stored_code == $single_user_code)
                {
                    $conflict = true;
                    break 2;
                }
                else
                {
                    if (str_contains($single_stored_code, '*')) { 
                        $single_store_code_from = explode("*", $single_stored_code);
                        $single_store_code_to =  $single_store_code_from[0].'99';

                        if(($single_user_code >= $single_store_code_from[0]) AND ($single_user_code <= $single_store_code_to))
                        {
                            $conflict = true;
                            break 2;
                        }
                    }
                }
            }
        }

        if($conflict)
        {
            return response()->json([
                'status'    => 400,
                'message'   => 'Conflict occurs',
                'stored_codes'   => $stored_codes,
                'input_codes'   => $user_codes
            ]);
        }
        else
        {
            // no conflict found
            return response()->json([
                'status'    => 200,
                'message'   => 'No Conflict',
                'stored_codes'   => $stored_codes,
                'input_codes'   => $user_codes
            ]);
        }
        
    }
    // getting specific sales person
    public function getSpecificSalesPerson(Request $request)
    {

        // $validator = Validator::make($request->all(),[
        //     'id' => 'required',
        // ]);

        // if($validator->fails())
        // {
        //     return response()->json([
        //         'status'  => 401,
        //         'message' => 'Please Review All Fields',
        //         'errors'  => $validator->errors()
        //     ]);
        // }

        $sales_person = SalesPerson::find($request->id);
        $string_parts = explode(",", $sales_person->post_code);
        
        $sales_person->post_code = $string_parts;

        return response()->json([
            'status'    => 400,
            'message'   => 'Please select a business type',
            'sales_person'   => $sales_person
        ]);
        
    }
}