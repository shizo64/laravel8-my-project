<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
        $table->id();
        
        $table->string('title');             // основной заголовок
        $table->string('subtitle')->nullable(); // подзаголовок
        $table->text('description')->nullable(); // описание
        $table->string('image')->nullable();     // путь или ссылка на картинку
        $table->string('link')->nullable();      // ссылка куда-то, например на страницу
        
        $table->foreignId('category_id')        // связь с категорией (опционально)
            ->nullable()
            ->constrained()
            ->nullOnDelete();                // если категория удалена, поле станет NULL
        
        $table->timestamps();
        $table->softDeletes();                  // возможность “мягкого удаления”
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
