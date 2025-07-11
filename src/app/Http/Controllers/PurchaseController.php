<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index($id){
        return view('purchase.index', ['id' => $id]);
    }
}
