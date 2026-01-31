<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inschrijvingen', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('gebruikers')
                ->cascadeOnDelete();

            $table->foreignId('keuzedeel_id')
                ->constrained('keuzedelen')
                ->cascadeOnDelete();

            $table->enum('status', ['ingeschreven', 'afgerond'])
                ->default('ingeschreven');

            $table->timestamp('inschrijf_datum')->useCurrent();

            $table->unique(['student_id', 'keuzedeel_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inschrijvingen');
    }
};
