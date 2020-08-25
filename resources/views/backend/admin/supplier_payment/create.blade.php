@extends('layouts.backend.master')

@section('title', 'Payment')

@push('css')

	<!-- date Calender-->
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/examples.css') }}" type="text/css">
@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-8">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Supplier Payment List</h4>
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
						
						<div class="row search-section text-center">
							<h3>Supplier Name: {{$pd->supplier_name}}</h3> 
							<p>Phone: {{$pd->phone}}</p>
							<p>Email: {{$pd->email}}</p>
							<p>Address: {{$pd->address}}</p>
						</div>
						<div class="table-content">
							<table id="" class="table table-bordered" role="grid" aria-describedby="dynamic-table_info">
								<thead>
									<tr>
										<th>SL</th>
										<th>Purchase Date</th>
										<th>Clalan No</th>
										<th>Total</th>
										<th>Payment</th>
										<th>Due</th>
									</tr>
								</thead>
								<tbody>

									@php
										$due_total = 0;
									@endphp
									@foreach($purchases as $key=>$pay)
										@php
											$due_total = $due_total + $pay->due_amount;
										@endphp
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{date('d-m-Y',strtotime($pay->purchase_date))}}</td>
											<td>{{$pay->chalan_no}}</td>
											<td>{{$pay->net_purchase_price}}</td>
											<td>{{$pay->payment}}</td>
											<td>{{$pay->due_amount}}</td>
										</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th>Total Due: </th>
										<th>{{$due_total}}</th>
									</tr>
								</tfoot>
							</table>
							<div class="text-center">
								<form action="{{route('admin.account.spstore')}}"  class="form-horizontal" role="form" method="Post">
									@csrf
									<input type="hidden" name="supplier_id" value="{{$pd->id}}">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Payment Date <span class='red'>*</span></label>
										<div class="col-sm-9">
											<input id="datepicker" type="text" name="pay_date"  class="form-control" data-zdp_readonly_element="true" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy" >
											<p class="error-sms">{{ $errors->first('pay_date') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Payment Amount <span class='red'>*</span></label>
										<div class="col-sm-9">
											<input id="" type="text" name="amount"  class="form-control"  value="{{ old('amount')}}" placeholder="xxxx">
											<p class="error-sms">{{ $errors->first('amount') }}</p>
										</div>
									</div>
									<!--<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Discount Amount</label>
										<div class="col-sm-9">
											<input id="" type="text" name="discount"  class="form-control"  value="{{ old('discount')}}" placeholder="xxxx">
											<p class="error-sms">{{ $errors->first('discount') }}</p>
										</div>
									</div>-->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Note </label>
										<div class="col-sm-9">
											<input id="" type="text" name="note"  class="form-control"  value="{{ old('note')}}" placeholder="Say somothing about payment">
											<p class="error-sms">{{ $errors->first('note') }}</p>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
										  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
										  <button type="submit" class="btn btn-xs btn-success">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Search Supplier</h4>
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
						<form action="{{route('admin.account.spsearch')}}" method="post" class="form-horizontal" role="form" >
							@csrf
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Supplier <span class='red'>*</span></label>
								<div class="col-sm-9">
									<select name="supplier_name"  class="form-control select2">
										<option value="">-Select Supplier-</option>
										@foreach($suppliers as $sup)
											<option value="{{$sup->id}}" {{$sup->id == old('supplier_name') ? 'selected' : ''}}>{{$sup->supplier_name}} ({{$sup->total_due}})</option>
										@endforeach
									</select> 
									<p class="error-sms">{{ $errors->first('supplier_name') }}</p>
								</div>
							</div>
							<!--<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Phone No* </label>
								<div class="col-sm-9">
									<input type="text" id="form-field-1-1" name="phone" value="{{old('phone')}}" placeholder="Supplier Phone No" class="form-control">
									<p class="error-sms">{{ $errors->first('phone') }}</p>
								</div>
							</div>-->

							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
								  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
								  <button type="submit" class="btn btn-xs btn-success">Search</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('js')
	
	<!-- Jquery Plugin For Date Calender-->
	<script type="text/javascript" src="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.src.js') }}"></script>
<script>
	$(document).ready(function(){
		$('#datepicker').Zebra_DatePicker({
			format: 'd-m-Y',
			direction:1,
		});
		// select2 section
		$('.select2').select2()	;

		 // search section
		/* $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		  //
		  $("#show").on("change",function(){
			$("#searchForm").submit(); 
		  })*/
	})
	</script>
@endpush									