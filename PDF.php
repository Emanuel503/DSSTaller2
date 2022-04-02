<?php
    $cuerpohtml = " 
                    <h1>Registro de estudiantes</h1>

                    <table border='1'>
                        <thead>
                            <tr class='table-secondary'>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Grado</th>
                                <th>Fecha de nacimiento</th>
                            </tr>
                        </thead>
                        <tbody class='table-secondary'>";

    include("conexion.php");
    $sql = "SELECT * FROM estudiantes";
    $res = $conexion->query($sql);
    $total=0;

    while($fila=$res->fetch_assoc()){
        $total++;
        $cuerpohtml .= "
                            <tr>
                                <td>".$fila['id']."</td>
                                <td>".$fila['nombres']."</td>
                                <td>".$fila['apellidos']."</td>
                                <td>".$fila['grado']."</td>
                                <td>".$fila['fechaNacimiento']."</td>";
    }
    $cuerpohtml .= "	    </tr>
					    </tbody>
					</table>
                    
                    <p>Numero de estudiantes registrados: ".$total."</p>";


	require_once('vendor/autoload.php');

    $css = file_get_contents('css/pdf.css');

	$mpdf = new \Mpdf\Mpdf([
		"format" => "Letter"
	]);

	$mpdf->writeHtml($css, \Mpdf\HTMLParserMode::HEADER_CSS);

	$mpdf->writeHtml($cuerpohtml, \Mpdf\HTMLParserMode::HTML_BODY);
	
	$mpdf->Output("Registro de estudiantes.pdf","I");
?>