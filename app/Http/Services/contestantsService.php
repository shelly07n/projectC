<?php

namespace App\Services;

use App\Models\contestants;
use App\Models\contests;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \DateTime;




class contestantsService
{

    public function getContestants()
    {

        $contestants = contestants::all();
        return $contestants->toArray();
    }

    public function createContestant($data)
    {

        $getconstant  =  contestants::orderBy('id', 'DESC')->first();

        foreach ($data as $item) {
            if ($item) {
                $newconstant =  new contestants;
                // dd($getconstant['start_position']);
                $newconstant->name = $item['name'];
                $newconstant->contest_id = $item['contest_id'];
                $newconstant->referral_id = $item['referral_id'];
                $newconstant->start_position =   empty($getconstant['start_position'] )? 99 : intval($getconstant['start_position']) + 1 ;
                $newconstant->current_position =   empty($getconstant['start_position'] )? 99 : intval($getconstant['start_position']) + 1 ;
                $newconstant->save();
                return response()->json(['message' => 'Records updated successfully'], 200);
            } else {
                return response()->json(['message' => 'Records updated failure'], 200);
            }
        }
    }


    public function updateContestant($data, $id)
    {
        // dd($data['id']);
        // $validatedData = $data->validate([
        //     'name' => 'required|string|max:255',
        //     // Add validation rules for other attributes as needed
        // ]);

        // Replace with the actual user ID you want to update
        $contestant = contestants::findOrFail($id);
        if ($contestant) {
            $contestant->update($data);
            return response()->json(['message' => 'Records updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Records updated failure'], 200);
        }
    }

    public function deleteContestant($id)
    {
        $contestant = contestants::findOrFail($id);
        $contestant->delete();
        return response()->json(['message' => 'contestant deleted successfully']);
    }

    // public function updateCurrentPosition($data){

    //        $currentlySelectedContest = contestants::where

    // }



}
