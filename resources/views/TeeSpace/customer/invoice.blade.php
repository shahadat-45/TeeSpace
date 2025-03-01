<!DOCTYPE html>
<html lang="en" moznomarginboxes mozdisallowselectionprint xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoive</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif !important;
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        body{
            color: #404040;
            margin: 0;
            padding: 0;
        }
        table{
            width: 100%;
        }
        @media print {
            @page { size: auto; margin: 0; padding: 0; }
        }
    </style>
</head>
<body style="color: #404040; margin: 0; padding: 0;">
    <table
        border="0"
        cellpadding="0"
        cellspacing="0"
        style="width: 100%;"
    >
        <tr>
            <td style="padding-top: 20px; padding-left: 30px; padding-right: 30px;">
                <table
                    border="0"
                    cellpadding="0"
                    cellspacing="0"
                    style="width: 100%;"
                >
                    <tr>
                        <td style="padding-top: 12px; padding-bottom: 12px;">
                            <img src="https://i.postimg.cc/4N4cwwcQ/logo-black-png.png" alt="logo" height="35" draggable="false" />
                        </td>
                        <td style="padding-top: 12px; padding-bottom: 12px;">
                            <h1
                                align="right"
                                style="text-align: right; font-family: 'Poppins', sans-serif; margin: 0;"
                            >
                            Invoice
                            </h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 30px; padding-right: 30px;">
                <table
                    border="0"
                    cellpadding="0"
                    cellspacing="0"
                    style="width: 100%;"
                >
                    <tr>
                        <td style="padding-top: 12px; padding-bottom: 12px; border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                            <p
                                style="font-family: 'Poppins', sans-serif;"
                            >
                                <strong>Date:</strong> {{ Carbon\Carbon::now() }}
                            </p>
                        </td>
                        <td style="padding-top: 12px; padding-bottom: 12px; border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                            <p
                                align="right"
                                style="text-align: right; font-family: 'Poppins', sans-serif;"
                            >
                                <strong>Invoice No:</strong> {{ $order_id }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 30px; padding-right: 30px;">
                <table
                    border="0"
                    cellpadding="0"
                    cellspacing="0"
                    style="width: 100%;"
                >
                    <tr>
                        <td style="padding-top: 20px; padding-bottom: 20px;">
                            <p
                                style="font-family: 'Poppins', sans-serif; line-height: 1.2;"
                            >
                                <strong style="display: block; margin-bottom: 5px;">Invoice From:</strong>
                                TeeSpace <br />
                                3665 Paseo Place, Suite 0960 San Diego <br />
                                +02 036 038 3996 <br />
                                hello@teespace.io
                            </p>
                        </td>
                        <td style="padding-top: 20px; padding-bottom: 20px;">
                            <p
                                align="right"
                                style="text-align: right; font-family: 'Poppins', sans-serif; line-height: 1.2;"
                            >
                                @php
                                    $charge = App\Models\Order::where('order_id', $order_id)->first()->charge;
                                    $discount = App\Models\Order::where('order_id', $order_id)->first()->discount;
                                    $billing = App\Models\Billing::where('order_id', $order_id)->first();
                                    $products = App\Models\OrderProduct::where('order_id', $order_id)->get();
                                    $sub_total = 0;
                                @endphp
                                <strong style="display: block; margin-bottom: 5px;">Pay To:</strong>
                                {{ $billing->fname ?? '' }} <br />
                                {{ $billing->company ?? '' }} <br />
                                {{ $billing->rel_to_city->name ?? '' }}, {{ $billing->rel_to_city->state_code ?? '' }} {{ $billing->zip ?? '' }} <br />
                                {{ $billing->email ?? '' }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 30px; padding-right: 30px;">
                <table
                    border="0"
                    cellpadding="0"
                    cellspacing="0"
                    style="width: 100%; border: 1px solid #dee2e6;"
                >
                    <thead>
                        <tr>
                            <th bgcolor="#f8f9fa" align="left" style="white-space: nowrap; padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">Item</th>
                            <th bgcolor="#f8f9fa" align="left" style="white-space: nowrap; padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;"></th>
                            <th bgcolor="#f8f9fa" style="white-space: nowrap; padding: 12px; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">Rate</th>
                            <th bgcolor="#f8f9fa" style="white-space: nowrap; padding: 12px; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">QTY</th>
                            <th bgcolor="#f8f9fa" align="right" style="white-space: nowrap; padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                          <tr>
                              <td align="left" style="padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $product->rel_to_product->product_name }}</td>
                              <td align="left" style="padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;"></td>
                            <td align="center" style="padding: 12px; text-align: center; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">${{ $product->price }}</td>
                            <td align="center" style="padding: 12px; text-align: center; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">{{ $product->quantity }}</td>
                            <td align="right" style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">${{ $product->price * $product->quantity }}</td>
                          </tr>
                          @php
                            $sub_total += $product->price * $product->quantity ;
                          @endphp
                        @endforeach                        
                        {{-- <tr>
                            <td align="left" style="padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">Development</td>
                            <td align="left" style="padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; font-size: 14px;">Website Development</td>
                            <td align="center" style="padding: 12px; text-align: center; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">$120.00</td>
                            <td align="center" style="padding: 12px; text-align: center; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">10</td>
                            <td align="right" style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">$1200.00</td>
                        </tr>
                        <tr>
                            <td align="left" style="padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">SEO</td>
                            <td align="left" style="padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; font-size: 14px;">Optimize the site for search engines (SEO)</td>
                            <td align="center" style="padding: 12px; text-align: center; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">$450.00</td>
                            <td align="center" style="padding: 12px; text-align: center; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">1</td>
                            <td align="right" style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">$450.00</td>
                        </tr> --}}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="3" style="padding: 12px; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;"></td>
                            <td bgcolor="#f8f9fa" align="right" style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Sub Total:</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right" style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">${{ $sub_total }}</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="3" style="padding: 12px; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;"></td>
                            <td bgcolor="#f8f9fa" align="right" style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Charge:</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right" style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">${{ $charge ?? 00 }}</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="3" style="padding: 12px; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;"></td>
                            <td bgcolor="#f8f9fa" align="right" style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Discount:</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right" style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">${{ $discount ?? 00 }}</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="3" style="padding: 12px; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;"></td>
                            <td bgcolor="#f8f9fa" align="right" style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Total:</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right" style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">${{ ($sub_total + $charge) - ($discount ?? 0)  }}</td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>