<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductBarcodeController extends Controller
{
    protected function getProducts()
    {
        $json = File::get(database_path('products.json'));
        return json_decode($json, true); // returns associative array: [code => name]
    }

    public function index()
    {
        $products = $this->getProducts();
        $count_products = count($products);

        return view('products-barcodes', compact('products', 'count_products'));
    }

    public function downloadPdf()
    {
        $products = $this->getProducts();
        $count_products = count($products);

        $pdf = Pdf::loadView('products-barcodes', [
            'products' => $products,
            'count_products' => $count_products,
            'pdf' => true
        ])->setPaper('A4');

        return $pdf->download('products-barcodes.pdf');
    }
}
