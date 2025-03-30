@extends('layouts.master')
@section('title')
الاقسام
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('message.product') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  {{ trans('message.List_of_recipes') }}</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
	
	<!-- row -->
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card">
				<div class="card-body">
					<form action="{{route('products.update',$product->id)}}" class="parsley-style-1" id="selectForm2" name="selectForm2" method="post">
						@csrf
						@method('PUT')
						<div class="">
							<div class="row mg-b-20">
								<div class="parsley-input col-md-6" id="fnWrapper">
									<label> {{ trans('message.Recipe_name') }}<span class="tx-danger">&nbsp; *</span></label>
									<input value="{{$product->product_name}}" class="form-control" data-parsley-class-handler="#fnWrapper" name="product_name"   type="text">
								</div>
								<div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
									<label>{{ trans('message.description') }}<span class="tx-danger">&nbsp; *</span></label>
									<textarea style="height: 40px" class="form-control" data-parsley-class-handler="#lnWrapper" name="product_desc"   type="text">{{$product->product_desc}}</textarea>
									
								</div>
								<div class="parsley-input col-md-12 mg-t-20 mg-md-t-0" id="lnWrapper">
									<label>{{ trans('message.expense_name') }}<span class="tx-danger">&nbsp; *</span></label>
									<select name="section_id" class="form-control SlectBox" >
										
									@foreach ($sections as $section)
									@if ($section->id == $product->section_id)
									<option value="{{$section->id}}" selected>{{$section->section_name}}</option>
									
									@else
									
									<option value="{{$section->id}}" >{{$section->section_name}}</option>
									@endif
									@endforeach
									</select>
								</div>
								
							</div>
						</div>
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif
						<div class="mg-t-30">
							<button class="btn btn-main-primary pd-x-20" type="submit">{{ trans('message.save') }}</button>
						</div>
					</form>
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
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection