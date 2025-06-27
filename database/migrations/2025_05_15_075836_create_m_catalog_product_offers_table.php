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
        Schema::create('m_catalog_product_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('m_catalog_products')->cascadeOnDelete();
            $table->string('sku')->unique();
            $table->unsignedInteger('quantity');
            $table->timestamps();
        });

        Schema::create('m_catalog_product_offer_property_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained('m_catalog_product_offers')->cascadeOnDelete();
            $table->foreignId('property_id')->constrained('m_catalog_product_properties')->cascadeOnDelete();
            $table->string('value');
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique();
            $table->string('symbol', 10)->nullable();
            $table->decimal('rate', 12, 6);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::create('m_catalog_product_offer_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained('m_catalog_product_offers')->cascadeOnDelete();
            $table->foreignId('currency_id')->constrained('currencies')->cascadeOnDelete();
            $table->decimal('price', 10, 2);
            $table->unique(['offer_id', 'currency_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_catalog_product_offer_prices');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('m_catalog_product_offer_property_values');
        Schema::dropIfExists('m_catalog_product_offers');
    }
};
