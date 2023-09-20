<?php

namespace App\Services;

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
}
