@extends('layouts.backend.master')

@section('title', 'Purchase')

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
									
									<a href="{{ route('admin.purchase.index')}}" calss="btn" ><i class="fa fa-mail-reply"></i></a>
									Purchase Information
								</h3>
								<div class="widget-toolbar no-border invoice-info">
									<span class="invoice-info-label">Invoice:</span>
									<span class="red">#{{$purchase->chalan_no}}</span>
									<br>
									<span class="invoice-info-label">Date:</span>
									<span class="blue">{{date('d-m-Y',strtotime($purchase->purchase_date))}}</span>
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
											 		<b>Purchase Info</b>
												</div>
											</div>
											<div>
												<ul class="list-unstyled spaced">
		
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Purchase Date:</b> {{date('d-m-Y',strtotime($purchase->purchase_date)) }}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Chalan No: #</b> {{$purchase->chalan_no }}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Purchase Price:</b> {{$purchase->net_purchase_price }}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Discount:</b> {{$purchase->discount }}</li>
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Paymant:</b> <b class="red">{{$purchase->payment }}</b></li>
													<!--<li class="divider"></li>-->
													<li><i class="ace-icon fa fa-caret-right blue"></i><b>Due: </b>{{$purchase->due_amount }}</li>
												</ul>
											</div>
										</div><!-- /.col -->
										<div class="col-sm-6 col-xs-6">
											<div class="row">
												<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
													<b>Supplier Info</b>
												</div>
											</div>
											<div>
												<ul class="list-unstyled  spaced">
													<li><i class="ace-icon fa fa-caret-right green"></i><b>Name:</b> {{$purchase->supplier->supplier_name}}</li>
													<li><i class="ace-icon fa fa-caret-right green"></i><b>Phone:</b> {{$purchase->supplier->phone}}</li>
													<li><i class="ace-icon fa fa-caret-right green"></i><b>Email:</b> {{$purchase->supplier->email}}</li>
													<li class="divider"></li>
													<li><i class="ace-icon fa fa-caret-right green"></i><b>Address:</b> {{$purchase->supplier->address}}</li>
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
													<th>Code</th>
													<th>Category</th>
													<th>Brand</th>
													<th>Type</th>
													<th>Quantity</th>
													<th>Now Stock</th>
													<th>P.Price</th>
												</tr>
											</thead>
											<tbody>
											@php
												$total = 0;
											@endphp
											@foreach($purchase->details as $key=>$detail)
											@php
												$total = $total + $detail->purchase_price;
											@endphp
												<tr>
													<td class="center">{{$key + 1}}</td>
													<td>{{$detail->product->product_name}}</td>
													<td>{{$detail->code_no}}</td>
													<td>{{$detail->category->category_name}}</td>
													<td>{{$detail->brand->brand_name}}</td>
													<td>{{$detail->type->type_name}}</td>
													<td>{{$detail->quantity}}</td>
													<td>{{$detail->now_stock}}</td>
													<td>{{$detail->purchase_price}}</td>
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
										<div class="col-sm-7 pull-left"> Note: {{$purchase->note}} </div>
									</div>
									<div class="space-6"></div>
									<div class="well">
										<b>In Word:</b> {{Terbilang::make($total,'Taka Only')}}.
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