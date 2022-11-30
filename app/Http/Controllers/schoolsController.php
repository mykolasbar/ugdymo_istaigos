<?php

namespace App\Http\Controllers;

use App\Models\Schools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class schoolsController extends Controller
{
    public function showAllSchools(Request $request)
    {
        // if ($request->embed === 'hotels'){
        //     return Countries::with('hotels')->get();}
        return Schools::all();
    }

    public function deleteSchool($id)
    {
        Schools::destroy($id);
    }

    public function addSchool(Request $request)
    {
        $request->validate([
            "title"=>"required",
            "code"=>"required",
            "address"=>"required",
        ]);

        $newSchool = new Schools();
        $newSchool->title = $request->title;
        $newSchool->code = $request->title;
        $newSchool->address = $request->address;
    }

    public function showSingleSchool($id)
    {
        return Schools::find($id);
    }

    public function updateSchool(Request $request, $id)
    {
        $request->validate([
            "title"=>"required",
            "code"=>"required",
            "address"=>"required",
        ]);

        $post = Schools::find($id);
        $post->update($request->all());

        return $request;
    }

    public function newSchool(Request $request)
    {
        $request->validate([
            "title"=>"required",
            "code"=>"required",
            "address"=>"required",
        ],
        [
            "title.required" => "Title field cannot be empty",
            "code.required" => "Code field cannot be empty",
            "address.required" => "Address field cannot be empty"
        ]);

        $newSchool = new Schools();
        $newSchool->title = $request->title;
        $newSchool->code = $request->code;
        $newSchool->address = $request->address;
        $newSchool->save();

        return $request;

    }

    public function searchSchools(Request $request)
    {

        $query = $request->input('query');

            $queryresults = DB::table('schools')->where('title', 'like', '%' . $query . '%')->get();
                // ->orWhere('email', 'like', '%' . request('search') . '%')
                // ->orWhere('id', 'like', '%' . request('search') . '%');

        return $queryresults;
    }

}
