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
        $user = referralCode::where('referral_code', $data['referral_id'])->first();
        $contest = contests::where('id', $user->contest_id)->first();
        $contestantLimit = $contest->contestant_limit;
        $referral_id = $user->referral_id;
        $isEmpty = contestants::count() === 0;
        $getConstestant  =  contestants::where('contest_id', $contest->id)->orderBy('id', 'DESC')->first();

        $contestantIsExists = contestants::where('user_id', $data['id'])
            ->where('contest_id', $user->contest_id)
            ->exists();
        if ($data) {
            if (!$contestantIsExists) {
                if (!$isEmpty) {
                    if($getConstestant){
                        $refer =  contestants::where('user_id', $user->referral_id)->where('contest_id', $contest->id)->first();
                        $refer->decrement('current_position', 1);
                    }
                }
                $newconstant =  new contestants;
                $newconstant->name = $data['name'];
                $newconstant->user_id = $data['id'];
                $newconstant->contest_id = $contest->id;
                $newconstant->referral_id = $referral_id;
                $newconstant->start_position =   empty($getConstestant['start_position']) ? $contestantLimit : intval($getConstestant['start_position']) + 1;
                $newconstant->current_position =   empty($getConstestant['start_position']) ? $contestantLimit :  intval($getConstestant['start_position']) + 1;
                $newconstant->save();
            } else {
                return "Already ex";
            }

            return response()->json(['message' => 'Records updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Records updated failure'], 200);
        }

    }


    public function updateContestant($data, $id)
    {
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
    }


}
