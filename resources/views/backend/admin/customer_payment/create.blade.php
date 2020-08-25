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
					<h4 class="widget-title">Customer Payment List</h4>
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
							<h3>{{$cs->customer_name}}</h3> 
							<p>{{$cs->customer_phone}}</p>
							<p>{{$cs->customer_email}}</p>
							<p>{{$cs->distric->distric_name}}, {{$cs->upozila->upozila_name}},{{$cs->union->union_name}},{{$cs->customer_address}}</p>
						</div>
						<div class="table-content">
							<table id="" class="table table-bordered" role="grid" aria-describedby="dynamic-table_info">
								<thead>
									<tr>
										<th>SL</th>
										<th>Sale Date</th>
										<th>Invoice No</th>
										<th>Total</th>
										<th>Payment</th>
										<th>Due</th>
									</tr>
								</thead>
								<tbody>

									@php
										$due_total = 0;
									@endphp
									@foreach($sales as $key=>$pay)
										@php
											$due_total = $due_total + $pay->due_amount;
										@endphp
										<tr>
											<td>{{$key + 1}}</td>
											<td>{{date('d-m-Y',strtotime($pay->sale_date))}}</td>
											<td>{{$pay->invoice_no}}</td>
											<td>{{$pay->grand_total_price}}</td>
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
								<form action="{{route('admin.account.cpstore')}}"  class="form-horizontal" role="form" method="Post">
									@csrf
									<input type="hidden" name="customer_id" value="{{$cs->id}}">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Payment Date <span class='red'>*</span></label>
										<div class="col-sm-9">
											<input id="datepicker" type="text" name="pay_date"  class="form-control input-sm" data-zdp_readonly_element="true" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy" >
											<p class="error-sms">{{ $errors->first('pay_date') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Payment Amount <span class='red'>*</span></label>
										<div class="col-sm-7">
											<input id="payment" type="text" name="payment"  class="form-control input-sm"  value="{{ old('amount')}}" placeholder="xxxx">
											<p class="error-sms">{{ $errors->first('payment') }}</p>
										</div>
										<div class="col-sm-2">
											<button type="button" id="discount" class="btn btn-xs btn-info">Discount</button>
										</div>
									</div>
									<div class="form-group" id="dis_content" style="display: none">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Discount </label>
										<div class="col-sm-4">
											<input id="discount_amount" type="text" name="discount"  class="form-control input-sm"  value="{{ old('discount')}}" placeholder="Discount Amount">
											<p class="error-sms">{{ $errors->first('discount') }}</p>
										</div>
										<div class="col-sm-5">
											<select name="type_name"  class="form-control input-sm select">
												<option value="">-Select Type-</option>
												@foreach($types as $ty)
													<option value="{{$ty->id}}" {{$ty->type_name == 'Customer Discount' ? 'selected' : ''}}>{{$ty->type_name}}</option>
												@endforeach
											</select> 
											<p class="error-sms">{{ $errors->first('type_name') }}</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Total Payment <span class='red'>*</span></label>
										<div class="col-sm-9">
											<input id="total_payment" type="text" name="total_payment" class="form-control input-sm" readonly="" value="{{ old('total_payment')}}" placeholder="xxxx">
											<p class="error-sms">{{ $errors->first('total_payment') }}</p>
										</div>
									</div>
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
					<h4 class="widget-title">Search Customer Sale</h4>
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
						<form action="{{route('admin.account.cpsearch')}}" method="post" class="form-horizontal" role="form" >
							@csrf
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Customer <span class='red'>*</span></label>
								<div class="col-sm-8">
									<select name="customer_name"  class="form-control select2">
										<option value="">- Select Customer -</option>
										@foreach($customers as $cus)
											<option value="{{$cus->id}}" {{$cus->id == old('customer_name') ? 'selected' : ''}}>{{$cus->customer_name}} ({{$cus->total_due}})</option>
										@endforeach
									</select>
									<p class="error-sms">{{ $errors->first('supplier_name') }}</p>
								</div>
							</div>
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
		$('.select2').select2();
	})
	$(document).on('click','#discount',function(){
		$('#dis_content').toggle('show');
	})
	$(document).on('keyup','#payment',function(){

		total_payment();
	})
	$(document).on('keyup','#discount_amount',function(){
		//alert($(this).val())
		total_payment();
	})
	function total_payment(){
		var payment = $('#payment').val() || 0;
		var discount = $('#discount_amount').val() || 0;
		$('#total_payment').val(parseInt(payment)+parseInt(discount))
	}
	</script>
@endpush									