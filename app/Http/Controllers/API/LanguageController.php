<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Endpoint;
use Dedoc\Scramble\Attributes\PathParameter;
use Dedoc\Scramble\Attributes\Response;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    #[Endpoint(
        title: 'Get Language Key',
    )]
    #[PathParameter('key', 'Language Key')]
    #[Response(200, 'Language Value', examples: ['application/json' => ['success' => true, 'message' => 'Language Value', 'data' => ['key' => 'language.key', 'value' => 'Language Value', 'lang' => 'en']]])]
    public function getKey(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);

        $key = $request->query('key');

        return apiResponse(__($key), ['key' => $request->key, 'value' => __($request->key), 'lang' => app()->getLocale()]);
    }
}
