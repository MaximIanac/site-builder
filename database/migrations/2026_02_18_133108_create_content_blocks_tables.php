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
            $table->string('type')->comment("hero, slider, text");
            $table->boolean('is_active')->default(false);
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('cblock_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_block_id')->constrained()->onDelete('cascade');
            $table->string('image')->nullable();
            $table->json('value');
            $table->unsignedTinyInteger('order')->default(0);
            $table->timestamps();

            $table->index(['content_block_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_blocks_tables');
    }
};
