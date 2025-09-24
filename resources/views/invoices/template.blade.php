<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body { 
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif; 
            color: #000; 
            background: #fff;
            line-height: 1.4;
        }
        
        .invoice-box { 
            max-width: 800px; 
            margin: 0 auto; 
            padding: 40px 50px; 
            font-size: 14px;
        }
        
        /* Header */
        .invoice-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: flex-start;
            margin-bottom: 60px;
        }
        
        .invoice-header-left {
            display: flex;
            align-items: center;
        }
        
        .logo { 
            width: 70px; 
            height: 70px; 
            border-radius: 50%;
            object-fit: cover;
        }
        
        .invoice-header-right {
            text-align: right;
        }
        
        .invoice-header-right h1 { 
            font-size: 48px; 
            font-weight: 900; 
            letter-spacing: 2px;
            margin: 0;
            color: #000;
        }
        
        .invoice-header-right p {
            margin: 8px 0 4px 0;
            font-size: 14px;
            font-weight: 500;
            color: #000;
        }
        
        .invoice-header-right p:last-child {
            font-size: 13px;
            color: #666;
            font-weight: 400;
        }
        
        /* Invoice Details */
        .invoice-details { 
            display: flex; 
            justify-content: space-between; 
            margin-bottom: 50px;
        }
        
        .invoice-to {
            flex: 1;
        }
        
        .transaction-details {
            text-align: right;
        }
        
        .section-title { 
            font-weight: 700; 
            font-size: 11px; 
            text-transform: uppercase; 
            letter-spacing: 0.5px;
            margin-bottom: 12px;
            color: #000;
        }
        
        .customer-name { 
            font-weight: 600; 
            font-size: 16px;
            margin-bottom: 4px;
            color: #000;
        }
        
        .invoice-to p:not(.section-title):not(.customer-name),
        .transaction-details p:not(.section-title) {
            font-size: 14px;
            color: #666;
        }
        
        /* Items Table */
        .items-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 40px;
        }
        
        .items-table th { 
            background: #333; 
            color: #fff; 
            padding: 16px 20px;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .items-table td { 
            padding: 18px 20px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            vertical-align: top;
        }
        
        .items-table tr.item.last td {
            border-bottom: none;
        }
        
        .items-table td small {
            font-size: 12px;
            color: #666;
            display: block;
            margin-top: 2px;
        }
        
        .items-table td:not(:first-child) {
            font-weight: 500;
        }
        
        /* Bottom Section Layout */
        .bottom-section {
            width: 100%;
            margin-top: 40px;
        }
        
        .bottom-section table {
            width: 100%;
        }
        
        .bottom-section td {
            vertical-align: top;
            width: 50%;
        }
        
        .payment-method {
            margin-top: 0;
        }
        
        .payment-method p:not(.section-title) {
            font-size: 14px;
            color: #666;
            margin-top: 8px;
        }
        
        .summary-table {
            width: 100%;
            margin-left: 0;
            margin-top: 0;
        }
        
        .summary-table td {
            padding: 8px 0;
            font-size: 14px;
            border: none;
        }
        
        .summary-table .label {
            font-weight: 500;
            color: #000;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        
        .summary-table td:last-child {
            text-align: right;
            font-weight: 500;
        }
        
        .summary-table .total {
            background: #333;
            color: #fff;
            font-weight: 700;
            font-size: 16px;
            padding: 16px 20px;
        }
        
        .summary-table .total td {
            padding: 16px 20px;
        }
        
        .summary-table .total .label {
            color: #fff;
            font-size: 12px;
        }
        
        /* Footer */
        .footer { 
            text-align: center; 
            margin-top: 80px;
        }
        
        .footer > p:first-child {
            font-size: 14px;
            color: #333;
            margin-bottom: 40px;
            line-height: 1.6;
        }
        
        .signature {
            margin-bottom: 30px;
        }
        
        .signature strong {
            font-weight: 700;
            font-size: 16px;
            color: #000;
            display: block;
            margin-bottom: 4px;
        }
        
        .founder {
            font-size: 10px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
        }
        
        .tagline {
            font-size: 14px;
            color: #666;
            font-style: italic;
            font-weight: 400;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        {{-- Header: Logo & Judul Invoice --}}
        <div class="invoice-header">
            <div class="invoice-header-left">
                {{-- Pastikan logo.png ada di folder public/ --}}
                <img src="{{ public_path('logo.png') }}" alt="ULANGIN Logo" class="logo">
            </div>
            <div class="invoice-header-right">
                <h1>INVOICE</h1>
                <p><strong>Invoice ID:</strong> ULANGIN{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</p>
                <p>ulanginreworks@gmail.com</p>
            </div>
        </div>

        {{-- Detail Penerima & Tanggal --}}
        <div class="invoice-details">
            <div class="invoice-to">
                <p class="section-title">Invoice To</p>
                <p class="customer-name">{{ $order->customer_name }}</p>
                <p>{{ $order->customer_phone }}</p>
            </div>
            <div class="transaction-details">
                <p class="section-title">Transaction Date</p>
                <p>{{ $order->created_at->format('d F Y') }}</p>
            </div>
        </div>

        {{-- Tabel Item Produk --}}
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">PRODUCT</th>
                    <th style="text-align: center;">PRICE</th>
                    <th style="text-align: center;">QTY</th>
                    <th style="text-align: right;">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                <tr class="item {{ $loop->last ? 'last' : '' }}">
                    <td>
                        {{ $item->product->name }}
                        <small>Ukuran: {{ $item->size }}</small>
                    </td>
                    <td style="text-align: center;">Rp {{ number_format($item->price) }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">Rp {{ number_format($item->price * $item->quantity) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Detail Pembayaran & Rincian Total --}}
        <div class="bottom-section">
            <table>
                <tr>
                    <td>
                        <div class="payment-method">
                            <p class="section-title">Payment Method</p>
                            <p>QRIS</p>
                        </div>
                    </td>
                    <td>
                        <table class="summary-table">
                            @php $subtotal = $order->items->sum(fn($i) => $i->price * $i->quantity); @endphp
                            <tr>
                                <td class="label">SUB-TOTAL</td>
                                <td>Rp {{ number_format($subtotal) }}</td>
                            </tr>
                            @if ($order->voucher_code)
                                <tr>
                                    <td class="label">DISCOUNT ({{ $order->voucher_code }})</td>
                                    <td>- Rp {{ number_format($subtotal - $order->total_price) }}</td>
                                </tr>
                            @endif
                            <tr class="total">
                                <td class="label">TOTAL</td>
                                <td>Rp {{ number_format($order->total_price) }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        {{-- Footer --}}
        <div class="footer">
            <p>Terima kasih sudah menjadi bagian dari<br>#ULANGINMovement</p>
            <p class="tagline">Fashion is Temporary, Threads are Forever</p>
        </div>
    </div>
</body>
</html>