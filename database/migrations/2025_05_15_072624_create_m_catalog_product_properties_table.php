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
        Schema::create('m_catalog_product_properties', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('code', 40);
            $table->string('type', 20)->comment("string, text, integer, float, boolean, select");
            $table->string('usage_type', 20)->comment("category, offer");
            $table->timestamps();
        });

        /** If property type is SELECT */
//        Schema::create('m_catalog_product_property_options', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('property_id')->constrained('m_catalog_product_properties')->cascadeOnDelete();
//            $table->string('value');
//        });

        /** Relation between CATEGORY and properties of the category */
        Schema::create('m_catalog_category_product_property', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('m_catalog_categories')->cascadeOnDelete();
            $table->foreignId('property_id')->constrained('m_catalog_product_properties')->cascadeOnDelete();
        });

        /** Relation between PRODUCT and properties of the category */
        Schema::create('m_catalog_product_property_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('m_catalog_products')->cascadeOnDelete();
            $table->foreignId('property_id')->constrained('m_catalog_product_properties')->cascadeOnDelete();
            $table->json('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_catalog_product_property_values');
        Schema::dropIfExists('m_catalog_category_product_property');
//        Schema::dropIfExists('m_catalog_product_property_options');
        Schema::dropIfExists('m_catalog_product_properties');
    }
};
