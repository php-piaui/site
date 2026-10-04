<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cfp_id')->constrained()->cascadeOnDelete();
            // Sem conta (LGPD), palestras decididas ficam na programação só com o nome (speaker_name).
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('speaker_name');
            $table->string('title', 90);
            $table->string('format');
            $table->string('level');
            $table->text('summary');
            $table->text('notes')->nullable();
            $table->boolean('first_talk')->default(false);
            $table->string('status')->default('review');
            $table->text('decision_message')->nullable();
            $table->timestamp('decided_at')->nullable();
            $table->timestamps();

            $table->index(['cfp_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
