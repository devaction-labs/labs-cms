@props(['status'])

<div class="flex items-center space-x-2">
    @switch($status)
        @case('onboarding_completed')
            <div class="relative group">
                <x-icon name="m-check-badge" class="text-emerald-700 h-4 w-4 cursor-pointer"
                        aria-label="Onboarding Concluído" />
                <div
                    class="absolute bottom-full mb-1 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1">
                    Onboarding Concluído
                </div>
            </div>
            @break

        @case('onboarding_pending')
            <div class="relative group">
                <x-icon name="o-clock" class="text-orange-500 h-4 w-4 cursor-pointer"
                        aria-label="Onboarding Pendente" />
                <div
                    class="absolute bottom-full mb-1 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1">
                    Onboarding Pendente
                </div>
            </div>
            @break

        @default
            <div class="relative group">
                <x-icon name="o-shield-exclamation" class="text-amber-500 h-4 w-4 cursor-pointer"
                        aria-label="Status Desconhecido" />
                <div
                    class="absolute bottom-full mb-1 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1">
                    Sem Onboarding
                </div>
            </div>
    @endswitch
</div>
