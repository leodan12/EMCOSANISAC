<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
   
    public function createPDF(){
        //Recuperar todos los productos de la db
        //$productos = Producto::all();
       // view()->share('productos', $productos);
        $pdf = PDF::loadView('pdf/miboleta'   );
        return $pdf->stream('archivo-pdf.pdf');
    }

}
