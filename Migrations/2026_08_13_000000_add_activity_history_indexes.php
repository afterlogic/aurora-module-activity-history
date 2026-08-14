<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class AddActivityHistoryIndexes extends Migration
{
    public function up()
    {
        $prefix = Capsule::connection()->getTablePrefix();

        $sm = Capsule::connection()->getDoctrineSchemaManager();
        $doctrineTable = $sm->listTableDetails($prefix . 'core_activity_history');

        if (!$doctrineTable->hasIndex('core_activity_history_user_resource_index')) {
            Capsule::schema()->table('core_activity_history', function (Blueprint $table) {
                $table->index(['UserId', 'ResourceType', 'ResourceId'], 'core_activity_history_user_resource_index');
            });
        }

        if (!$doctrineTable->hasIndex('core_activity_history_timestamp_index')) {
            Capsule::schema()->table('core_activity_history', function (Blueprint $table) {
                $table->index('Timestamp', 'core_activity_history_timestamp_index');
            });
        }

        if (!$doctrineTable->hasIndex('core_activity_history_action_index')) {
            Capsule::schema()->table('core_activity_history', function (Blueprint $table) {
                $table->index('Action', 'core_activity_history_action_index');
            });
        }
    }

    public function down()
    {
        $prefix = Capsule::connection()->getTablePrefix();

        $sm = Capsule::connection()->getDoctrineSchemaManager();
        $doctrineTable = $sm->listTableDetails($prefix . 'core_activity_history');

        if ($doctrineTable->hasIndex('core_activity_history_user_resource_index')) {
            Capsule::schema()->table('core_activity_history', function (Blueprint $table) {
                $table->dropIndex('core_activity_history_user_resource_index');
            });
        }

        if ($doctrineTable->hasIndex('core_activity_history_timestamp_index')) {
            Capsule::schema()->table('core_activity_history', function (Blueprint $table) {
                $table->dropIndex('core_activity_history_timestamp_index');
            });
        }

        if ($doctrineTable->hasIndex('core_activity_history_action_index')) {
            Capsule::schema()->table('core_activity_history', function (Blueprint $table) {
                $table->dropIndex('core_activity_history_action_index');
            });
        }
    }
}
