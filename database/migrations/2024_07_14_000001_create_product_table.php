<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function run(): void
    {
        Capsule::schema()->dropIfExists('product');

        Capsule::schema()->create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->enum('currency', ['CZK', 'EUR', 'USD'])->default('CZK');
            $table->boolean('is_public')->default(false);
            $table->boolean('is_available')->default(false);
            $table->datetimes();
        });
    }
};
