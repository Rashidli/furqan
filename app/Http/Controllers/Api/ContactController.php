<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    public function contact_post(Request $request)
    {
        $request->validate([
            'name' => 'nullable',
            'surname' => 'nullable',
            'email' => 'nullable',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $request->name . ' ' . $request->surname,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return response()->json([
            'status' => true
        ], Response::HTTP_OK);

    }
}
