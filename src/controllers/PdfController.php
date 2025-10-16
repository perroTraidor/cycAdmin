<?php

namespace App\Controllers;
use FPDF;
use App\Controllers\ProveedoresController;
use App\models\ChequesModel;

//include('libs/fpdf/fpdf.php');

class PdfController {
    public static function create() {
        // Recibir los datos del formulario
        $datosOrden = $_POST['datosOrden'];
        $comprobantes = json_decode($_POST['comprobantes'], true);
        $valoresEntregados = json_decode($_POST['valoresEntregados'], true);
        $tipoDocumento = $_POST['tipoDocumento'] ?? 'OP';

        // Obtener los datos del proveedor por su ID
        $proveedorId = $datosOrden['proveedor_id'] ?? null; // Ajusta esto según tu estructura
        if ($proveedorId) {
            $proveedorDatos = ProveedoresController::proveedorData($proveedorId);
        
        if (!$proveedorDatos) {
            echo "Error: No se encontró el proveedor";
            return;
        }

        // Llamar a la función que genera el PDF
        self::create($datosOrden, $comprobantes, $valoresEntregados, $tipoDocumento, $proveedorDatos);
    }
    }
    // Método genérico para crear PDFs
    public static function createPDF() {
        // print_r($_POST);
        // exit;
        $pdf = new FPDF('P','mm','A4');
        $pdf->SetMargins(15,15,15);
        $pdf->AddPage();

        ob_start();  // Inicia el buffer para evitar cualquier salida previa
        # Logo de la empresa formato png #
        $pdf->Image('assets/img/logo.png',15,12,45,28,'PNG');

        // Obtener los datos de la OP del formulario
        $numero = $_POST['datosOrden']['numero'];
        $fecha = $_POST['datosOrden']['fecha'];
        $proveedor = $_POST['datosOrden']['proveedor'];
        $total = $_POST['datosOrden']['total'];

        $proveedorId = $_POST['datosOrden']['proveedor_id'] ?? null; // Ajusta esto según tu estructura
        if ($proveedorId) {
            $proveedorDatos = ProveedoresController::proveedorData($proveedorId);
        
        if (!$proveedorDatos) {
            echo "Error: No se encontró el proveedor";
            return;
        }
    }

        # Encabezado y datos de la empresa #

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(80,15,iconv("UTF-8", "ISO-8859-1", ""),0,0);
        $pdf->SetFont('Arial','B',30);
        $pdf->Cell(20,15,iconv("UTF-8", "ISO-8859-1","OP"),0,0, 'C');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(50,15,iconv("UTF-8", "ISO-8859-1","Fecha de emisión:"),0,0, 'R');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(30,15,iconv("UTF-8", "ISO-8859-1",date("d/m/Y", strtotime($fecha))),0,0,'L');
        
        $pdf->Ln(26);
        
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(110,3,iconv("UTF-8", "ISO-8859-1","de Flavio Ivan Carcamo - CUIT: 20-25722254-4"),0,0,'L');
        $pdf->SetFont('Arial','B',17);
        $pdf->Cell(22,3,iconv("UTF-8", "ISO-8859-1","Nro.:"),0,0,'R');
        $pdf->SetFont('Arial','',17);
        $pdf->Cell(17,3,iconv("UTF-8", "ISO-8859-1","001-"),0,0,'R');
        $pdf->SetFont('Arial','',17);
        $pdf->Cell(31,3,iconv("UTF-8", "ISO-8859-1",sprintf('%08d', $numero)),0,0,'L');
        
        $pdf->Ln(4);
        
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(110,3,iconv("UTF-8", "ISO-8859-1","Domicilio: Piedrabuena 2342 - Santa Fe - CP: 3000"),0,0,'L');
        
        $pdf->Ln(4);
        
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(110,3,iconv("UTF-8", "ISO-8859-1","Email: info@cycrepuestos.com.ar"),0,0,'L');
        
        $pdf->Ln(5);
        $pdf->Cell(180,1,iconv("UTF-8", "ISO-8859-1",""),'B',0);
        
        # Datos del proveedor #
        $pdf->Ln(2);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20,7,iconv("UTF-8", "ISO-8859-1","Proveedor:"),0,0);
        $pdf->Cell(45,7,iconv("UTF-8", "ISO-8859-1",$proveedor),0,0,'L');
        $pdf->Cell(20,7,iconv("UTF-8", "ISO-8859-1","CUIT: "),0,0,'L');
        $pdf->Cell(45,7,iconv("UTF-8", "ISO-8859-1",$proveedorDatos['cuit']),0,0,'L');
        $pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1","Tel:"),0,0,'L');
        $pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1",$proveedorDatos['telefono']),0,0);
        
