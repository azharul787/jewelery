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
									
									<a href="{{ route('admin.sale.index')}}" calss="btn" ><i class="fa fa-mail-reply"></i></a>
									Sale Information
								</h3>
								<div class="widget-toolbar no-border invoice-info">
									<span class="invoice-info-label">Invoice:</span>
									<span class="red">#{{$sale->invoice_no}}</span>
									<br>
									<span class="invoice-info-label">Date:</span>
									<span class="blue">{{date('d-m-Y',strtotime($sale->sale_date))}}</span>
								</div>
								<div class="widget-toolbar hidden-480">
									<a href="#" onclick="printDiv('printableArea')">
										<i class="ace-icon fa fa-2x fa-print"></i>
									</a>
								</div>
							</div>
							<div class="widget-body" id="printableArea">
								<div class="widget-main padding-1" >
									<div class="row">
										<div class="col-xs-2">
											<img src="{{asset('storage/about/'.$about->logo)}}" height="120" width="120">
										</div>
										<div class="col-xs-8">
											<div class="text-center">
												<h3>{{$about->english_name}}</h3>
												<p>Phone: {{$about->phone}}</p>
												<p>Email: {{$about->email}}</p>
												<p>Address: {{$about->address}}</p>
											</div>
										</div>
										<div class="col-xs-2"></div>
									</div>
									<br/>
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<div class="row">
												<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
											 		<b>Sale Information</b>
												</div>
											</div>
											<div>
												<ul class="list-unstyled spaced">
		
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Sale Date:</b> {{date('d-m-Y',strtotime($sale->sale_date)) }}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Invoice No: #</b> {{$sale->invoice_no }}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Total Price:</b> {{$sale->total_price }}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Discount:</b> {{$sale->discount }}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Paymant:</b> <b >{{$sale->payment }}</b></li>
													<!--<li class="divider"></li>-->
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Due: </b ><b class="red">{{$sale->due_amount }}</b></li>
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
													<li><i class="ace-icon fa fa-caret-right green"></i><b>Address:</b> {{$sale->customer->customer_address}}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Previous Due: </b ><b class="red">{{$sale->customer->sale->sum('due_amount') - $sale->due_amount}}</b></li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Total Due: </b ><b class="red">{{$sale->customer->sale->sum('due_amount')}} </b></li>
												</ul>
											</div>
										</div><!-- /.col -->
									</div><!-- /.row -->
									<div class="space"></div>
									<div>
										<table class="table table-condensed table-bordered">
											<thead>
												<tr>
													<th class="center">SL</th>
													<th>Product</th>
													<th>Part No</th>
													<th>Warehouse</th>
													<th>Rack</th>
													<th>Brand</th>
													<th>Unit</th>
													<th>Quantity</th>
													<th>Unit Price</th>
													<th>Sub Total</th>
												</tr>
											</thead>
											<tbody>
											@php
												$total = 0;
											@endphp
											@foreach($sale->saleDetail as $key=>$detail)
												@php
													$total = $total + ( $detail->quantity * $detail->unit_price);
												@endphp
												<tr>
													<td class="center">{{$key + 1}}</td>
													<td>{{$detail->product->product_name}}</td>
													<td>{{$detail->purchaseDetail->model_no}}</td>
													<td>{{$detail->warehouse->warehouse_name}}</td>
													<td>{{$detail->rack_no}}</td>
													<td>{{$detail->brand->brand_name}}</td>
													<td>{{$detail->unit->unit_name}}</td>
													<td>{{$detail->quantity}}</td>
													<td>{{$detail->unit_price}}</td>
													<td>{{$detail->quantity * $detail->unit_price}}</td>
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
										<!--<div class="col-sm-7 pull-left"> 
											Previous Due: <b class="red">{{$sale->customer->sale->sum('due_amount')}} </b>
											<br/>
											Total Due: <b class="red">{{$sale->customer->sale->sum('due_amount') + $sale->due_amount}} </b>
										</div>-->
									</div>
									<div class="space-6"></div>
									<div class="">
										<b>In Word:</b> {{Terbilang::make($total,'Taka Only')}}.
									</div>
									<div class="row">
										<div class="col-sm-12">Note: {{$sale->note}}</div>
									</div>
									<hr/>
									<div class="text-center">
										<small>
											Thank you for choosing our Company products.We believe you will be satisfied by our services.
										</small>
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