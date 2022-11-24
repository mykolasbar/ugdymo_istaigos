<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use Illuminate\Http\Request;
use App\Models\RequestsSchools;
use Illuminate\Support\Facades\DB;

class requestsController extends Controller
{
    public function newPupil (Request $request)
    {
        $request->validate([
            "idnumber"=>"required",
            "dateofbirth"=>"required",
            // "picture"=>"image|mimes:jpeg,png,jpg,gif,svg",
            "name"=>"required",
            // "user_id"=>"required"
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->picture->storeAs('images', $request->picture->getClientOriginalName());
        }

        $newRequest = new Requests();
        $newRequest->idnumber = $request->idnumber;
        $newRequest->dateofbirth = $request->dateofbirth;
        // $newRequest->picture = $path;
        $newRequest->name = $request->name;
        $newRequest->class = $request->class;
        $newRequest->user_id = $request->user_id;
        $newRequest->save();
    }

    public function addRequest(Requests $request)
    {
        // $request->validate([
        //     "requests_id"=>"required",
        //     "schools_id"=>"required",
        // ]);

        // $newRequest = RequestsSchools::firstOrNew(
        //     ['requests_id' => $request->requests_id, 'schools_id' => $request->schools_id],
        //     // ['user_id' => $request->user_id]
        // );

        $newRequest = new RequestsSchools();
        $newRequest->requests_id = $request->requests_id;
        $newRequest->schools_id = $request->schools_id;

        $newRequest->save();
    }

    public function showUserPupils($userid)
    {
        $hotels = DB::table('requests')->where('user_id', '=', $userid)->get();
        return $hotels;
    }
}
