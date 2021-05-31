<?php

namespace App\Http\Controllers;

use App\SalesPerson;
use Illuminate\Http\Request;

class ValidatorController extends Controller
{
    public function getValidatorData(){
        return SalesPerson::get();
    }
}
