<?php

namespace App\Http\Controllers;

use App\Services\contactService;
use Illuminate\Http\Request;

class contactController extends Controller
{
    public function getContacts($user_id, contactService $contactService)
    {
        return $contactService->getContacts($user_id);
    }

    public function createContact(Request $request, contactService $contactService)
    {
        // dd($request->all());
        return $contactService->createContact($request->all());
    }

    public function updateContact(Request $request, $id, contactService $contactService)
    {
        return $contactService->updateContact($request->all(),$id);
    }

    public function deleteContact($id,contactService $contactService)
    {
        return $contactService->deleteContact($id);
    }

}
