<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('category')->default('Lainnya');
            $t->text('description')->nullable();
            $t->unsignedBigInteger('price');
            $t->unsignedBigInteger('compare_price')->nullable();
            $t->unsignedBigInteger('cost')->default(0);
            $t->string('image')->nullable();
            $t->boolean('active')->default(true);
            $t->boolean('featured')->default(false);
            $t->timestamps();
        });
        Schema::create('orders', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();
            $t->uuid('token')->unique();
            $t->string('customer_name');
            $t->string('customer_phone');
            $t->unsignedBigInteger('total');
            $t->unsignedBigInteger('cost_total')->default(0);
            $t->string('status')->default('new');
            $t->string('payment_status')->default('unpaid');
            $t->text('notes')->nullable();
            $t->timestamps();
        });
        Schema::create('order_items', function (Blueprint $t) {
            $t->id();
            $t->foreignId('order_id')->constrained()->cascadeOnDelete();
            $t->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $t->string('product_name');
            $t->unsignedInteger('quantity');
            $t->unsignedBigInteger('unit_price');
            $t->unsignedBigInteger('unit_cost')->default(0);
            $t->unsignedBigInteger('subtotal');
            $t->timestamps();
        });
        Schema::create('expenses', function (Blueprint $t) {
            $t->id();
            $t->string('description');
            $t->unsignedBigInteger('amount');
            $t->date('spent_at');
            $t->timestamps();
        });
        Schema::create('settings', function (Blueprint $t) {
            $t->string('key')->primary();
            $t->text('value')->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
    }
};
