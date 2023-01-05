<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Requests;
use Illuminate\Http\Request;
use App\Models\RequestsSchools;
use Illuminate\Support\Facades\DB;



class requestsController extends Controller
{
    public function getDateOfBirth($idnumber) {

        $datearray = str_split(mb_substr($idnumber, 1, 6), 2);

        if ($datearray[0] <= '22') {
            $datearray[0] = '20' . $datearray[0];
        }

        if ($datearray[0] >= '22' && $datearray[0] <= '99') {
            $datearray[0] = '19' . $datearray[0];
        }

        $dateofbirth =  implode(' ', $datearray);

        return $dateofbirth;
    }

    public function newPupil (Request $request)
    {
        $request->validate([
            "idnumber"=>"required",
            // "dateofbirth"=>"required",
            // "picture"=>"image|mimes:jpeg,png,jpg,gif,svg",
            "name"=>"required",
            // "user_id"=>"required"
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->picture->storeAs('images', $request->picture->getClientOriginalName());
        }

        // $newRequest = Requests::firstOrNew(
        //     ['idnumber' => $request->idnumber],
        // );


        $newRequest = Requests::where('idnumber', $request->idnumber)->first();

        if (is_null($newRequest)) {
            $newRequest = new Requests();
            $newRequest->idnumber = $request->idnumber;
            $newRequest->dateofbirth = $this->getDateOfBirth($request->idnumber);
            // // $newRequest->picture = $path;
            $newRequest->name = $request->name;
            $newRequest->class = $request->class;
            $newRequest->user_id = $request->user_id;
            $newRequest->save();

            return ['message' => 'Mokinys pridėtas sėkmingai'];
        }
        else return ['message' => 'Toks mokinys jau yra'];
    }

    public function addRequest(Request $request)
    {
        if ($request->has('requests_id')) {

            $request->validate([
                "requests_id"=>"required",
                "schools_id"=>"required",
            ]);

            $newOrder = new RequestsSchools();
            $newOrder->requests_id = $request->requests_id;
            $newOrder->schools_id = $request->schools_id;
            $newOrder->save();
        }

        else {
            $request->validate([
                "schools_id"=>"required",
            ]);

            $request_id = Requests::latest()->first()->id;

            $newOrder = new RequestsSchools();
            $newOrder->requests_id = $request_id;
            $newOrder->schools_id = $request->schools_id;
            $newOrder->save();
        }
    }

    public function showAllRequests(Request $request)
    {
        return RequestsSchools::with('requests', 'schools')->get();
    }

    public function showUserPupils($userid)
    {
        $requests = Requests::with('requests_schools')->where('user_id', '=', $userid)->get();
        return $requests;
    }

    // public function showUserPupils($userid)
    // {
    //     $hotels = DB::table('requests')->where('user_id', '=', $userid)->get();
    //     return $hotels;
    // }

    public function confirmRequest($id) {
        $order = RequestsSchools::find($id);
        $order->confirmed = true;
        $order->save();
    }

    public function makeViewed($userid) {
        // RequestsSchools::where('viewed', '=', 0)->update(['viewed' => 1]);
        RequestsSchools::with('requests')->whereRelation('requests', 'user_id', '=', $userid)->update(['viewed' => 1]);
    }

    public function showPupil($id) {
        $pupil = Requests::find($id);
        return $pupil;
    }

    public function showUserRequests($userid) {
        $orders = RequestsSchools::with('requests', 'schools')->whereRelation('requests', 'user_id', '=', $userid)->get();
        return $orders;
    }

    public function deletePupil($id)
    {
        Requests::destroy($id);
    }

    public function editPupil(Request $request, $id) {
        $request->validate([
            "idnumber"=>"required",
            "name"=>"required",
        ]);

            $updatePupil = Requests::find($id);
            $updatePupil->idnumber = $request->idnumber;
            $updatePupil->dateofbirth = $this->getDateOfBirth($request->idnumber);
            $updatePupil->name = $request->name;
            $updatePupil->class = $request->class;
            $updatePupil->user_id = $request->user_id;
            $updatePupil->save();

            return ['message' => 'Mokinys pridėtas sėkmingai'];
    }

}
