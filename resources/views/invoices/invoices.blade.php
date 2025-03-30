@extends('layouts.master')
@section('title')
الفواتير
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('message.invoices') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('message.List_of_invoices') }} </span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@if (session('success'))
			<div class="alert alert-success" role="alert">
				<button aria-label="Close" class="close" data-dismiss="alert" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
				
				{{ session('success') }}
				</div>
						<!-- row -->
	@endif
	@if (session('delete'))
			<div class="alert alert-danger" role="alert">
				<button aria-label="Close" class="close" data-dismiss="alert" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
				
				{{ session('delete') }}
				</div>
						<!-- row -->
	@endif
				<!-- row -->
				<div class="row">
	

	<div class="col-xl-12">
		<div class="card mg-b-20">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0"><a style="padding: 10px;border-radius: 2px;
						background: #0162e8;
						color: white;
						display: flex;
						justify-content: center;" href="{{route('invoices.create')}}"> {{ trans('message.Add_an_invoice') }}</a>
				   </h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
				</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example2" class="table key-buttons text-md-nowrap">
						<thead>
							<tr>
								<th class="border-bottom-0">#</th>
								<th class="border-bottom-0">{{ trans('message.invoice_number') }} </th>
								<th class="border-bottom-0"> {{ trans('message.invoice_date') }}</th>
								<th class="border-bottom-0"> {{ trans('message.due_date') }}</th>
								<th class="border-bottom-0">{{ trans('message.recette') }}</th>
								<th class="border-bottom-0">{{ trans('message.expenses') }}</th>
								<th class="border-bottom-0">{{ trans('message.price') }}</th>
								<th class="border-bottom-0">{{ trans('message.state') }}</th>
								<th class="border-bottom-0">{{ trans('message.operations') }}</th>
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
								<td>{{$i}}</td>
								<td><a href="{{route('invoices.show',$invoice->id)}}">{{$invoice->invoice_number}}</td>
								<td>{{$invoice->invoice_Date}}</td>
								<td>{{$invoice->Due_date}}</td>
								<td>{{$invoice->product}}</td>

								<td>{{$invoice->section->section_name }} </td>
								<td> {{$invoice->amount . ' ' . trans('message.Mad')  }} </td>
								<td>
								@if ($invoice->Value_Status === 1)
									
								<span class="text-success">{{$invoice->Status}}</td></span>
								@elseif($invoice->Value_Status === 2)
								<span class="text-danger">{{$invoice->Status}}</span>
								@else()
								<span class="text-warning">{{$invoice->Status}}</span>
									
								@endif
								<td>
									<div class="dropdown">
										<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary" data-toggle="dropdown" id="dropdownMenuButton" type="button">{{ trans('message.operations') }}  <i class="fas fa-caret-down ml-1"></i></button>
										<div  class="dropdown-menu tx-13">
											<a class="dropdown-item" href="{{route('invoices.edit',$invoice->id)}}" style="padding: 8px 15px;width:100%;
											
											height:43px;" >{{ trans('message.update') }} </a>
											<a class="dropdown-item" data-effect="effect-slide-in-right" data-toggle="modal" href="#modaldemo{{$invoice->id}}" style="padding: 8px 15px;width:100%;
											
											height:43px;" > {{ trans('message.Update_invoice_status') }}  </a>
											
											
											<form class="dropdown-item" style="display: inline-block;" action="{{route('transformToArchived',$invoice->id)}}" method="post">
												@csrf
												@method('DELETE')
												<button class="dropdown-item" style="padding: 5px; 
												
												border-radius: 5px;height:27px;border: none;width:38.97px" onclick = "return confirm('{{ trans('message.okay_transfer') }}  ')" type="submit"  >
													{{ trans('message.move_to_archive') }}   
												</button>
											</form>	
											<form class="dropdown-item" style="display: inline-block;" action="{{route('invoices.destroy',$invoice->id)}}" method="post">
												@csrf
												@method('DELETE')
												<button class="dropdown-item" style="padding: 5px;
												
												border-radius: 5px;height:27px;border: none;width:38.97px" onclick = "return confirm(' {{ trans('message.delete_invoice') }}     ')" type="submit"  >
													{{ trans('message.delete') }}  
												</button>
											</form>	
												<a class="dropdown-item"   href="{{route('printInvoice',$invoice->id)}}" style="padding: 8px 15px;width:100%;height:43px;" > {{ trans('message.print_the_invoice') }}  </a>
												
										</div>
									</div>
								</td>
							</td>
								<td>{{$invoice->note ? $invoice->note : trans('message.No_notes')  }}  </td>
								
							</tr>
							<div class="modal" id="modaldemo{{$invoice->id}}">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content modal-content-demo">
										<div class="modal-header">
										<div style="display: flex; justify-content: space-between;">
    <h6 class="modal-title"> {{ trans('message.Update_invoice_statuse') }} {{$invoice->invoice_number}}</h6>
    <button style="margin-left:auto;" aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
</div>
										</div>
										<div class="modal-body">
											<form action="{{ route('updateStatus',$invoice->id) }}" method="post" class="mg-b-10" enctype="multipart/form-data"
											autocomplete="off">
											@csrf
											<h5 class="card-title">  {{ trans('message.Update_invoice_statuse') }}</h5>
											<div class="col">
												<label for="inputName" class="control-label"> {{ trans('message.Choose_the_status') }} </label>
												<select id="product" name="value_status" class="form-control">
													<option value="1">{{ trans('message.Paid') }}</option>
													<option value="2"> {{ trans('message.unpaid') }}</option>
													<option value="3">{{ trans('message.processing_paid') }} </option>
												</select>
											</div>
											
					
											<div class="d-flex justify-content-center">
												<button type="submit" class="btn btn-primary"> {{ trans('message.save') }}</button>
											</div>
				
											
									</form></div>
										
									</div>
								</div>
							</div>
							@endforeach
							
						</tbody>
						
					</table>
					<div class="d-flex  mt-4">
        {{ $invoices->links('pagination::bootstrap-4') }}
    </div>
					
				</div>
			</div>
		</div>
	</div>
	<!--/div-->


<!-- /row -->
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

<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>



@endsection



