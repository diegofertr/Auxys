<!DOCTYPE html>
<html>
<head>
	<title>Lista de postulantes para {{ $materia->sigla }}</title>
	<link rel="stylesheet" type="text/css" href="css/print.css">
	<style type="text/css">
	html,body{
		font-size: 12px;
	}
		table {
		  width: 100%;
		  border-spacing: 0;
		  margin-bottom: 8px;
		}
		tr, th, td {
		    border-collapse:collapse;
		    border: 1px black solid;
		}
		.vertical {
			width: 100%;
			height:  auto;
			margin:0;
			font-size: 8px;
			padding: 0;
			-moz-transform: rotate(-90.0deg);  /* FF3.5+ */
			-o-transform: rotate(-90.0deg);  /* Opera 10.5 */
			-webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
			filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
			-ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
		}
	</style>
</head>
<body>
<h3 class="center bold">CONVOCATORIA DE MÉRITOS Y EXAMEN DE COMPETENCIA PARA AUXILIARES DE DOCENCIA
<br>FAC. CIENCIAS PURAS Y NATURALES - CARRERA INFORMÁTICA
<br>HABILITACIÓN
<br>CUADRO CUMPLIMIENTO DE REQUISITOS
</h3>
<table width="100%">
	<tr>
		<td><span class="bold">ASIGNATURA: </span> {{ $materia->descripcion }}</td>
		<td><span class="bold">SIGLA: </span> {{ $materia->sigla }}</td>
		<td><span class="bold">FECHA: </span> {{ $date }}</td>
	</tr>
</table>
<table class="table">
	<thead>
		<tr >
			<th style="height: 250px;">Nº</th>
			<th>C.I.</th>
			<th style="width:300px">APELLIDOS Y NOMBRES</th>
			<th>
			<p class="vertical">
			Ser estudiante de la Universidad en concordancia al Estatuto Orgánico de la Universidad Boliviana (Art. 119 y 120).
			</p>
			</th>
			<th><p class="vertical">
				
			En el caso de haber concluido el plan de estudios, el interesado puede postular a la auxiliatura, dentro del periodo de dos años, después de la conclusión de sus estudios. Este periodo de dos años no podrá ampliarse bajo circunstancia alguna aun en caso de encontrarse cursando otra carrera. 
			</p>
			</th>
			<th><p class="vertical">
				
			Tener aprobadas la totalidad de materias hasta el periodo semestral al que postula. 
			</p>
			</th>
			<th><p class="vertical">
				
			Participar y aprobar el Concurso de méritos y proceso de pruebas de selección, admisión conforme a convocatoria. 
			</p>
			</th>
			<th><p class="vertical">
				
			El estudiante universitario podrá ser universitario de docencia hasta dos gestiones académicas en la misma asignatura. (Resol HCU No.  170/2003).
			</p>
			</th>
			<th><p class="vertical">
				
			No ser profesional, cualquiera sea el nivel académico otorgado ( Resolución  H.C.U. 170/2003)	
			</p>
			</th>
			<th><p class="vertical">
				
			Los estudiantes miembros de las instancias de co-gobierno a nivel de Carrera o Facultad, para postularse a la Auxiliatura de Docencia. Deben solicitar LICENCIA en las Convocatorias y cuando se trate el caso particular a los consejos que corresponda. Asimismo los  estudiantes de Centros Facultativos y de Carrera no pueden participar en comisiones de evaluación, estos  tienen que ser los mejores alumnos (Resolución. No.  H.C.U. 157/2008).
			</p>
			</th>
			<th><p class="vertical">
				
			Registro al SIGEP (SISTEMA DE GESTION PUBLICA).
			</p>
			</th>
			<th><p class="vertical">
				
			No tener cargos pendientes con la Universidad, ni proceso Universitario ejecutoriado.
			</p>
			</th>
			<th>
			<p class="vertical">Observaciones</p></th>
		</tr>
	</thead>
	<tbody>
		@foreach($students as $index=>$student)
			<tr>
				<td>{{ $index +  1}}</td>
				<td>{{ $student->carnet_identidad }}</td>
				<td>{{ $student->getFullName() }}</td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
			</tr>
		@endforeach
	</tbody>
</table>
</body>
</html>