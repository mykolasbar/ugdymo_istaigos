<?php

namespace App\Http\Controllers;

use App\Models\Schools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    // public function addSchool(Request $request)
    // {
    //     $request->validate([
    //         "title"=>"required",
    //         "code"=>"required",
    //         "picture"=>"image|mimes:jpeg,png,jpg,gif,svg",
    //         "address"=>"required",
    //     ]);

    //     if ($request->hasFile('picture')) {
    //         $path = $request->picture->storeAs('storage', $request->picture->getClientOriginalName());
    //     }

    //     $newSchool = new Schools();
    //     $newSchool->title = $request->title;
    //     $newSchool->code = $request->title;
    //     $newSchool->picture = $path;
    //     $newSchool->address = $request->address;
    //     $newSchool->save();

    //     return $path;
    // }

    public function showSingleSchool($id)
    {
        return Schools::find($id);
    }

    public function updateSchool(Request $request, $id)
    {
        $request->validate([
            "title"=>"required",
            "code"=>"required",
            "picture"=>"image|mimes:jpeg,png,jpg,gif,svg",
            "address"=>"required",
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->picture->storeAs('images', $request->picture->getClientOriginalName(), 's3');

            Storage::disk('s3')->setVisibility($path, 'public');
        }

        $post = Schools::find($id);
        $post->title = $request->title;
        $post->code = $request->code;
        $post->picture = $path;
        $post->address = $request->address;
        $post->save();

        // $post->update($request->all());

        return $path;
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

        if ($request->hasFile('picture')) {
            $path = $request->picture->storeAs('images', $request->picture->getClientOriginalName(), 's3');
            // $path = $request->picture->storeAs('images', $request->picture->getClientOriginalName());
            // Storage::disk('s3')->setVisibility($path, 'public');
        }

        $newSchool = new Schools();
        $newSchool->title = $request->title;
        $newSchool->code = $request->code;
        $newSchool->picture = $path;
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
