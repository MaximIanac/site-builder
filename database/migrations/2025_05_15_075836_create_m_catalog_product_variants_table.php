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
        Schema::create('m_catalog_product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('m_catalog_products')->cascadeOnDelete();
            $table->string('sku')->unique();
            $table->unsignedInteger('quantity')->default(0);
            $table->timestamps();

            $table->index('product_id');
        });

        Schema::create('m_catalog_product_variant_property', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->constrained('m_catalog_product_variants')->cascadeOnDelete();
            $table->foreignId('property_id')->constrained('m_catalog_properties')->cascadeOnDelete();
            $table->json('value');
            $table->string('origin', 20)->default('product')->comment('category, product, variant');

            $table->unique(['variant_id', 'property_id']);
            $table->index('property_id');
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique();
            $table->string('symbol', 10)->nullable();
            $table->decimal('rate', 12, 6);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::create('m_catalog_product_variant_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->constrained('m_catalog_product_variants')->cascadeOnDelete();
            $table->foreignId('currency_id')->constrained('currencies')->cascadeOnDelete();
            $table->decimal('value', 10, 2);

            $table->unique(['variant_id', 'currency_id']);
            $table->index('variant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_catalog_product_variant_prices');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('m_catalog_product_variant_property');
        Schema::dropIfExists('m_catalog_product_variants');
    }
};
