<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Endpoint;
use Dedoc\Scramble\Attributes\Response;

class CSRFTokenRefreshController extends Controller
{
    #[Endpoint(
        title: 'Refresh CSRF-Token',
    )]
    #[Response(200, 'csrf token refreshed', examples: ['application/json' => ['success' => true, 'message' => 'csrf token refreshed', 'data' => ['token' => 'TOKEN']]])]
    public function refreshToken()
    {
        return apiResponse('csrf token refreshed', ['token' => csrf_token()]);
    }
}
