<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLE USER
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('type_user_id')->references('id')->on('type_users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        //TABLE TICKETS
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('evenement_id')->references('id')->on('evenements')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        //TABLE MODIF TICKETS
        Schema::table('modif_tickets', function (Blueprint $table) {
            $table->foreign('ticket_id')->references('id')->on('tickets')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        //TABLE EVENEMENT
        Schema::table('evenements', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('type_event_id')->references('id')->on('type_events')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        //TABLE CODE PROMO
        Schema::table('code_promos', function (Blueprint $table) {
            $table->foreign('evenement_id')->references('id')->on('evenements')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        //TABLE AGENT
        /* Schema::table('agents', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        }); */

        //TABLE ACHAT
        Schema::table('achats', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
                $table->foreign('ticket_id')->references('id')->on('tickets')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('operateur_id')->references('id')->on('operateurs')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
