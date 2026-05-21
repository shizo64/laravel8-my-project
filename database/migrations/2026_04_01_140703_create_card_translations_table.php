<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained();
            $table->foreignId('card_id')->constrained()->cascadeOnDelete();


            
            $table->text('translation')->nullable();
            $table->text('transcription')->nullable();
            $table->text('audio')->nullable();

            $table->unique(['card_id', 'language_id']); // Уникальный индекс для предотвращения дублирования переводов для одной карточки и языка
            

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_translations');
    }
}
