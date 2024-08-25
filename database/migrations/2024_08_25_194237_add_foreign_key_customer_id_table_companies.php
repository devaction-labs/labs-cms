<?php

use App\Models\{Company, Nature, Size};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->foreignIdFor(Company::class)->constrained();
            $table->foreignIdFor(Nature::class)->constrained();
            $table->foreignIdFor(Size::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
        });
    }
};
