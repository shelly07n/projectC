<?php

namespace App\Http\Controllers;

use App\Services\contestantsService;
use Illuminate\Http\Request;

class contestantController extends Controller
{
    public function getContestants(Request $request, contestantsService $contestantsService)
    {
        return $contestantsService->getContestants();
    }

    public function createContestant(Request $request, contestantsService $contestantsService)
    {
        return $contestantsService->createContestant($request->all());
    }
    public function updateContestant(Request $request,$id,contestantsService $contestantsService)
    {
        return $contestantsService->updateContestant($request->all(),$id);
    }
    public function deleteContestant($id, contestantsService $contestantsService)
    {
        return $contestantsService->deleteContestant($id);
    }
    public function findUserByReferralCode(Request $request, contestantsService $contestantsService)
    {
        return $contestantsService->findUserByReferralCode($request->referralCode);
    }
}
