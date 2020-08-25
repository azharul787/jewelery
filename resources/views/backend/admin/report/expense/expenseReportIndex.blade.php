@extends('layouts.backend.master')

@section('title', 'Expense Report List')

@push('css')
<!-- bootstrap-datetimepicker -->
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/examples.css') }}" type="text/css">
	<style>
		#search-btn{
			margin-top:24px;
		}
		/*thead{
			font-size: 11px;
		}
		tbody{
			font-size: 11px;
		}*/
	</style>
@endpush
@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title"> Expense Report</h4>
					<span class="widget-toolbar">
						<a href="#" data-action="settings">
							<i class="ace-icon fa fa-cog"></i>
						</a>
						<a href="#" data-action="reload">
							<i class="ace-icon fa fa-refresh"></i>
						</a>
						<a href="#" data-action="collapse">
							<i class="ace-icon fa fa-chevron-up"></i>
						</a>
						<a href="#" data-action="close">
							<i class="ace-icon fa fa-times"></i>
						</a>
					</span>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<form id="demo-form2" action="{{ route('admin.report.expenseReportSearch')}}" method="post" data-parsley-validate class="form" enctype="multipart/form-data" >
							@csrf
							@method('PUT')
							<div class="row">
								<div class="col-sm-2"></div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>Expense Type *</label>
										<select name="type_id" id="branch_id" class="form-control select2">
											<option value="All">All</option>
											@foreach($expensetype as $expensetype)
												<option value="{{ $expensetype->id}}">{{ $expensetype->type_name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>From</label>
										<input id="datepicker-range-start" type="text" name="from_date"  class="form-control" data-zdp_readonly_element="false">
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>To</label>
										<input id="datepicker-range-end" type="text" name="to_date"  class="form-control" data-zdp_readonly_element="false">
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<button class="btn btn-grey btn-xs" id="search-btn">
											<i class="ace-icon fa fa-search fa-2x icon-only"></i>
										</button>
									</div>
								</div>
								<div class="col-sm-2">
									<a href="#" id="search-btn" class="btn btn-xs" onclick="printDiv('printableArea')">
										<i class="ace-icon fa fa-print fa-2x icon-only"></i>
									</a>
								</div>
							</div>
						</form>
						<hr/>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_content" id="printableArea">
									<div class="row">
										<div class="col-xs-12 col-sm-12">
										@if($expenses != '')
											<div class="row">
												<div class="col-xs-1"></div>
												<div class="col-xs-1">
													<img src="{{ asset('storage/about/'.$about->logo)}}" class="img-responsive img-thumbnail" alt="logo" width="85px" height="75px" >
												</div>
												<div class="col-xs-8">
													<div class="text-center">
														<h4>{{$about->english_name}}</h4>
														<p>Expense Type: {{$ty}}</p>
														<p>From: {{ date("d-m-Y", strtotime($from))}} - {{ date("d-m-Y", strtotime($to))}}</p>
													</div>
												</div>
												<div class="col-xs-2"></div>
											</div>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>SL</th>
														<th>Date</th>
														<th>Purpose</th>
														<th>Description</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													@php
														$total = 0;
													@endphp
												@foreach($expenses as $key=>$expenses)
													@php
														$total = $total + $expenses->expense_amount;
													@endphp
													<tr>
														<td>{{ $key + 1}}</td>
														<td>{{ date("d-m-Y", strtotime($expenses->expense_date))}}</td>
														
														<td>{{ $expenses->expensetype->type_name}}</td>
														<td>{{ $expenses->description}}</td>
														<td>{{ $expenses->expense_amount}}</td>
													</tr>
												@endforeach
													<tr>
														<th colspan="3"></th>
														<th>Total=</th>
														<th>{{$total}}</th>
													</tr>
												</tbody>
											</table>
										@else
											<p align="center">Sory! no data found.</p>
										@endif
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

@push('js')

<!-- Jquery Plugin For Date Calender-->
<script type="text/javascript" src="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.src.js') }}"></script>
<script type="text/javascript" src="{{ asset('myfile/backend/assets/datepicker/examples.js') }}"></script>
<script>
  $(document).ready(function() 
  {
	// select2 section
    $('.select2').select2()	;
	});

  function printDiv(divName) {
		 var printContents = document.getElementById(divName).innerHTML;
		 var originalContents = document.body.innerHTML;

		 document.body.innerHTML = printContents;

		 window.print();

		 document.body.innerHTML = originalContents;
		}
</script>
@endpush
    
 