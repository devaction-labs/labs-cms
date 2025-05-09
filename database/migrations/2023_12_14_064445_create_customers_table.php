<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('customer');
            $table->string('name', 200);
            $table->string('email', 200);
            $table->string('password', 200)->nullable();
            $table->string('tenant_name', 200)->unique()->nullable()->index();
            $table->string('tenant_domain', 200)->unique()->nullable()->index();
            $table->string('tenant_slug', 200)->unique()->nullable()->index();
            $table->string('tenant_tax_id', 200)->unique()->nullable()->index();
            $table->string('phone', 20)->unique()->nullable();
            $table->string('linkedin', 200)->nullable();
            $table->string('facebook', 200)->nullable();
            $table->string('twitter', 200)->nullable();
            $table->string('instagram', 200)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('city', 200)->nullable();
            $table->string('state', 200)->nullable();
            $table->string('country', 200)->nullable();
            $table->string('zip', 200)->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('company', 200)->nullable();
            $table->string('position', 200)->nullable();
            $table->string('status', 60)->default('pending')->index();
            $table->string('tenant_id_external', 200)->nullable()->index();
            $table->string('user_id_external', 200)->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
