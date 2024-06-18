<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	public function up(): void
	{
		Schema::table('products', function(Blueprint $table) {
			$table->string('external_id')->nullable()->change();
            $table->index([
                'external_id',
                'provider',
                'franchise'
            ]);
		});
	}


	public function down(): void
	{

        Schema::table('products', function(Blueprint $table) {
            $table->dropIndex([
                'external_id',
                'provider',
                'franchise'
            ]);
		});

        Schema::table('products', function(Blueprint $table) {
            $table->text('external_id')->nullable()->change();
		});
	}
};
