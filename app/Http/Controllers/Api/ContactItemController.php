<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\ContactFooterResource;
use App\Http\Resources\ContactItemResource;
use App\Models\ContactItem;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ContactItemController extends Controller
{

    public function index(): JsonResponse
    {
        $contact_items = ContactItem::active()->orderBy('id','asc')->get();
        return response()->json([
            'status' => true,
            'contact_items' => ContactItemResource::collection($contact_items)
        ], Response::HTTP_OK);
    }

    public function footer_contact(): JsonResponse
    {
        $contact_items = ContactItem::active()->orderBy('id','asc')->get();
        return response()->json([
            'status' => true,
            'contact_items' => ContactFooterResource::collection($contact_items)
        ], Response::HTTP_OK);
    }

}
