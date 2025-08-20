<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compra_requisicion_tipo_adquisiciones', function (Blueprint $table) {
            $table->comment('NOG

1. Cotización.
2. Licitación.
3. Modalidades específicas.
4. Compra Directa;
5. Adquisiciones con Proveedor Único (Manifestación de interés);
6. Arrendamientos (Bienes muebles o equipo);
7. Arrendamiento o adquisición de bienes inmuebles.
8. Casos de Excepción contemplados en la LEY.
9. Contrato Abierto.
10. Subasta Electrónica Inversa.
11. Adquisiciones de Bienes y Suministros Importados.
12. Adquisiciones efectuadas al amparo de Convenios y Tratados Internacionales o donaciones.
13. Adquisiciones que se realicen cuando superen el monto de la compra directa, según lo establecido en el Artículo 54 de la LEY y 25 del REGLAMENTO.
14. Negociaciones entre entidades del sector público contemplado en el Artículo 2 de la LEY.
15. Adquisición Directa por Ausencia de Ofertas.
16. Subasta Pública.
17. Otros tipos de concursos que se presenten por razón de reformas a la LEY,

NPG

18. Compra de Baja Cuantía.
19. Arrendamiento o adquisición de bienes inmuebles.
20. Negociaciones entre entidades del sector público contemplado en el Artículo 2 de la LEY.
21. Adquisiciones efectuadas al amparo de Convenios y Tratados Internacionales o donaciones.
22. Casos de excepción contemplados en la LEY.
23. Adquisiciones que se realicen cuando superen el monto de la compra directa, según lo establecido en el Artículo 54 de la LEY y 25 del REGLAMENTO.
24. Otros tipos de adquisición directa que se presenten por razón de reformas a la LEY, que se originen de otras leyes vigentes o en cumplimiento de una resolución judicial de un tribunal de justicia.');
            $table->id();
            $table->string('nombre');
            $table->enum('tipo_proceso', ['NOG', 'NPG']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_requisicion_tipo_adquisiciones');
    }
};
