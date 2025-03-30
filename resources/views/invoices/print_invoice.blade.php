<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


@extends('layouts.master')
@section('css')
    <style>
        body{
            direction: rtl;
        }
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
@endsection
@section('title')
     طباعة الفاتورة
@stop
@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('message.invoices') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                {{ trans('message.Print_the_invoice') }}</span>
            </div>
        </div>

    </div>
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" >
                <div class="card card-invoice" >
                    <div class="card-body" id="print">
                        <div class="invoice-header">
                            <h1 class="invoice-title" style="text-align:left"> {{ trans('message.invoice') }}</h1>
                            <div class="billed-from" style="text-align:left">
                                <h6>Rubex Studios</h6>
                                <p>Adresse<br>
                                    Tel No: 06 00 00 00 00<br>
                                    Email: rubex_studios@gmail.com</p>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            
                            <div class="col-md">
                                <label class="tx-gray-600"> {{ trans('message.Billing_information') }}</label>
                                <p class="invoice-info-row"><span> {{ trans('message.invoice_number') }}</span>
                                    <span>{{ $invoice->invoice_number }}</span></p>
                                <p class="invoice-info-row"><span> {{ trans('message.invoice_date') }}</span>
                                    <span>{{ $invoice->invoice_Date }}</span></p>
                                
                                
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                       
                                        <th class="wd-40p">{{ trans('message.recette') }}</th>
                                        <th class="tx-center">{{ trans('message.price') }} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                        <td class="tx-12">{{ $invoice->product }}</td>
                                        <td class="tx-center">{{ number_format($invoice->amount, 2) . ' Dh ' }}</td>
                                        
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        
                                
                            </div>
                            <button class="btn btn-danger col-md-2  float-left mt-3 mb-1 ml-1 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i> {{ trans('message.Print') }}</button>
                </div>
            </div>
            
        </div>
    </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script> 
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script type="text/javascript">
      function printDiv() {
    var divContent = document.getElementById('print').innerHTML;

    var printWindow = window.open('', '_blank');

    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print</title>');

    var stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
    stylesheets.forEach(function(stylesheet) {
        printWindow.document.write('<link rel="stylesheet" type="text/css" href="' + stylesheet.href + '">');
    });

    var inlineStyles = document.querySelectorAll('style');
    inlineStyles.forEach(function(style) {
        printWindow.document.write('<style>' + style.innerHTML + '</style>');
    });

    printWindow.document.write('</head><body>');
    printWindow.document.write(divContent);
    printWindow.document.write('</body></html>');

    printWindow.document.close();
    printWindow.onload = function() {
        printWindow.print();
        printWindow.close();
    };
}


    
    </script>

@endsection


</body>
</html>