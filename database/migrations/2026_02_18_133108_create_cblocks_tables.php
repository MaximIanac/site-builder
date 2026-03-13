<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Maximianac\SiteBuilder\Models\Page;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cblocks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Page::class)->constrained()->onDelete('cascade');
            $table->string('key', 100);
            $table->boolean('is_active')->default(false);
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('cblock_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cblock_id')->constrained()->onDelete('cascade');
            $table->string('key', 100);
            $table->string('type')->comment("hero, slider, image, text");
            $table->json('value')->nullable();
            $table->unsignedTinyInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::create('cblock_slides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cblock_entry_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('order')->default(0);
            $table->timestamps();

            $table->index(['cblock_entry_id', 'order']);
        });

        Schema::create('cblock_slide_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cblock_slide_id')->constrained()->onDelete('cascade');
            $table->string('key', 100);
            $table->string('type')->comment("hero, image, text");
            $table->json('value');
            $table->unsignedTinyInteger('order')->default(0);
            $table->timestamps();

            $table->index(['cblock_slide_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cblock_slide_entries');
        Schema::dropIfExists('cblock_slides');
        Schema::dropIfExists('cblock_entries');
        Schema::dropIfExists('cblocks');
    }
};
