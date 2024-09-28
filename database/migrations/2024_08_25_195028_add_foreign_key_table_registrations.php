<?php

use App\Models\{Customer, RegistrationType, Status};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->foreignIdFor(Customer::class)->constrained();
            $table->foreignIdFor(Status::class)->constrained();
            $table->foreignIdFor(RegistrationType::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
            $table->dropForeign(['registration_type_id']);
            $table->dropColumn('registration_type_id');
        });
    }
};
