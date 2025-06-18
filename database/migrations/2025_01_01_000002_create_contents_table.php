<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Maximianac\SiteBuilder\Models\Content;
use Maximianac\SiteBuilder\Models\ContentEntry;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Models\Site;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Page::class)->constrained()->cascadeOnDelete();
            $table->string('key')->index();
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['page_id', 'key']);
        });

        Schema::create('content_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Content::class)->constrained()->cascadeOnDelete();
            $table->string('key', 50)->nullable();
            $table->string('type', 15)->default('text');
            $table->timestamps();

            $table->unique(['content_id', 'key']);
        });

        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->morphs('translatable'); /* creates translatable_id and translatable_type */
            $table->string('lang', 5)->default('en');
            $table->text('value')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->unique(['translatable_id', 'translatable_type', 'lang']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('translations');
        Schema::dropIfExists('content_entries');
        Schema::dropIfExists('contents');
    }
};
