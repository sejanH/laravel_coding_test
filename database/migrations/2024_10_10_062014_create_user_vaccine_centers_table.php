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
        Schema::create('user_vaccine_centers', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users', 'id')->unique();
            $table->foreignId('center_id')->constrained('vaccine_centers', 'id');
            $table->timestamp('registered_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_vaccine_centers');
    }
};
