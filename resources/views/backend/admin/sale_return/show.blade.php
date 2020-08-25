@extends('layouts.backend.master')

@section('title', 'Sale')

@push('css')

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="space-6"></div>
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="widget-box transparent">
							<div class="widget-header widget-header-large">
								<h3 class="widget-title grey lighter">
									
									<a href="{{ route('admin.sale_return.index')}}" calss="btn" ><i class="fa fa-mail-reply"></i></a>
									Sale Return Information
								</h3>
								<div class="widget-toolbar no-border invoice-info">
									<span class="invoice-info-label">Invoice:</span>
									<span class="red">#{{$sale->chalan_no}}</span>
									<br>
									<span class="invoice-info-label">Date:</span>
									<span class="blue">{{date('d-m-Y',strtotime($sale->sale_date))}}</span>
								</div>
								<div class="widget-toolbar hidden-480">
									<a href="#" onclick="printDiv('printableArea')">
										<i class="ace-icon fa fa-print"></i>
									</a>
								</div>
							</div>
							<div class="widget-body" id="printableArea">
								<div class="widget-main padding-24">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<div class="row">
												<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
											 		<b>Sale Info</b>
												</div>
											</div>
											<div>
												<ul class="list-unstyled spaced">
		
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Return Date:</b> {{date('d-m-Y',strtotime($sale->return_date)) }}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Invoice No: #</b> {{$sale->invoice_no }}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Total Price:</b> {{$sale->total_price }}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Discount:</b> {{$sale->discount }}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Paymant:</b> <b class="red">{{$sale->payment }}</b></li>
													<!--<li class="divider"></li>-->
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Due: </b>{{$sale->due_amount }}</li>
												</ul>
											</div>
										</div><!-- /.col -->
										<div class="col-sm-6 col-xs-6">
											<div class="row">
												<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
													<b>Customer Info</b>
												</div>
											</div>
											<div>
												<ul class="list-unstyled  spaced">
													<li><i class="ace-icon fa fa-caret-right green"></i><b>Name:</b> {{$sale->customer->customer_name}}</li>
													<li><i class="ace-icon fa fa-caret-right green"></i><b>Phone:</b> {{$sale->customer->customer_phone}}</li>
													<li><i class="ace-icon fa fa-caret-right green"></i><b>Address:</b> {{$sale->customer->address}}</li>
												</ul>
											</div>
										</div><!-- /.col -->
									</div><!-- /.row -->
									<div class="space"></div>
									<div>
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th class="center">SL</th>
													<th>Product</th>
													<th>Part No</th>
													<th>Category</th>
													<th>warehouse</th>
													<th>Rack No</th>
													<th>Quantity</th>
													<th>Sold.Price</th>
													<th>R.Price</th>
												</tr>
											</thead>
											<tbody>
											@php
												$total = 0;
											@endphp
											@foreach($sale->returnDetail as $key=>$detail)
												@php
													$total = $total + $detail->return_price;
												@endphp
												<tr>
													<td class="center">{{$key + 1}}</td>
													<td>{{$detail->product->product_name}}</td>
													<td>{{$detail->model_no}}</td>
													<td>{{$detail->category->category_name}}</td>
													<td>{{$detail->warehouse->warehouse_name}}</td>
													<td>{{$detail->rack_no}}</td>
													<td>{{$detail->quantity}}</td>
													<td>{{$detail->saleDetail->unit_price}}</td>
													<td>{{$detail->return_price}}</td>
												</tr>
											@endforeach
											</tbody>
										</table>
									</div>
									<div class="hr hr8 hr-double hr-dotted"></div>
									<div class="row">
										<div class="col-sm-5 pull-right">
											<h4 class="pull-right">
												Total amount :
												<span class="red">{{$total}}</span>
											</h4>
										</div>
										<div class="col-sm-7 pull-left"> Note: {{$sale->note}} </div>
									</div>
									<div class="space-6"></div>
									<div class="well">
										Thank you for choosing our Company products.We believe you will be satisfied by our services.
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
		<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div>
@endsection

@push('js')
<script>
	$(document).ready(function(){

	})
	 function printDiv(divName) {
		 var printContents = document.getElementById(divName).innerHTML;
		 var originalContents = document.body.innerHTML;

		 document.body.innerHTML = printContents;

		 window.print();

		 document.body.innerHTML = originalContents;
		}

	</script>
@endpush									