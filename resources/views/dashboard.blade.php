@extends('layouts.master')  
@section('css')
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<div class="breadcrumb-header justify-content-between">
					<div class="">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ trans('message.statistics') }}
							</h2>
						</div>
					</div>
					
				</div>
@endsection
@section('content')
				<div class="row row-sm">
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ trans('message.total_invoices') }}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{number_format( \App\Models\Invoices::sum('amount')  ,2) }} {{ trans('message.Mad') }}</h4>
											<p class="mb-0 tx-12 text-white op-7">{{\App\Models\Invoices::count() }}</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7">100%</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ trans('message.unpaid_invoices') }}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{number_format( \App\Models\Invoices::where('Value_Status',2)->sum('amount')  ,2) }} {{ trans('message.Mad') }}</h4>
											<p class="mb-0 tx-12 text-white op-7">{{\App\Models\Invoices::where('Value_Status',2)->count()  }}</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											@if (\App\Models\Invoices::where('Value_Status',2)->count() > 0)
											
											<span class="text-white op-7">{{round(\App\Models\Invoices::where('Value_Status',2)->count() / \App\Models\Invoices::count() * 100) }}%</span>
											@endif
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ trans('message.paid_invoices') }}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{number_format( \App\Models\Invoices::where('Value_Status',1)->sum('amount')  ,2) }} {{ trans('message.Mad') }}</h4>
											<p class="mb-0 tx-12 text-white op-7">{{\App\Models\Invoices::where('Value_Status',1)->count() }}</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											@if (\App\Models\Invoices::where('Value_Status',2)->count() > 0)
											<span class="text-white op-7">{{round(\App\Models\Invoices::where('Value_Status',1)->count() / \App\Models\Invoices::count() * 100)}}%</span>
											@endif
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ trans('message.partially_paid_invoices') }}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{number_format( \App\Models\Invoices::where('Value_Status',3)->sum('amount')  ,2) }} {{ trans('message.Mad') }}</h4>
											<p class="mb-0 tx-12 text-white op-7">{{\App\Models\Invoices::where('Value_Status',3)->count() }}</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											@if (\App\Models\Invoices::where('Value_Status',2)->count() > 0)
											<span class="text-white op-7">{{round(\App\Models\Invoices::where('Value_Status',3)->count() / \App\Models\Invoices::count() * 100)}}%</span>
											@endif
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
				</div>
				<!-- row closed -->
				@php
				$count_all =\App\Models\Invoices::count();
      $count_invoices1 = \App\Models\Invoices::where('Value_Status', 1)->count();
      $count_invoices2 = \App\Models\Invoices::where('Value_Status', 2)->count();
      $count_invoices3 = \App\Models\Invoices::where('Value_Status', 3)->count();

      if($count_invoices2 == 0){
          $nspainvoices2=0;
      }
      else{
          $nspainvoices2 = $count_invoices2/ $count_all*100;
      }

        if($count_invoices1 == 0){
            $nspainvoices1=0;
        }
        else{
            $nspainvoices1 = $count_invoices1/ $count_all*100;
        }

        if($count_invoices3 == 0){
            $nspainvoices3=0;
        }
        else{
            $nspainvoices3 = $count_invoices3/ $count_all*100;
        }
					$chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels([
    __('message.unpaid_invoices'), 
    __('message.paid_invoices'), 
    __('message.partially_paid_invoices')
])

->datasets([
    [
        "label" => __('message.unpaid_invoices'),
        'backgroundColor' => ['#ec5858'],
        'data' => [$nspainvoices2]
    ],
    [
        "label" => __('message.paid_invoices'),
        'backgroundColor' => ['#81b214'],
        'data' => [$nspainvoices1]
    ],
    [
        "label" => __('message.partially_paid_invoices'),
        'backgroundColor' => ['#ff9642'],
        'data' => [$nspainvoices3]
    ],
])

            ->options([]);
			$chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
			->labels([
    __('message.unpaid_invoices'), 
    __('message.paid_invoices'), 
    __('message.partially_paid_invoices')
])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214','#ff9642'],
                    'data' => [$nspainvoices2, $nspainvoices1,$nspainvoices3]
                ]
            ])
            ->options([]);
				@endphp
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-md-12 col-lg-12 col-xl-7">
						<div class="card">
							<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mb-0">{{ trans('message.Order_status') }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 text-muted mb-0">{{ trans('message.Order_Status_and_Tracking') }}</p>
							</div>
							<div class="card-body">
					{{-- {!! $chartjs->render() !!} --}}
					<div class="card-body">

						{!! $chartjs->render() !!}
	
					</div>
								
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-xl-5" >
						<div class="card card-dashboard-map-one">
							<label class="main-content-label">{{ trans('message.diag') }}</label>
							<div class="">
								<div >
					{!! $chartjs_2->render() !!}
						</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
				{{-- <div style="width:75%;">
					{!! $chartjs->render() !!}
				</div> --}}
				
				<!-- /row -->
			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>	
@endsection