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
use Illuminate\Http\UploadedFile;
use \DateTime;




class contactService
{

    public function getContacts($user_id)
    {

        $contacts = contacts::where('user_id', $user_id)->get();
        return $contacts->toArray();
    }

    public function createContact($data)
    {

        // dd($data['image']);
        // Handle profile image upload

        // $imagePath = $data->file('image')->store('profile_images');
        // $data->profile_image = $imagePath;
        // dd($imagePath);

        if ($data) {
            if ($data['image']) {
                $docUploads = request()->file('image');
                $docUploadsName = 'doc_' . time() . '.' . $docUploads->getClientOriginalExtension();
                $docUploadsPath = public_path('/images/');
                $docUploads->move($docUploadsPath, $docUploadsName);
                $data['image'] = '/images/' . $docUploadsName;
            }
            contacts::create($data);
            return response()->json(['message' => 'Records updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Records updated failure'], 200);
        }


        // foreach ($data as $item) {
        //     if ($item) {
        //         if ($data['image']) {
        //             $docUploads = request()->file('image');
        //             $docUploadsName = 'doc_'.time() . '.' . $docUploads->getClientOriginalExtension();
        //             $docUploadsPath = public_path('/images/');
        //             $docUploads->move($docUploadsPath, $docUploadsName);
        //             $item[] = '/images/'.$docUploadsName;
        //         }
        //         dd($item);
        //         // contacts::create($item);
        //         return response()->json(['message' => 'Records updated successfully'], 200);
        //     } else {
        //         return response()->json(['message' => 'Records updated failure'], 200);
        //     }
        // }
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
