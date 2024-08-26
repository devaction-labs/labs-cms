<?php

use App\Models\{Company, MemberRole, Person};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->foreignIdFor(Company::class)->constrained();
            $table->foreignIdFor(Person::class)->constrained();
            $table->foreignIdFor(MemberRole::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
            $table->dropForeign(['member_id']);
            $table->dropColumn('member_id');
            $table->dropForeign(['person_id']);
            $table->dropColumn('person_id');
        });
    }
};
