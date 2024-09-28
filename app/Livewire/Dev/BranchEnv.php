<?php

namespace App\Livewire\Dev;

use App\Utilities\Traits\StringHelpers;
use Illuminate\Support\Facades\Process;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property-read string $branch
 * @property-read string $env
 */
class BranchEnv extends Component
{
    use StringHelpers;
    public function render(): string
    {
        return <<<'blade'
        <div class="flex items-center space-x-2">
            <x-badge :value="$this->branch" class="badge-primary"/>
            <x-badge :value="$this->env" class="badge-primary"/>
            <span class="font-semibold text-warning">DEVELOPING 🚀</span>
        </div>

        blade;
    }

    #[Computed]
    public function env(): string
    {
        return $this->convertToString(config('app.env'));
    }

    #[Computed]
    public function branch(): string
    {
        $process = Process::run('git branch --show-current');

        return trim($process->output());
    }
}
