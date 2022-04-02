<?php
    $cuerpohtml = " 
                    <h1>Registro de empleados</h1>

                    <table border='1'>
                        <thead>
                            <tr class='table-secondary'>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Cargo</th>
                                <th>Fecha de nacimiento</th>
                            </tr>
                        </thead>
                        <tbody class='table-secondary'>";

    $total=0;
    $conexion = pg_connect("host=localhost dbname=taller2 user=postgres password=admin");
    $query ="SELECT * FROM empleados";
    $resultado = pg_query($conexion, $query);
    while($row = pg_fetch_object($resultado)){
        $total++;
        $cuerpohtml .= "
                            <tr>
                                <td>".$total."</td>
                                <td>".$row->nombres."</td>
                                <td>".$row->apellidos."</td>
                                <td>".$row->cargo."</td>
                                <td>".$row->fecha_nacimiento."</td>";
    }
    $cuerpohtml .= "	    </tr>
					    </tbody>
					</table>
                    
                    <p>Numero de empleados registrados: ".$total."</p>";


	require_once('vendor/autoload.php');

    $css = file_get_contents('css/pdf.css');

	$mpdf = new \Mpdf\Mpdf([
		"format" => "Letter"
	]);

	$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);

	$mpdf->writeHtml($cuerpohtml, \Mpdf\HTMLParserMode::HTML_BODY);
	
	$mpdf->Output("Registro de empleados.pdf","I");
?>