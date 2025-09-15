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
        Schema::create('businesses', function (Blueprint $table) {
$table->id();
            $table->string('name')->default('My business name');
            $table->string('name2')->nullable();
            $table->string('name3')->nullable();

            $table->string('slogan')->default('Once coffee, always coffee.');
            $table->string('slogan2')->default('Sports are better than chocolate.');
            $table->string('slogan3')->default('Boutique evolution.');

            $table->string('phone')->default('000-000-0000');
            $table->string('phone2')->default('000-000-0000');
            $table->string('phone3')->default('000-000-0000');

            $table->string('logo')->nullable();
            $table->string('logo2')->nullable();
            $table->string('logo3')->nullable();
            $table->string('logo4')->nullable();

            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('email')->nullable();

            $table->text('description')->nullable();
            $table->text('description2')->nullable();
            $table->text('description3')->nullable();
            $table->text('description4')->nullable();

            $table->text('note')->nullable();
            $table->text('note2')->nullable();
            $table->text('note3')->nullable();
            $table->text('note4')->nullable();

            $table->text('article')->nullable();
            $table->text('article2')->nullable();
            $table->text('article3')->nullable();
            $table->text('article4')->nullable();

            $table->text('image')->nullable();
            $table->text('image2')->nullable();
            $table->text('image3')->nullable();
            $table->text('image4')->nullable();

            $table->string('link')->nullable();
            $table->string('link2')->nullable();
            $table->string('link3')->nullable();
            $table->string('link4')->nullable();
            $table->string('link5')->nullable();
            $table->string('link6')->nullable();

            $table->string('color')->nullable();
            $table->string('color2')->nullable();
            $table->string('color3')->nullable();
            $table->string('color4')->nullable();
            $table->string('color5')->nullable();
            $table->string('color6')->nullable();
            $table->string('color7')->nullable();

            $table->string('status')->default('active');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
