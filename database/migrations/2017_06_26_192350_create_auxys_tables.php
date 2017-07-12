 <?php

 use Illuminate\Support\Facades\Schema;
 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Database\Migrations\Migration;

 class CreateAuxysTables extends Migration
 {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocatorias', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->date('gestion')->required();
          $table->enum('semestre', ['Primer', 'Segundo'])->required();
          $table->enum('modalidad', ['Primera', 'Segunda'])->required();
          $table->date('desde')->nullable();
          $table->date('hasta')->nullable();
          $table->date('fecha_de_publicacion')->nullable();
          $table->string('description', 255)->nullable();
          $table->string('decano', 255)->nullable();
          $table->string('vice_decano', 255)->nullable();
          $table->string('director', 255)->nullable();
          $table->timestamps();
          $table->softDeletes();
      });

        Schema::create('semestres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->timestamps();
        });
        Schema::create('materias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sigla');
            $table->string('descripcion');
            $table->bigInteger('semestre_id')->unsigned();
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('convocatoria_materia', function(Blueprint $table) {
            $table->bigInteger('convocatoria_id')->unsigned();
            $table->bigInteger('materia_id')->unsigned();
            $table->integer('plazas')->unsigned()->nullable();
            $table->integer('carga_horaria')->unsigned()->nullable();
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias');
            $table->foreign('materia_id')->references('id')->on('materias');
        });

        Schema::create('requisitos_c', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('convocatoria_requisito', function(Blueprint $table) {
            $table->bigInteger('convocatoria_id')->unsigned();
            $table->bigInteger('requisitoc_id')->unsigned();
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias');
            $table->foreign('requisitoc_id')->references('id')->on('requisitos_c');
        });

      //recursivo materia
        Schema::create('requisitos_m', function(Blueprint $table) {

            $table->bigInteger('materia_id')->unsigned();
            $table->bigInteger('materia_req_id')->unsigned();
            $table->foreign('materia_id')->references('id')->on('materias');
            $table->foreign('materia_req_id')->references('id')->on('materias');
            $table->primary(['materia_id', 'materia_req_id']);

        });

      //se cargara los datos de la api
        Schema::create('estudiantes', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('carnet_identidad');
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->timestamps();
            //$table->json('materias');
        });

        Schema::create('documentos_entregados', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('estudiante_id')->unsigned();
            $table->bigInteger('requisitoc_id')->unsigned();
            $table->date('fecha_recepcion');
            $table->foreign('requisitoc_id')->references('id')->on('requisitos_c');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->unique(['estudiante_id', 'requisitoc_id']);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('estudiante_postula_materia', function(BLueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('estudiante_id')->unsigned();
            $table->bigInteger('materia_id')->unsigned();
            $table->float('nota_examen_escrito')->unsigned();
            $table->float('nota_meritos')->unsigned();
            $table->float('nota_examen_oral')->unsigned();
            $table->float('total')->unsigned();
            $table->boolean('designado')->defualt(0);
            $table->string('categoria');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreign('materia_id')->references('id')->on('materias');
            $table->unique(['estudiante_id','materia_id']);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('estudiante_materia', function(BLueprint $table){
            $table->bigInteger('estudiante_id')->unsigned();
            $table->bigInteger('materia_id')->unsigned();
            $table->decimal('nota',5,2);
            $table->string('periodo');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreign('materia_id')->references('id')->on('materias');
            $table->unique(['estudiante_id','materia_id']); 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiante_materia');
        Schema::dropIfExists('estudiante_postula_materia');
        Schema::dropIfExists('documentos_entregados');
        Schema::dropIfExists('estudiantes');
        Schema::dropIfExists('requisitos_m');
        Schema::dropIfExists('convocatoria_requisito');
        Schema::dropIfExists('requisitos_c');
        Schema::dropIfExists('convocatoria_materia');
        Schema::dropIfExists('materias');
        Schema::dropIfExists('semestres');
        Schema::dropIfExists('convocatorias');
    }
}
