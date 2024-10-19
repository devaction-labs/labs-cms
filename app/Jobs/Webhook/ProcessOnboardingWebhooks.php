<?php

namespace App\Jobs\Webhook;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class ProcessOnboardingWebhooks extends ProcessWebhookJob
{
    public function handle(): void
    {
        $payload = $this->webhookCall->payload;

        // Verifica se é o evento correto
        if ($payload['event'] === 'company.registered') {
            $this->processUserRegistered($payload['user']);
        }
    }

    private function processUserRegistered(array $userData): void
    {
        $customer = Customer::where('email', $userData['email'])->first();

        if (!$customer) {
            Log::warning('Cliente não encontrado para atualizar o status.', [
                'email' => $userData['email'],
            ]);

            return;
        }

        $customer->update(['status' => 'created']);
        Log::info('Status do cliente atualizado para created.', [
            'customer_id' => $customer->id,
            'email'       => $customer->email,
        ]);
    }
}
