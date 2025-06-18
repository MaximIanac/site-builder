<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Maximianac\SiteBuilder\Models\Content;
use Maximianac\SiteBuilder\Models\Page;
use Maximianac\SiteBuilder\Models\Site;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Page::class)->constrained()->cascadeOnDelete();
            $table->string('key')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['page_id', 'key']);
        });

        Schema::create('content_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Content::class)->constrained()->cascadeOnDelete();
            $table->string('type', 15)->default('text');
            $table->string('key', 50)->nullable();
            $table->text('value')->nullable();
            $table->string('lang', 5)->default('en');
            $table->timestamps();

            $table->unique(['key', 'value', 'lang']);
        });

//        Schema::create('message_translations', function (Blueprint $table) {
//            $table->id();
//            $table->string('module');
//            $table->string('key')->nullable()->comment('deleted, created etc');
//            $table->text('text')->nullable();
//            $table->char('lang', 2)->default('ru');
//            $table->timestamps();
//
//            $table->unique(['module', 'key', 'lang']);
//        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_values');
        Schema::dropIfExists('contents');
//        Schema::dropIfExists('message_translations');
    }
};
