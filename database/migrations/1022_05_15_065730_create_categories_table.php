<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique();
            $table->string('slug', 100);

            $table->boolean('is_active')->default(true);
            $table->timestamps(); 
            $table->softDeletes();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
