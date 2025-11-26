<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("SELECT setval('solicitudes_cambio_ruta_id_solicitud_seq', (SELECT COALESCE(MAX(id_solicitud), 0) FROM solicitudes_cambio_ruta))");
    }

    public function down()
    {
        // No es necesario revertir
    }
};