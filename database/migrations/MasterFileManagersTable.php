<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterFileManagersTable extends Migration
{
    public function up()
    {
        Schema::create('master_file_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name')->nullable();
            $table->string('type')->nullable();
            $table->string('size')->default('0');
            $table->string('storage')->default('public');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_file_managers');
    }
}