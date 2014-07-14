<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reporte extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('modelo');
        $this->load->library('Pdf');
    }

   
    public function usuario() {       
        $this->pdf = new Pdf();
        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        //margenes
        $this->pdf->SetMargins(20, 30, 20);

        $p = $this->modelo->grilla_u()->result();
        // Agregamos una página
            $this->pdf->AddPage();
            //HEADER
            $this->pdf->SetFont('Arial', '', 8);
            $this->pdf->Text(20, 14, 'Gri TV Loncomilla', 0, 'C', 0);
            $this->pdf->Text(24, 17, 'Departamento de Ventas', 0, 'C', 0);
            $this->pdf->Text(26, 20, 'Remuneraciones', 0, 'C', 0);
            $this->pdf->Ln(3);
            $this->pdf->Image('FOTOS/logo180.jpg', 130, 5, 60);
            $this->pdf->SetFont('Arial', 'B', 13);
            $this->pdf->Cell(30);
            $this->pdf->Cell(120, 10, 'Lista Usuarios', 0, 0, 'C');
            $this->pdf->Ln(5);
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(30);
            $this->pdf->Cell(120, 10, 'INFORMACION DE LOS Usuarios', 0, 0, 'C');
            $this->pdf->Ln(7);            
           
            $this->pdf->SetFont('Arial', '', 12);
            $this->pdf->Cell(0, 6, '', 0, 1);
            $this->pdf->Cell(0, 6, 'Datos de busqueda: Todos los usuarios', 0, 1);                      
            $this->pdf->Ln(4);
        //grilla
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->SetFillColor(85, 107, 47); //color de la cenlda
            $this->pdf->SetTextColor(255); //color del texto
            //definir ancho de cada columna
            $this->pdf->SetWidths(array(22, 25, 25,50,20));
            for ($i = 0; $i < 1; $i++) {
                //encabezado de la grilla
                $this->pdf->Row(array( 'Rut', 'Nombres','Apellido','Tipo','Estado'));
            }

            $c = 0;
            foreach ($p as $fila) {
                $c++;
               
                //contenido de cada celda
                if ($c % 2 == 1) {
                    $this->pdf->SetFillColor(153, 255, 153);
                    $this->pdf->SetTextColor(0);
                    $this->pdf->Row(array($fila->rut,$fila->nombre,$fila->apellido,$fila->nivel,$fila->estado_us));
                } else {
                    $this->pdf->SetFillColor(102, 204, 51);
                    $this->pdf->SetTextColor(0);
                    $this->pdf->Row(array($fila->rut,$fila->nombre,$fila->apellido,$fila->nivel,$fila->estado_us));
                }
            }
        

        /*
         * Se manda el pdf al navegador
         *
         * $this->pdf->Output(nombredelarchivo, destino);
         *
         * I = Muestra el pdf en el navegador
         * D = Envia el pdf para descarga
         *
         */

        $this->pdf->Output("reporte usuario.pdf", 'I');
    
    }
    public function servicio() {       
        $this->pdf = new Pdf();
        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        //margenes
        $this->pdf->SetMargins(20, 30, 20);

        $p = $this->modelo->grilla_s()->result();
        // Agregamos una página
            $this->pdf->AddPage();
            //HEADER
            $this->pdf->SetFont('Arial', '', 8);
            $this->pdf->Text(20, 14, 'Gri TV Loncomilla', 0, 'C', 0);
            $this->pdf->Text(24, 17, 'Departamento de Ventas', 0, 'C', 0);
            $this->pdf->Text(26, 20, 'Remuneraciones', 0, 'C', 0);
            $this->pdf->Ln(3);
            $this->pdf->Image('FOTOS/logo180.jpg', 130, 5, 60);
            $this->pdf->SetFont('Arial', 'B', 13);
            $this->pdf->Cell(30);
            $this->pdf->Cell(120, 10, 'Lista servicio', 0, 0, 'C');
            $this->pdf->Ln(5);
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(30);
            $this->pdf->Cell(120, 10, 'INFORMACION DE LOS SERVICIOS', 0, 0, 'C');
            $this->pdf->Ln(7);            
           
            $this->pdf->SetFont('Arial', '', 12);
            $this->pdf->Cell(0, 6, '', 0, 1);
            $this->pdf->Cell(0, 6, 'Datos de busqueda: Todos los servicio', 0, 1);                      
            $this->pdf->Ln(4);
        //grilla
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->SetFillColor(85, 107, 47); //color de la cenlda
            $this->pdf->SetTextColor(255); //color del texto
            //definir ancho de cada columna
            $this->pdf->SetWidths(array(25, 50,50, 50));
            for ($i = 0; $i < 1; $i++) {
                //encabezado de la grilla
                $this->pdf->Row(array( 'ID', 'Nombres','Tiempo','Estado'));
            }

            $c = 0;
            foreach ($p as $fila) {
                $c++;
               
                //contenido de cada celda
                if ($c % 2 == 1) {
                    $this->pdf->SetFillColor(153, 255, 153);
                    $this->pdf->SetTextColor(0);
                    $this->pdf->Row(array($fila->id_s,$fila->nombre_s,$fila->Tiempo,$fila->estado_s));
                } else {
                    $this->pdf->SetFillColor(102, 204, 51);
                    $this->pdf->SetTextColor(0);
                   $this->pdf->Row(array($fila->id_s,$fila->nombre_s,$fila->Tiempo,$fila->estado_s));
                }
            }
        

        /*
         * Se manda el pdf al navegador
         *
         * $this->pdf->Output(nombredelarchivo, destino);
         *
         * I = Muestra el pdf en el navegador
         * D = Envia el pdf para descarga
         *
         */

        $this->pdf->Output("reporte servicios.pdf", 'I');
    }
    public function tecnico() {       
        $this->pdf = new Pdf();
        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        //margenes
        $this->pdf->SetMargins(20, 30, 20);

        $p = $this->modelo->grilla_tec()->result();
        // Agregamos una página
            $this->pdf->AddPage();
            //HEADER
            $this->pdf->SetFont('Arial', '', 8);
            $this->pdf->Text(20, 14, '        Gri TV Loncomilla', 0, 'C', 0);
            $this->pdf->Text(24, 17, 'Departamento de Ventas', 0, 'C', 0);
            $this->pdf->Text(26, 20, 'Remuneraciones', 0, 'C', 0);
            $this->pdf->Ln(3);
            $this->pdf->Image('FOTOS/logo180.jpg', 130, 5, 60);
            $this->pdf->SetFont('Arial', 'B', 13);
            $this->pdf->Cell(30);
            $this->pdf->Cell(120, 10, 'Lista servicio', 0, 0, 'C');
            $this->pdf->Ln(5);
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->Cell(30);
            $this->pdf->Cell(120, 10, 'INFORMACION DE LOS tecnicos', 0, 0, 'C');
            $this->pdf->Ln(7);            
           
            $this->pdf->SetFont('Arial', '', 12);
            $this->pdf->Cell(0, 6, '', 0, 1);
            $this->pdf->Cell(0, 6, 'Datos de busqueda: Todos los tecnicos', 0, 1);                      
            $this->pdf->Ln(4);
        //grilla
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->SetFillColor(85, 107, 47); //color de la cenlda
            $this->pdf->SetTextColor(255); //color del texto
            //definir ancho de cada columna
            $this->pdf->SetWidths(array(25, 50, 50));
            for ($i = 0; $i < 1; $i++) {
                //encabezado de la grilla
                $this->pdf->Row(array( 'ID', 'Nombres','Estado'));
            }

            $c = 0;
            foreach ($p as $fila) {
                $c++;
               
                //contenido de cada celda
                if ($c % 2 == 1) {
                    $this->pdf->SetFillColor(153, 255, 153);
                    $this->pdf->SetTextColor(0);
                    $this->pdf->Row(array($fila->id_t,$fila->nombre_t,$fila->estado_t));
                } else {
                    $this->pdf->SetFillColor(102, 204, 51);
                    $this->pdf->SetTextColor(0);
                   $this->pdf->Row(array($fila->id_t,$fila->nombre_t,$fila->estado_t));
                }
            }
        

        /*
         * Se manda el pdf al navegador
         *
         * $this->pdf->Output(nombredelarchivo, destino);
         *
         * I = Muestra el pdf en el navegador
         * D = Envia el pdf para descarga
         *
         */

        $this->pdf->Output("reporte tecnicos.pdf", 'I');
    }

}