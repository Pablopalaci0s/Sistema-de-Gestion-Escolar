<?php
// descargar_factura.php
include "conexion.php";
require 'tcpdf/tcpdf.php'; // Asegúrate de tener la librería TCPDF en la ubicación correcta

if (isset($_GET["factura_id"])) {
    $factura_id = $_GET["factura_id"];

    // Obtener la información de la factura desde la base de datos
    $sql = "SELECT * FROM facturas WHERE id = $factura_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Crear un nuevo objeto TCPDF
        $pdf = new TCPDF();
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage();
        $pdf->SetFont('times', 'B', 16);
        
        // Agregar contenido al PDF
        $pdf->Cell(0, 10, 'Número de Factura: ' . $row["id"], 0, 1);
        $pdf->Cell(0, 10, 'Libro Prestado: ' . $row["id_libro"], 0, 1);
        $pdf->Cell(0, 10, 'Fecha de Generación: ' . $row["fecha_generacion"], 0, 1);

        // Descargar el archivo PDF
        $pdf->Output('factura_'.$factura_id.'.pdf', 'D');
    } else {
        echo "Factura no encontrada.";
    }
} else {
    echo "ID de factura no proporcionado.";
}
?>
