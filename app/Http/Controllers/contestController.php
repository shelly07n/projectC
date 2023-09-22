<?php

namespace App\Http\Controllers;

use App\Services\contestService;
use Illuminate\Http\Request;

class contestController extends Controller
{
    public function getContests(Request $request, contestService $contestService)
    {
        return $contestService->getContests();
    }

    public function createContest(Request $request, contestService $contestService)
    {
        // dd($request->all());
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
                // dd($request->all());

        $currentDomain = $request->getSchemeAndHttpHost();
        return $contestService->sentInvitation($request->contestDetails,$request->userdetails,$currentDomain,$request->currentUser);
    }
    public function currentStatusContest($user_id,contestService $contestService)
    {
        return $contestService->currentStatusContest($user_id);
    }
}
