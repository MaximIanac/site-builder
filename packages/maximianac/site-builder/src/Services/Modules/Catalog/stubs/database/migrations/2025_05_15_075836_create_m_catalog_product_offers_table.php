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
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('quantity');

            $table->timestamps();
        });

        Schema::create('m_catalog_product_offer_property_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained('m_catalog_product_offers')->cascadeOnDelete();
            $table->foreignId('property_id')->constrained('m_catalog_product_properties')->cascadeOnDelete();
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_catalog_product_offer_property_values');
        Schema::dropIfExists('m_catalog_product_offers');
    }
};
