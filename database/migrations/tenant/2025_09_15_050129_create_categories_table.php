<?php

use App\Models\Category;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('company')->default(false);     // Que se muestre esta informacion en la pantalla de venta en el website, segun la categoria
            $table->boolean('model')->default(false);
            $table->boolean('quantity')->default(false);
            $table->boolean('color')->default(false);
            $table->boolean('bust')->default(false);
            $table->boolean('waist')->default(false);
            $table->boolean('hip')->default(false);
            $table->boolean('size')->default(false);
            $table->boolean('date')->default(false);
            $table->boolean('coupon')->default(false);
            $table->boolean('description')->default(false);
            $table->boolean('note1')->default(false);
            $table->boolean('note2')->default(false);
            $table->boolean('note3')->default(false);
            $table->boolean('video')->default(false);
            $table->enum('status', [Category::ACTIVE, Category::INACTIVE, Category::PENDING])->default(Category::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
