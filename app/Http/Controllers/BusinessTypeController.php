<?php

namespace App\Http\Controllers;

use App\BusinessType;
use Illuminate\Http\Request;

class BusinessTypeController extends Controller
{
    public function getBusinessTypeData(){
        return BusinessType::get();
    }
}
