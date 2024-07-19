<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function run(): void
    {
        Capsule::schema()->dropIfExists('order_item');
        Capsule::schema()->dropIfExists('order');

        Capsule::schema()->create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->enum('state', ['new', 'processing', 'delivered'])->default('new');
            $table->decimal('total', 10, 2)->default(0.00);
            $table->enum('currency', ['CZK', 'EUR', 'USD'])->default('CZK');
            $table->datetimes();
        });

        Capsule::schema()->create('order_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->constrained(
                table: 'order', indexName: 'order_id'
            );
            $table->string('name');
            $table->decimal('price', 10, 2)->default(0.00);
            $table->enum('currency', ['CZK', 'EUR', 'USD'])->default('CZK');
            $table->datetimes();
        });
    }
};
