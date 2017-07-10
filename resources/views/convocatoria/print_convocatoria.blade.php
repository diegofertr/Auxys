<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Convocatoria</title>
	<style type="text/css">
		body{
			font-family: "FreeMono"
		}
		.center{
			text-align: center;
		}
		.bold{
			font-weight: bold;
		}
		.italic{
			font-style: italic;
		}
		.justify{
			text-align: justify;
		}
		.materias{
			width: 100%
		}
		.teachers{
			width: 90%;
			margin:0 auto
		}
		th{
			text-align: center;
		}
		.materias,.materias td, .materias th{
			border: 1px solid #000;
			border-collapse: collapse;
		}
		td{
			padding: 1px 5px;
		}
		.alpha-list{
			list-style-type: lower-alpha;
		}
	</style>
</head>
<body>
<h3 class="center bold">
CONVOCATORIA INTERNA Nº {{ $number_announcement }}/{{ $year }}	<br>
CONCURSO DE MERITOS Y EXAMEN DE COMPETENCIA <br>
PARA AUXILIARES DE DOCENCIA <br>
GESTIÓN ACADÉMICA {{ $period }}/{{ $year }} <br>
</h3>
<p class="justify">	
La Carrera de Informática de la Facultad de Ciencias Puras y Naturales de la Universidad Mayor de San Andrés, en aplicación de la Resolución Rectoral Nº 354/08, convocan al Concurso de Méritos y Examen de Competencia a estudiantes regulares y egresados desde la Gestión 2/2015, para postularse al cargo de Auxiliar de Docencia de Dirección y Coordinación, Gestión {{ $year }} - {{ $semester }} Periodo, en las siguientes materias:
</p>
 
 <table class="materias">
 	<thead>
 	<tr>	
		<th>MATERIA</th> 		
		<th>MATERIA SIGLA</th> 		
		<th>PRE-REQUISITOS</th> 		
		<th>ACEFALIAS</th> 		
		<th>CARGA HORARIA</th> 		
 	</tr>
 	</thead>
 	<tbody>
 		@foreach($materias as $materia)
 		<tr>
 			<td>{{ mb_strtoupper($materia->descripcion, 'UTF-8') }}</td>
 			<td>{{ $materia->sigla }}</td>
 			<td class="center">{{ $materia->sigla }} {{ $materia->sigla }} {{ $materia->sigla }} {{ $materia->sigla }} {{ $materia->sigla }}</td>
 			<td class="center">5</td>
 			<td class="center">20</td>
 		</tr>
 		@endforeach
 	</tbody>
 </table>
<p class="justify">
De acuerdo a la CIRCULAR  D.B.S./DBA/CIR No, 002/2016, los postulantes deberán  presentar su solicitud acompañando los siguientes documentos: 
</p>
<p>
<ol>
	<li>
		Nota dirigida al Decano de la Facultad, indicando la asignatura a la   que postula.
	</li>
	<li>
		Curriculum Vitae, avalado documentalmente. 
	</li>
	<li>
		Fotocopia de matrícula universitaria Gestión 2017 y Cédula de Identidad (3 ejemplares de cada uno).
	</li>
	<li>
		Record Académico firmado y sellado por Kardex o Certificado que acredite haber vencido las materias del periodo  al  que corresponde la asignatura de acuerdo al Art. 8.
	</li>
	<li>
		Certificado que acredite la fecha de culminación del Plan de Estudios,  expedido por la Jefatura de la Carrera, (si el postulante hubiese concluido  con  el Plan  de Estudios).
	</li>
	<li>
		Certificación del Área Desconcentrada de no tener deuda pendiente con la Universidad, actualizado.
	</li>
	<li>
		Formulario de Registro al SIGEP (SISTEMA DE GESTION PUBLICA).
	</li>
	<li>
		Formulario de datos Personales del Auxiliar.
	</li>
	<li>
		Declaración Jurada de no haber sido auxiliar de docencia hasta dos gestiones académicas en la misma asignatura.
	</li>
	<li>
		Declaración Jurada de no tener pendientes con la Universidad, ni proceso Universitario ejecutoriado		
	</li>
