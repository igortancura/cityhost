<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WhoisService;
use Illuminate\Http\JsonResponse;

class WhoisController extends Controller
{
    /**
     * @param WhoisService $service
     * @return JsonResponse
     */
    public function index(WhoisService $service): JsonResponse
    {
        $data = $service->getData();
        return response()->json($data, $data['code']);
    }
}
