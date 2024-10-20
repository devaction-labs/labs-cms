<?php

namespace App\Jobs\Webhook;

use App\Enums\Onboarding\StatusEnum;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class ProcessOnboardingWebhooks extends ProcessWebhookJob
{
    public function handle(): void
    {
        $payload = $this->webhookCall->payload;

        if (!isset($payload['event'])) {
            Log::warning('Evento não encontrado no payload.', [
                'payload' => $payload,
            ]);

            return;
        }

        if ($payload['event'] === 'company.registered') {
            $this->processUserRegistered($payload['user']);
        }
    }

    private function processUserRegistered(array $userData): void
    {
        $customer = Customer::query()->where('email', $userData['email'])->first();

        if (!$customer) {
            Log::warning('Cliente não encontrado para atualizar o status.', [
                'email' => $userData['email'],
            ]);

            return;
        }

        $customer->update([
            'status'             => StatusEnum::ONBOARDING_COMPLETED->value,
            'tenant_id_external' => $userData['tenant_id'],
            'user_id_external'   => $userData['id'],
        ]);

        Log::info('Status do cliente atualizado para created.', [
            'customer_id' => $customer->id,
            'email'       => $customer->email,
        ]);
    }
}
