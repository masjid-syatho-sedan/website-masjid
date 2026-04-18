<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom sementara untuk ID baru
        Schema::table('ambulance_journals', function (Blueprint $table) {
            $table->char('tmp_id', 5)->nullable()->after('id');
        });

        // Buat ID 5 karakter baru untuk setiap record yang ada
        $usedIds = [];
        DB::table('ambulance_journals')->orderBy('created_at')->each(function ($record) use (&$usedIds) {
            do {
                $newId = \App\Models\AmbulanceJournal::generateShortId();
            } while (in_array($newId, $usedIds));

            $usedIds[] = $newId;
            DB::table('ambulance_journals')->where('id', $record->id)->update(['tmp_id' => $newId]);
        });

        // Hapus primary key lama dan kolom id
        Schema::table('ambulance_journals', function (Blueprint $table) {
            $table->dropPrimary(['id']);
            $table->dropColumn('id');
        });

        // Rename tmp_id ke id
        Schema::table('ambulance_journals', function (Blueprint $table) {
            $table->renameColumn('tmp_id', 'id');
        });

        // Set not nullable dan jadikan primary key
        Schema::table('ambulance_journals', function (Blueprint $table) {
            $table->char('id', 5)->nullable(false)->change();
            $table->primary('id');
        });
    }

    public function down(): void
    {
        // Tambah kolom sementara untuk UUID lama
        Schema::table('ambulance_journals', function (Blueprint $table) {
            $table->uuid('tmp_uuid')->nullable()->after('id');
        });

        // Generate UUID baru untuk setiap record
        DB::table('ambulance_journals')->each(function ($record) {
            DB::table('ambulance_journals')
                ->where('id', $record->id)
                ->update(['tmp_uuid' => \Illuminate\Support\Str::uuid()->toString()]);
        });

        // Hapus primary key dan kolom id
        Schema::table('ambulance_journals', function (Blueprint $table) {
            $table->dropPrimary(['id']);
            $table->dropColumn('id');
        });

        // Rename tmp_uuid ke id
        Schema::table('ambulance_journals', function (Blueprint $table) {
            $table->renameColumn('tmp_uuid', 'id');
        });

        // Set not nullable dan jadikan primary key
        Schema::table('ambulance_journals', function (Blueprint $table) {
            $table->uuid('id')->nullable(false)->change();
            $table->primary('id');
        });
    }
};
