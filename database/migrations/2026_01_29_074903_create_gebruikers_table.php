<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gebruikers', function (Blueprint $table) {
            $table->id();
            $table->string('gebruikersnaam', 100)->unique();
            $table->string('wachtwoord');
            $table->string('naam');
            $table->enum('rol', ['student', 'beheerder']);
            $table->string('klas', 50)->nullable();
            $table->boolean('geblokkeerd')->default(false);
            $table->timestamp('aangemaakt_op')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gebruikers');
    }
};
