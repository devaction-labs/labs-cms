<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class WebhookOnboardingController extends Controller
{
    /**
     * Responde ao webhook.
     */
    public function __invoke(): JsonResponse
    {
        return response()->json(['message' => 'Webhook recebido com sucesso.']);
    }
}
