<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('image')->nullable();
            $table->string('sku')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->bigInteger('parent')->nullable();
            $table->integer('position')->default(0);
            $table->boolean('active')->default(1);
            $table->boolean('editable')->default(1);
            $table->boolean('removable')->default(1);
            $table->bigInteger('shop_id')->unsigned()->nullable();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('set null');
            $table->timestamps();

        });

        $this->load();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }

    public function load(){
        $cat = new \App\Models\ProductCategory();
        $cat->name = 'Uncategorized';
        $cat->slug = 'uncategorized';
        $cat->parent = 0;
        $cat->editable = false;
        $cat->removable = false;
        $cat->save();
    }
}