</ol>
</p>
<p class="bold italic">	
DE LOS REQUISITOS DE ADMISION:
</p>
<p class="justify">
	<ol class="alpha-list">
		<li>Ser estudiante de la Universidad en concordancia al Estatuto Orgánico de la Universidad Boliviana (Art. 119 y 120), asimismo haber aprobado por lo menos una materia en el periodo académico anterior a su postulación, Res. HCU. No. 224/2015.
		</li>
		<li>En el caso de haber concluido el plan de estudios, el interesado puede postular a la auxiliatura, dentro del periodo de dos años, después de la conclusión de sus estudios. Este periodo de dos años no podrá ampliarse bajo circunstancia alguna aun en caso de encontrarse cursando otra carrera. 
		</li>
		<li>Tener aprobadas la totalidad de materias hasta el periodo semestral al que postula. 
		</li>
		<li>Participar y aprobar el Concurso de méritos y proceso de pruebas de selección, admisión conforme a convocatoria. 
		</li>
		<li>El estudiante universitario podrá ser universitario de docencia hasta dos gestiones académicas en la misma asignatura. (Resol HCU No.  170/2003).
		</li>
		<li>No ser profesional, cualquiera sea el nivel académico otorgado ( Resolución  H.C.U. 170/2003)	
		</li>
		<li>Los estudiantes miembros de las instancias de co-gobierno a nivel de Carrera o Facultad, para postularse a la Auxiliatura de Docencia. Deben solicitar LICENCIA en las Convocatorias y cuando se trate el caso particular a los consejos que corresponda. Asimismo los  estudiantes de Centros Facultativos y de Carrera no pueden participar en comisiones de evaluación, estos  tienen que ser los mejores alumnos (Resolución. No.  H.C.U. 157/2008).
		</li>
		<li>Registro al SIGEP (SISTEMA DE GESTION PUBLICA).
		</li>
		<li>No tener cargos pendientes con la Universidad, ni proceso Universitario ejecutoriado.
		</li>
	</ol>
</p>
<p class="justify">
La documentación debe sujeta con su respectivo fastener, debidamente foliada, en sobre cerrado y rotulado con los siguientes datos:
<ul>
<li>Apellidos y Nombres completos</li>
<li>Cedula de identidad</li>
<li>Sigla y nombre de la materia a la que postula </li>
</ul>
</p>
<p class="justify">
La documentación se recepcionará en la oficina  de la Unidad de Kardex Académico de la Carrera (Piso 2), hasta el día {{ $deadline_date}}, hasta horas {{ $deadline_time }}., impostergablemente.
</p>
<h4 class="italic bold">NOTA</h4>
<p>
<ul>
 	<li>Los postulantes deben estar atentos a cualquier comunicado durante el periodo en el cual se llevara a cabo los procedimientos de selección, los mismos que serán publicados en la página de la carrera http://informatica.edu.bo/
 	</li>
 	<li>Pasado el proceso de selección y designación los postulantes inhabilitados o reprobados deben recoger sus documentos en un plazo no mayor a 5 días hábiles, caso contrario los mismos no serán de responsabilidad de la Dirección de Carrera  
 	</li>
</ul>
</p>
<p class="italic">
La Paz, {{ $current_date }}
</p>
<table class="teachers">
	<tr>
		<td class="center" width="50%" style="padding-top: 100px">
		<span class="italic">M. SC. EDGAR CLAVIJO CARDENAS</span><br>
		<span class="bold">DIRECTOR</span><br>
		<span class="bold">CARRERA DE INFORMÁTICA</span>
		</td>
		<td class="center" width="50%" style="padding-top: 100px">
		<span class="italic">M. SC. ROSA FLORES MORALES</span><br>
		<span class="bold">VICEDECANA</span><br>
		<span class="bold">FAC. CS. PURAS Y NATURALES</span>
		</td>
	</tr>
	<tr>
		<td class="center" width="50%" style="padding-top: 150px">
			<span class="italic">DR. WILFREDO TAVERA LLANOS</span><br>
			<span class="bold">DR. DECANO</span><br>
			<span class="bold">FAC. CS. PURAS Y NATURALES</span>
		</td>      	
		<td width="50%" style="padding-top: 150px">
			<span class="bold italic">Vo.Bo.</span>
		</td>
	</tr>
</table>
</div>
</body>
</html>