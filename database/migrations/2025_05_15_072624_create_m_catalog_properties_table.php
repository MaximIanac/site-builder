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
        Schema::create('m_catalog_properties', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('code', 50)->unique();
            $table->string('type', 20)->comment("string, integer, float, boolean");
            $table->timestamps();
        });

        /** Relation between CATEGORY and properties of the category */
        Schema::create('m_catalog_category_property', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('m_catalog_categories')->cascadeOnDelete();
            $table->foreignId('property_id')->constrained('m_catalog_properties')->cascadeOnDelete();

            $table->unique(['category_id','property_id']);
        });

        /** Relation between PRODUCT and properties of the category and value container */
        Schema::create('m_catalog_product_property', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('m_catalog_products')->cascadeOnDelete();
            $table->foreignId('property_id')->constrained('m_catalog_properties')->cascadeOnDelete();
            $table->json('value');
            $table->string('origin', 20)->default('product')->comment('category, product, variant');

            $table->unique(['product_id', 'property_id']);
            $table->index('property_id');
            $table->index('origin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_catalog_product_property');
        Schema::dropIfExists('m_catalog_category_property');
        Schema::dropIfExists('m_catalog_properties');
    }
};
