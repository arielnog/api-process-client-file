<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\JsonResponse;
use App\Traits\Response;

class HealthController extends Controller
{
    use Response;

    public function index(): JsonResponse
    {
        return $this->responseSuccess(
            message: "Alive and Kicking!",
            resource: [
                'timestamp' => (new DateTime())->format('Y-m-d H:i:s'),
            ]
        );
    }
}
