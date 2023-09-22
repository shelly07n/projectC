<?php

namespace App\Services;

use App\Models\contestants;
use App\Models\contests;
use App\Models\referralCode;
use App\Models\User;
use Illuminate\Support\Str;
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
        // dd($data);

        $user = referralCode::where('referral_code', $data['referral_id'])->first();
        $contest = contests::where('id', $user->contest_id)->first();

        $contestantLimit = $contest->contestant_limit;
        $referral_id = $user->referral_id;


        $isEmpty = contestants::count() === 0;
        $getconstant  =  contestants::where('contest_id', $contest->id)->orderBy('id', 'DESC')->first();

        $contestantIsExists = contestants::where('user_id', $data['id'])
            ->where('contest_id', $user->contest_id)
            ->exists();


            // dd($contestantIsExists);

        if ($data) {
            if (!$contestantIsExists) {
                if (!$isEmpty) {
                    // contestants::where('referral_id',  $referral_id)->where('current_position', '>', $getconstant['current_position'])->decrement('current_position', 1);
                    $refer =  contestants::where('user_id', $user->referral_id)->first();
                    if($getconstant){
                        $refer->decrement('current_position', 1);
                    }
                //   dd($refer);
                }
                $newconstant =  new contestants;
                $newconstant->name = $data['name'];
                $newconstant->user_id = $data['id'];
                $newconstant->contest_id = $contest->id;
                $newconstant->referral_id = $referral_id;
                $newconstant->start_position =   empty($getconstant['start_position']) ? $contestantLimit : intval($getconstant['start_position']) + 1;
                $newconstant->current_position =   empty($getconstant['start_position']) ? $contestantLimit :  intval($getconstant['start_position']) + 1;
                // dd($newconstant);
                $newconstant->save();
            } else {
                return "Already ex";
            }


            // $ReferralExists = referralCode::where('contest_id', $contest->id)
            //     ->where('referral_id', $referral_id)
            //     ->exists();



            return response()->json(['message' => 'Records updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Records updated failure'], 200);
        }

        // dd($getconstant['current_position']);

        // $getCurrentReferralUser = contestants::where('referral_id',  $referral_id)->first();

        // dd($getconstant['current_position'] < $getCurrentReferralUser->current_position);

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

    public function findUserByReferralCode($referralCode)
    {

        $user = User::where('referral_code', $referralCode)->first();
        dd($user);
    }

    public function updateCurrentPosition($data)
    {
        dd($data);
    }
}
