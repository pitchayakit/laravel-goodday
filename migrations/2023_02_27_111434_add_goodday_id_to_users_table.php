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
        Schema::table('users', function (Blueprint $table) {
            $table->string('goodday_id')->nullable()->after('email');
            $table->string('company_role')->after('goodday_id');
            $table->boolean('is_admin')->after('company_role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('goodday_id');
            $table->dropColumn('company_role');
            $table->dropColumn('is_admin');
        });
    }
};
