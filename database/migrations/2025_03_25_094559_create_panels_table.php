<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Maximianac\SiteBuilder\Models\Content;
use Maximianac\SiteBuilder\Models\Panel;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('panels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Content::class)->constrained()->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index('order');
        });

        Schema::create('panel_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Panel::class)->constrained()->cascadeOnDelete();
            $table->string('key', 50)->comment('Field ID');
            $table->string('type', 15)->default('text');
            $table->json('settings')->nullable()->comment('Extra settings');
            $table->timestamps();

            $table->unique(['panel_id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panel_fields');
        Schema::dropIfExists('panels');
    }
};
