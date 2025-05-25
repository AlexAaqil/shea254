<!DOCTYPE html>
<html>
<head>
    <title>Product Barcodes</title>
    <style>
        * {
            font-family: sans-serif;
        }

        @media print {
            .download_button {
                display: none;
            }

            .barcode {
                page-break-inside: avoid;
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Product Barcodes</h2>
        <p>{{ $count_products }} products</p>
        @if (!isset($pdf))
            <div class="download_button">
                <a href="{{ route('products-barcodes.download') }}" class="btn">Download as PDF</a>
            </div>
        @endif

        <div class="barcodes">
            @foreach($products as $product)
                <div class="barcode" style="width: 200px; margin: 20px; text-align: center;">
                    <p>ID: {{ $product->id }} : {{ $product->title }}</p>
                    {!! DNS1D::getBarcodeHTML((string) $product->id, 'C128', 2, 60) !!}
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
