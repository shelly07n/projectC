<?php

namespace App\Services;

use App\Mail\mailSetup;
use App\Models\contacts;
use App\Models\contests;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \DateTime;




class contestService
{

    public function getContests()
    {

        $contests = contests::all();
        return $contests->toArray();
    }

    public function createContest($data)
    {
        // dd($data);
        // $validatar = $data->validate([
        //     'name' => 'required',
        // ]);

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
        // dd($data['id']);
        // $validatedData = $data->validate([
        //     'name' => 'required|string|max:255',
        //     // Add validation rules for other attributes as needed
        // ]);

        // Replace with the actual user ID you want to update
        $contest = contests::findOrFail($id);

        if ($contest) {
            $contest->update($data);
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

    public function sentInvitation($contestDetails, $userDetails, $currentDomain)
    {


        $user = User::find($userDetails['user_id']);


        $userEmail = $userDetails['email'];

        $subject = "Contest Invitation";
        $userReferralCode = $user->referral_code;
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
}
