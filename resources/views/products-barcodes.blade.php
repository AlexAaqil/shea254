<!DOCTYPE html>
<html>
<head>
    <title>Product Barcodes</title>
    <style>
        * {
            font-family: sans-serif;
        }

        .barcode {
            width: 180px;
            margin: 0 0 40px;
            text-align: center;
            font-size: 10px;
            /* display: inline-block; */
        }

        .barcode img {
            max-height: 1cm;
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
    <div>
        <h2>Product Barcodes</h2>
        <p>{{ $count_products }} products</p>

        @if (!isset($pdf))
            <div class="download_button">
                <a href="{{ route('products-barcodes.download') }}" class="btn">Download as PDF</a>
            </div>
        @endif

        <div class="barcodes">
            @foreach($products as $product_code => $product_name)
                <div class="barcode">
                    <p>
                        <span><strong>{{ $product_code }} : </strong></span>
                        <span>{{ $product_name }}</span>
                    </p>
                    {!! DNS1D::getBarcodeHTML((string) $product_code, 'C128', 1.2, 28) !!}
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
