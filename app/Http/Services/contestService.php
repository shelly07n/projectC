<?php

namespace App\Services;

use App\Mail\mailSetup;
use App\Models\contacts;
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
use Illuminate\Support\Facades\DB;

class contestService
{


    public function getContests($user_id)
    {
        $contests = contests::all();
        $response = array();

        foreach ($contests as $key => $item) {

            $contestantIsExists = contestants::where('user_id', $user_id)
                ->where('contest_id', $item->id)
                ->exists();
            if ($contestantIsExists) {
                $item['status'] = 1;
            } else {
                $item['status'] = 0;
            }

            array_push($response, $item);
        }


        return $response;
    }

    public function createContest($data)
    {
        foreach ($data as $item) {
            if ($item) {
                contests::create($item);
                return response()->json(['message' => 'Records updated successfully'], 200);
            } else {
                return response()->json(['message' => 'Records updated failure'], 200);
            }
        }
    }


    public function updateContest($data, $id)
    {
        $contest = contests::findOrFail($id);
        if ($contest) {
            $contest->update($data[0]);
            return response()->json(['message' => 'Records updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Records updated failure'], 200);
        }
    }

    public function deleteContest($id)
    {
        $contest = contests::findOrFail($id);
        $contest->delete();
        return response()->json(['message' => 'Contest deleted successfully']);
    }

    public function sentInvitation($contestDetails, $userDetails, $currentDomain, $currentUser)
    {
        $referralCode = '';
        $referral = referralCode::where('referral_id', $currentUser)->first();
        $isEmpty = referralCode::count() === 0;
        $ReferralExists = false;
        if (!$isEmpty) {
            $ReferralExists = referralCode::where('referral_id', $currentUser)
                ->where('contest_id', $contestDetails['id'])
                ->exists();
        }

        if (!$ReferralExists) {
            $referralCode = 'shelton' . $contestDetails['name'] . Str::random(10) . 'ton';
            $newReferral = new referralCode;
            $newReferral->contest_id = $contestDetails['id'];
            $newReferral->referral_id = $currentUser;
            $newReferral->referral_code =  $referralCode;
            $newReferral->save();
        }else{
            $referralCode = $referral->referral_code;
        }

        $userEmail = $userDetails['email'];

        $subject = "Invitation to Participate in Contest";
        $userReferralCode = $referralCode;
        $contestName = $contestDetails['name'];
        $contestStartDate = $contestDetails['start_date'];
        $contestEndDate = $contestDetails['end_date'];
        $contestantLimit = $contestDetails['contestant_limit'];
        $winningPrize = $contestDetails['winning_prize'];

        $isSent = \Mail::to($userEmail)->send(new mailSetup(
            $subject,
            $userReferralCode,
            $contestName,
            $contestStartDate,
            $contestEndDate,
            $contestantLimit,
            $winningPrize,
            $currentDomain
        ));

        if ($isSent) {
            $contacts = contacts::find($userDetails['id']);
            $contacts->update(['status' => 'Sent']);
            return "mail sent";
        } else {
            return "not sent";
        }
    }

    public function getCurrentUserParticipatingContests($user_id)
    {
        $contestant = contestants::where('user_id', $user_id)
            ->join('contests', 'contestants.contest_id', '=', 'contests.id')
            ->get();
        $contest = contests::all();

        $contestResults = array();

        foreach ($contest as $result) {
            $leading =  contestants::where('contest_id', $result->id)->min('current_position');
            $leadingContestant = contestants::where('current_position', $leading)
                 ->join('users', 'contestants.referral_id', '=', 'users.id')
                //  ->join('contests', 'contestants.contest_id', '=', 'contests.id')
                ->first();
            array_push($contestResults, $leadingContestant);
        }
        $response = ["contestant_status" => $contestant->toArray(), "Contest" => $contest, "contestResults" => $contestResults];
        return  $response;
    }

    public function joinContestWithoutReferralCode($data, $user)
    {
        $contest = contests::where('id', $data['id'])->first();
        $contestantLimit = $contest->contestant_limit;
        $getConstestant  =  contestants::where('contest_id', $contest->id)->orderBy('id', 'DESC')->first();

        $contestantIsExists = contestants::where('user_id', $user)
            ->where('contest_id', $data['id'])
            ->exists();


        if ($data) {
            if (!$contestantIsExists) {
                $newconstant =  new contestants;
                $newconstant->name = $data['name'];
                $newconstant->user_id = $user;
                $newconstant->contest_id = $data['id'];
                $newconstant->referral_id = $user;
                $newconstant->start_position =   empty($getConstestant['start_position']) ? $contestantLimit : intval($getConstestant['start_position']) + 1;
                $newconstant->current_position =   empty($getConstestant['start_position']) ? $contestantLimit :  intval($getConstestant['start_position']) + 1;
                // dd($newconstant);
                $newconstant->save();
            } else {
                return "Already ex";
            }
            return response()->json(['message' => 'Records updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Records updated failure'], 200);
        }
    }


    public function getContestById($contest_id)
    {
        $contestant = contestants::where('contest_id', $contest_id)->orderBy('current_position', 'ASC')->get();

        return $contestant;
    }
    public function showReferralDialog($id)
    {
        $canShowReferral =  contestants::where('user_id',$id )->exists();
        return ['canShowReferral' => $id == 1 ? false :  !$canShowReferral];
    }
}
