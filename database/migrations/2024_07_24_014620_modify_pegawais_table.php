<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPegawaisTable extends Migration
{
    public function up()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->string('no_telpon')->nullable()->change();
            $table->string('NIP')->nullable()->change();
            $table->string('PTK')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->string('no_telpon')->nullable(false)->change();
            $table->string('NIP')->nullable(false)->change();
            $table->string('PTK')->nullable(false)->change();
        });
    }
}