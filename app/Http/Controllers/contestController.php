<?php

namespace App\Http\Controllers;

use App\Services\contestService;
use Illuminate\Http\Request;

class contestController extends Controller
{
    public function getContests($user_id, contestService $contestService)
    {
        return $contestService->getContests($user_id);
    }

    public function createContest(Request $request, contestService $contestService)
    {
        return $contestService->createContest($request->all());
    }
    public function updateContest(Request $request, $id, contestService $contestService)
    {
        return $contestService->updateContest($request->all(),$id);
    }

    public function deleteContest($id,contestService $contestService)
    {
        return $contestService->deleteContest($id);
    }
    public function sentInvitation(Request $request,contestService $contestService)
    {
        $currentDomain = $request->getSchemeAndHttpHost();
        return $contestService->sentInvitation($request->contestDetails,$request->userdetails,$currentDomain,$request->currentUser);
    }
    public function getCurrentUserParticipatingContests($user_id,contestService $contestService)
    {
        return $contestService->getCurrentUserParticipatingContests($user_id);
    }
    public function getContestById($contest_id,contestService $contestService)
    {
        return $contestService->getContestById($contest_id);
    }
    public function showReferralDialog($id,contestService $contestService)
    {
        return $contestService->showReferralDialog($id);
    }
    public function joinContestWithoutReferralCode(Request $request,contestService $contestService)
    {
        return $contestService->joinContestWithoutReferralCode($request->contestDetails,$request->currentUser);
    }
}
