<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductBarcodeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('title')->get();
        $count_products = Product::count();
        return view('products-barcodes', compact('count_products', 'products'));
    }

    public function downloadPdf()
    {
        $products = Product::orderBy('title')->get();
        $count_products = Product::count();

        $pdf = Pdf::loadView('products-barcodes', [
                'count_products' => $count_products,
                'products' => $products,
                'pdf' => true
            ])->setPaper('A4');

        return $pdf->download('products-barcodes.pdf');
    }
}
