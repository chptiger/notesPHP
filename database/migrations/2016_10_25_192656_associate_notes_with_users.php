<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssociateNotesWithUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            // Create the user_id column as an unsigned integer
            $table->integer('user_id')->unsigned();

            // Create a basic index for the author_id column
            $table->index('user_id');

            // Create a foreign key constraint and cascade on delete.
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign('notes_userr_id_foreign');
            // Now drop the basic index
            $table->dropIndex('notes_user_id_index');
            // Lastly, now it's safe to drop the column
            $table->dropColumn('user_id');
        });
    }
}
