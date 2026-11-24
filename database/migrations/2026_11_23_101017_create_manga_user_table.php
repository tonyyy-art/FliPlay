
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manga_user', function (Blueprint $table) {
            $table->id();

            $table->foreignId('manga_id')
                ->constrained('mangas')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['manga_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manga_user');
    }
};
