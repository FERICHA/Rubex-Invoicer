@extends('layouts.master')
@section('title')
 فاتورة
@stop
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
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
							<h4 class="content-title mb-0 my-auto"> {{ trans('message.List_of_invoices') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  {{ trans('message.Invoice_details') }}</span>
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
	
	<!-- row opened -->
	<div class="row row-sm">
		<div class="col-lg-12 col-md-12">
			<div class="card" id="basic-alert">
				<div class="card-body">
								
								
								<div class="text-wrap">
									<div class="example">
										<div class="panel panel-primary tabs-style-1">
											<div class=" tab-menu-heading">
												<div class="tabs-menu1">
													<!-- Tabs -->
													<ul class="nav panel-tabs main-nav-line">
														<li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab"> {{ trans('message.Billing_information') }}</a></li>
														<li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">{{ trans('message.Attachments') }}</a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
												<div class="tab-content">
													<div class="tab-pane active" id="tab1">
														<div class="table-responsive">
															<table id="example2" class="table key-buttons text-md-nowrap">
																<thead>
																	<tr>
																		<th class="border-bottom-0">#</th>
																		<th class="border-bottom-0"> {{ trans('message.invoice_number') }}</th>
																		<th class="border-bottom-0"> {{ trans('message.invoice_date') }}</th>
																		<th class="border-bottom-0"> {{ trans('message.due_date') }}</th>
																		<th class="border-bottom-0">{{ trans('message.recette') }}</th>
																		<th class="border-bottom-0">{{ trans('message.expenses') }}</th>
																		<th class="border-bottom-0">{{ trans('message.price') }} </th>
																		<th class="border-bottom-0">{{ trans('message.state') }}</th>
																		<th class="border-bottom-0">{{ trans('message.notes') }}</th>


											
																	</tr>
																</thead>
																<tbody>
																	
																	<tr>
																		
																		<td>{{1}}</td>
																		<td><a href="{{route('invoices.show',$invoice->id)}}">{{$invoice->invoice_number}}</a></td>
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
																	</td>
																		<td>{{$invoice->note ? $invoice->note : "لا ملاحظات"  }}  </td>
																		
																	</tr>
																	
																	
																</tbody>
															</table>

												</div>
											</div>
													
													<div class="tab-pane" id="tab3">
														<div class="table-responsive">
															
															<table id="example1" class="table key-buttons text-md-nowrap">
																<div class="col-sm-6 col-md-4 col-xl-3 mg-b-10 mg-t-20 mg-sm-t-0">
																<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-slide-in-right" data-toggle="modal" href="#modaldemo8"> {{ trans('message.Add_attachment') }}</a>
															</div>
																<thead>
																	<tr>
																		<th class="border-bottom-0">#</th>
																		<th class="border-bottom-0"> {{ trans('message.file_name') }}</th>
																		<th class="border-bottom-0"> {{ trans('message.Added_by') }}</th>
																		<th class="border-bottom-0"> {{ trans('message.Date_added') }}</th>
																		<th class="border-bottom-0">{{ trans('message.operations') }}</th>
																		
																	</tr>
																</thead>
																<tbody>
																	@php
																		$i = 0 ;
																	@endphp
																	@foreach ($attachments as $attachment)
																	<tr>
																		@php
																			
																			$i++;
																		@endphp
																		<td>{{$i}}</td>
																		<td>{{$attachment->file_name}}</td>
																		<td>{{auth()->user()->name}}</td>
																		<td>{{$attachment->created_at}}</td>
																		<td colspan="2">
																			<a class="btn btn-outline-success btn-sm"
																			href="{{asset('./Attachments/'. $invoice->invoice_number. '/' . $attachment->file_name)}}" target="_blank"
                                                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                            {{ trans('message.Show') }}</a>

                                                                        <a class="btn btn-outline-info btn-sm"
                                                                            href="{{asset('./Attachments/'. $invoice->invoice_number. '/' . $attachment->file_name)}}"
                                                                            role="button" download><i
                                                                                class="fas fa-download"></i>&nbsp;
																				{{ trans('message.download') }}</a>
																			<form action="{{route('invoicesAtt.destroy',$attachment->id)}}" method="POST">
																				@csrf
																				@method('DELETE')
																				<button onclick="return confirm('{{ trans('message.delete_attachment') }}  ')" class="btn btn-outline-danger btn-sm mg-t-5"
                                                                                
                                                                                delete_attachment
                                                                               type="submit">{{ trans('message.delete') }}</button>
																			</form>
																		</td>
																		
																		
																	</tr>
																	@endforeach
																	
																	
																</tbody>
																@if ($errors->any())
																			<div class="alert alert-danger">
																				<ul>
																					@foreach ($errors->all() as $error)
																						<li>{{ $error }}</li>
																					@endforeach
																				</ul>
																			</div>
																			@endif
															</table>
															<!-- Button trigger modal -->
															
															<div class="modal" id="modaldemo8">
																<div class="modal-dialog modal-dialog-centered" role="document">
																	<div class="modal-content modal-content-demo">
																		<div class="modal-header">
																		<h6 class="modal-title"> {{ trans('message.Add_attachment') }} </h6>
    <button style="margin-left:auto;" aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
																		</div>
																		<div class="modal-body">
																			<form action="{{ route('invoicesAtt.store') }}" method="post" class="mg-b-10" enctype="multipart/form-data"
																			autocomplete="off">
																			@csrf
							
												
																		
												
																			<p class="text-danger">*  {{ trans('message.Attachment_format') }} pdf, jpeg ,.jpg , png </p>
																			<h5 class="card-title">{{ trans('message.Attachments') }}</h5>
																			<input type="text" hidden name="id" value="{{$invoice->id}}">
																			<div class="col-sm-12 col-md-12">
																				<input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
																					data-height="70" />
																			</div><br>
													
																			<div class="d-flex justify-content-center">
																				<button type="submit" class="btn btn-primary"> {{ trans('message.save') }}</button>
																			</div>
												
																			
																	</form></div>
																		
																	</div>
																</div>
															</div>
															
												</div>
												
											</div>
												</div>
											</div>
										</div>
									</div>
								

								</div>
							</div>
						</div>
					</div>

					
					

@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
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