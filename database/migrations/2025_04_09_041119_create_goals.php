<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId("account_id")->constrained("accounts")->onDelete("cascade");
            $table->string("title");
            $table->decimal("total_amount", 13, 4);
            $table->decimal("step_amount", 13, 4);
            $table->date("start_date");
            $table->smallInteger("step_count")->default(1);
            $table->smallInteger("current_step")->default(0);
            $table->decimal("current_amount", 13, 4)->default(0);
            $table->enum("status", ["active", "completed", "cancelled"])->default("active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