        # Direccion #
        $pdf->Ln(5);
        $pdf->Cell(10,7,iconv("UTF-8", "ISO-8859-1","Email:"),0,0);
        $pdf->Cell(55,7,iconv("UTF-8", "ISO-8859-1",$proveedorDatos['email']),0,0);
        $pdf->Cell(20,7,iconv("UTF-8", "ISO-8859-1","Domicilio:"),0,0);
        $pdf->Cell(45,7,iconv("UTF-8", "ISO-8859-1",$proveedorDatos['domicilio']),0,0);
        $pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1","Localidad:"),0,0);
        $pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1",$proveedorDatos['telefono']),0,0);
        
        $pdf->Ln(7);
        $pdf->Cell(180,7,iconv("UTF-8", "ISO-8859-1",""),'T',0,'C');


        $pdf->Ln(7);

        # Título de comprobantes #
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(180,10,iconv("UTF-8", "ISO-8859-1","Comprobantes afectados"),0,0,'C');
        
        $pdf->Ln(7);
        $pdf->Cell(180,5,iconv("UTF-8", "ISO-8859-1",""),'B',0,'C');
        
        // Mostrar las formas de pago
        
        $pdf->Ln(7);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 7, 'Formas de Pago', 0, 1);

        $formasPago = json_decode($_POST['formasPago'], true);
        $pdf->SetFont('Arial', '', 9);
        foreach ($formasPago as $forma) {
            $pdf->Cell(50, 7, 'Forma: ' . $forma['forma'], 0, 0);
            $pdf->Cell(130, 7, 'Importe: $' . $forma['importe'], 0, 1, 'R');
        }

        // Mostrar los valores emitidos (cheques)
        //$pdf->Ln(10);
        //$pdf->SetFont('Arial', 'B', 12);
        //$pdf->Cell(0, 10, 'Valores Emitidos', 0, 1);

        // Si la forma de pago es cheque o echeq, buscar los valores emitidos
        if ($forma['forma'] === 'che' || $forma['forma'] === 'ech') {
            // Obtener el id de la forma de pago para buscar los cheques
            $formaPagoId = $forma['id']; // Asegúrate de que el ID esté presente en el array

            // Instanciar el modelo de Cheques y obtener los valores emitidos
            $chequesModel = new ChequesModel();
            $cheques = $chequesModel->buscaCheques($formaPagoId); // Usar el id de la forma de pago
            // print_r($cheques);
            // exit;
            // Mostrar los cheques en el PDF
            if (!empty($cheques)) {
                $pdf->Ln(5);
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(0, 10, 'Valores Emitidos (Cheques/Echeqs)', 0, 1);

                $pdf->SetFont('Arial', '', 9);
                foreach ($cheques as $cheque) {
                    $pdf->Cell(40, 7, 'Banco: ' . $cheque['banco'], 0, 0);
                    $pdf->Cell(30, 7, 'Numero: ' . $cheque['numero'], 0, 0);
                    $pdf->Cell(50, 7, 'Fecha de Pago: ' . $cheque['fecha_p'], 0, 0);
                    $pdf->Cell(60, 7, 'Importe: $' . $cheque['importe'], 0, 1, 'R');
                }
                
            } else {
                $pdf->Cell(0, 10, 'No hay cheques emitidos.', 0, 1);

            }
        }
        
        // Mostrar las imputaciones
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 10, 'Imputaciones a Facturas', 0, 1);
        
        $imputaciones = json_decode($_POST['imputaciones'], true);
        $pdf->SetFont('Arial', '', 9);
        foreach ($imputaciones as $imputacion) {
            $pdf->Cell(70, 7, 'Nro Factura: ' . $imputacion['numero_factura'], 0, 0);
            $pdf->Cell(50, 7, 'Fecha: ' . $imputacion['fecha_factura'], 0, 0);
            $pdf->Cell(60, 7, 'Importe Imputado: $' . $imputacion['importe_imputado'], 0, 1, 'R');
        }
        
        self::CheckPageBreak($pdf, 15);
        
        # Totales #
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(100,12,"",'T',0,'C');
        $pdf->Cell(15,12,"",'T',0,'C');
        $pdf->Cell(32,12,"TOTAL CANCELADO:",'T',0,'C');
        $pdf->Cell(34,12,"$".$total, 'T', 0, 'C');

        if ($pdf->GetY() > 250) { // Si la posición Y es mayor a 250, añadir una nueva página
            $pdf->AddPage();
        }
        ob_end_clean();  // Limpia cualquier salida previa antes de enviar el PDF
        # Output del PDF #
        $pdf->Output("I","documento_.pdf",true);
    }

    public static function CheckPageBreak($pdf, $h) {
        // Definir márgenes manualmente
        $topMargin = 15; // Margen superior que definiste en SetMargins
        $bottomMargin = 15; // Margen inferior que también estableciste
    
        // Obtener la altura de la página
        $pageHeight = $pdf->GetPageHeight();
    
        // Calcular el espacio disponible restando los márgenes y la posición actual
        $availableSpace = $pageHeight - $bottomMargin - $pdf->GetY();
    
        // Si el espacio disponible es menor que la altura necesaria, agregar una nueva página
        if ($availableSpace < $h) {
            $pdf->AddPage();
        }
    }
    
}

?>