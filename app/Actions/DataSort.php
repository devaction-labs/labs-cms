<?php

namespace App\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final readonly class DataSort
{
    public function __construct(
        protected string $table,
        protected array|Collection $data,
        protected ?string $field = null
    ) {}

    public function run(): void
    {
        $data = is_array($this->data) ? collect($this->data) : $this->data;

        $ids = $data
            ->when($this->field, fn ($c) => $c->pluck($this->field))
            ->join(',');

        DB::table($this->table)
            ->update(['sort_order' => DB::raw("field(id, $ids)")]);
    }
}
