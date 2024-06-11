<?php
require('../fpdf/fpdf.php');

// Clase extendida de FPDF para soportar UTF-8 y mostrar imágenes
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, 'Propiedad en Venta', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }

    // Función para añadir una imagen desde un archivo
    function AddImage($file, $x = null, $y = null, $w = 0, $h = 0)
    {
        if (file_exists($file)) {
            $this->Image($file, $x, $y, $w, $h);
        }
    }
}

include "../conexion.php";

ob_start(); // Iniciar el búfer de salida

$data = json_decode(file_get_contents("php://input"));
$id_casa = $data->id ?? 0;

if ($id_casa == 0) {
    ob_end_clean();
    die('Error: No se ha proporcionado un ID de casa válido.');
}

$pdf = new PDF();

$sql = "SELECT casa.*, imagenes.imagen AS image_path
        FROM casa
        LEFT JOIN imagenes ON casa.id_casa = imagenes.id_casa
        WHERE casa.id_casa = ?";
$stmt = $conexion->prepare($sql); 
$stmt->bind_param("i", $id_casa);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, utf8_decode('Casa en Venta: ' . ($row["titulo"] ?? 'Sin título')), 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, utf8_decode('Dirección: Calle de la Primavera, 123, Ciudad Bella, Estado Feliz'), 0, 1);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, utf8_decode('Descripción General:'), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, utf8_decode($row["descprcion"] ?? 'Sin descripción'));
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, utf8_decode('Características Principales:'), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, utf8_decode('Número de Habitaciones: ' . ($row["habitaciones"] ?? 'N/A')), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Precio: $' . number_format($row["precio"] ?? 0, 2) . '€'), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Comunidad Autónoma: ' . ($row["comunidad_autonoma"] ?? 'N/A')), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Ciudad: ' . ($row["ciudad"] ?? 'N/A')), 0, 1);
    $pdf->Ln(10);

    // Imágenes
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, utf8_decode('Imágenes:'), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    do {
        if (!empty($row["image_path"])) {
            $pdf->AddImage('../img/' . $row["image_path"], null, null, 100, 100); // Ajusta el tamaño según sea necesario
            $pdf->Ln(10);
        }
    } while ($row = $result->fetch_assoc());

    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, utf8_decode('Contacto:'), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, utf8_decode('Teléfono: +123 456 7890'), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Email: contacto@viarealestate.com'), 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Dirección de la Inmobiliaria: Avenida Central, 456, Ciudad Bella, Estado Feliz'), 0, 1);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, utf8_decode('Otros Detalles:'), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, utf8_decode('Ubicada cerca de escuelas, centros comerciales y parques, esta propiedad es perfecta para disfrutar de una vida tranquila y con todas las comodidades.'));
    $pdf->Ln(10);

    ob_end_clean(); // Limpiar el búfer de salida y desactivarlo

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="Propiedad_' . $id_casa . '.pdf"');
    header('Content-Length: ' . strlen($pdf->Output('S'))); // Obtener la longitud del contenido del PDF

    $pdf->Output('I', 'Propiedad_' . $id_casa . '.pdf');
} else {
    ob_end_clean(); // Limpiar el búfer de salida en caso de error
    echo "No se encontró la casa con ID: $id_casa";
}

$conexion->close();
?>
