<?php

namespace App\Http\Controllers;

use App\Models\Schools;
use Illuminate\Http\Request;

class schoolsController extends Controller
{
    public function showAllSchools(Request $request)
    {
        // if ($request->embed === 'hotels'){
        //     return Countries::with('hotels')->get();}
        return Schools::all();
    }
}
