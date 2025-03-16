<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            
            $table->dropUnique(['slug']);
            
            $table->dropColumn(['slug', 'content']);
            
            $table->longText('description')->nullable()->after('title');
        });
    }
    
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Rollback in ordine inverso
            $table->longText('content')->after('description');
            $table->string('slug')->after('title');
            $table->dropColumn('description');
            
            // Ricrea l'indice UNIQUE
            $table->unique('slug');
        });
    }
};
