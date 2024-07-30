<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class VacancyController extends Controller
{

    public function index(): JsonResponse
    {

        $vacancies = Vacancy::active()->orderBy('id','asc')->get();
        return response()->json([
            'status' => true,
            'vacancies' => VacancyResource::collection($vacancies)
        ], Response::HTTP_OK);

    }

    public function show($slug): JsonResponse
    {

        $vacancy = Vacancy::whereHas('translations', function ($q)use ($slug){
            $q->where('slug', $slug);
        })->get();
        return response()->json([
            'status' => true,
            'vacancy' => VacancyResource::collection($vacancy)
        ], Response::HTTP_OK);

    }

}
