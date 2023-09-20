<?php

namespace App\Services;

use App\Models\contacts;
use App\Models\contestants;
use App\Models\contests;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \DateTime;




class contactService
{

    public function getContacts()
    {

        $contacts = contacts::all();
        return $contacts->toArray();
    }

    public function createContact($data)
    {

        foreach ($data as $item) {
            if ($item) {
                contacts::create($item);
                return response()->json(['message' => 'Records updated successfully'], 200);
            } else {
                return response()->json(['message' => 'Records updated failure'], 200);
            }
        }
    }


    public function updateContact($data, $id)
    {
        // dd($data['id']);
        // $validatedData = $data->validate([
        //     'name' => 'required|string|max:255',
        //     // Add validation rules for other attributes as needed
        // ]);

        // Replace with the actual user ID you want to update
        $contest = contacts::findOrFail($id);

        if ($contest) {
            $contest->update($data);
            return response()->json(['message' => 'Records updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Records updated failure'], 200);
        }
    }

    public function deleteContact($id)
    {
        $contest = contacts::findOrFail($id);
        $contest->delete();
        return response()->json(['message' => 'Contest deleted successfully']);
    }


}
