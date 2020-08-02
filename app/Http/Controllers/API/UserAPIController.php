<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;


class UserAPIController
{

    /**
     * Get Users and return for datatables
     * @return View
     */
    public function getUsersDataTables(Request $request)
    {
        $search = $request->search;
        $length = $request->length;

        $result = [];

        $users = User::with('notes')->when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', "%{$request->search}%")->orWhere('email', 'LIKE', "%{$request->search}%");
        })->paginate($length)->toArray();
        $data = [];
        $counter = 0;
        foreach($users['data'] as $user) {
            $data[$counter] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'is_admin' => $user['is_admin'] ? "Yes" : "No",
            ];
            $counter++;
        }

        $result['data'] = $data;
        $result['payload'] = [ 'draw' => "0"];

        return $result;
    }

}