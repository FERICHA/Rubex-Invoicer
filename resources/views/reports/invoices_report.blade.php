@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@section('title')
    تقرير الفواتير     
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('message.Reports') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('message.Billing_report') }}
                </span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card mg-b-20">


            <div class="card-header pb-0">

            <form action="{{ route('Search_invoices') }}" method="POST" role="search" autocomplete="off">
    @csrf

    <div class="row">
        <div class="col-lg-3">
            <label class="rdiobox">
                <input checked name="rdio" type="radio" value="1" id="type_div">
                <span>{{ trans('message.Recherche_par_dates') }}</span>
            </label>
        </div>
        <div class="col-lg-3">
            <label class="rdiobox">
                <input name="rdio" value="2" type="radio" id="invoice_div">
                <span>{{ trans('message.Search_by_invoice_number') }}</span>
            </label>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Recherche par plage de dates -->
        <div class="col-lg-3" id="start_at">
            <label>{{ trans('message.from_date') }}</label>
            <input class="form-control fc-datepicker" name="start_at" placeholder="YYYY-MM-DD" type="text" style="width:250px;">
        </div>
        
        
        
    </div>
    <div class="row mt-4">
    <div class="col-lg-3" id="end_at">
            <label>{{ trans('message.Until_date') }}</</label>
            <input class="form-control fc-datepicker" name="end_at" placeholder="YYYY-MM-DD" type="text" style="width:250px;">
        </div>

    </div>

    <div class="row">
    <div class="col-lg-3" id="invoice_number" style="display: none;">
            <label>Numéro de facture</label>
            <input type="text" class="form-control" name="invoice_number" style="width:250px;">
        </div>
    </div>

    <div class="row mt-4">
        
        <div class="col-lg-3">
            <button class="btn btn-primary btn-block" style="width:250px;">{{ trans('message.Search') }}</button>
        </div>
        
    </div>
</form>
<br>
<form action="{{ route('export_invoices') }}" method="POST">
    @csrf
    <!-- Incluez les mêmes critères de recherche que ceux utilisés dans la recherche -->
    <input type="hidden" name="start_at" value="{{ request()->input('start_at') }}">
    <input type="hidden" name="end_at" value="{{ request()->input('end_at') }}">
    <input type="hidden" name="invoice_number" value="{{ request()->input('invoice_number') }}">

    <button class="btn btn-success btn-block" type="submit" style="width:250px;">{{ trans('message.Export_to_CSV') }}</button>
</form>




            </div>
     

            <div class="card-body">
                <div class="table-responsive">
                    @if (isset( $invoices))
                    
                    
                    <table id="example2" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0"> {{ trans('message.invoice_number') }}</th>
                                <th class="border-bottom-0"> {{ trans('message.invoice_date') }}</th>
                                <th class="border-bottom-0"> {{ trans('message.due_date') }}</th>
                                <th class="border-bottom-0">{{ trans('message.recette') }}</th>
                                <th class="border-bottom-0">{{ trans('message.expense_name') }}</th>
                                <th class="border-bottom-0">{{ trans('message.price') }} </th>
                                <th class="border-bottom-0">{{ trans('message.state') }}</th>
                                <th class="border-bottom-0">{{ trans('message.notes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($invoices as $invoice)
                            <tr>
                                @php
                                    $i++;
                                @endphp
                            <tr>
                                
                                <td>{{1}}</td>
                                <td><a href="{{route('invoices.show',$invoice->id)}}">{{$invoice->invoice_number}}</a></td>
                                <td>{{$invoice->invoice_Date}}</td>
                                <td>{{$invoice->Due_date}}</td>
                                <td>{{$invoice->product}}</td>

                                <td>{{$invoice->section->section_name }} </td>
                                <td>{{ $invoice->amount }} {{ trans('message.Mad') }}</td>

                               <td>
                                @if ($invoice->Value_Status === 1)
                                    
                                <span class="text-success">{{$invoice->Status}}</td></span>
                                @elseif($invoice->Value_Status === 2)
                                <span class="text-danger">{{$invoice->Status}}</span>
                                @else()
                                <span class="text-warning">{{$invoice->Status}}</span>
                                    
                                @endif
                            </td>
                                <td>{{$invoice->note ? $invoice->note : trans('message.No_notes')  }} </td>
                                
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
        <tr>
            <td colspan="5"></td>
            <td><strong>Total:</strong></td>
            <td colspan="2"><strong>{{ $totalAmount }} {{ trans('message.Mad') }}</strong></td>
        </tr>
    </tfoot>
                    </table>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<script>
    $(document).ready(function() {
        $('#invoice_number').hide();
        $('input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'type_div') {
                $('#invoice_number').hide();
                $('#type').show();
                $('#start_at').show();
                $('#end_at').show();
            } else {
                $('#invoice_number').show();
                $('#type').hide();
                $('#start_at').hide();
                $('#end_at').hide();
            }
        });
    });
</script>


@endsection 