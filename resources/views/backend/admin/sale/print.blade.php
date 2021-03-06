<!DOCTYPE html>
<html>
<head>
	<title>Invoice Print</title>
	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/css/bootstrap.min.css') }}" />
	<!-- ace styles -->
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
	<style>
		table,p,h3,h4{
			font-size:9px;
		}
		li{font-size:9px;}
		.text-center{font-size:9px;}
		.word{
			font-size:9px;
		}
		.table-condensed>tbody>tr>td, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>td, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>thead>tr>th {
			padding: 1px;
		}
	</style>
</head>
<body>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box transparent">
				<div class="widget-body" id="printableArea">
					<div class="widget-main padding-" style="width:80%">
						<div class="row">
							<div class="col-xs-12">
								<div class="text-center">
									<b>{{$about->english_name}}</b><br/>
									Phone: {{$about->phone}}<br/>
									Email: {{$about->email}}<br/>
									Address: {{$about->address}}<br/>
								</div>
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-xs-6">
								<div>
									<ul class="list-unstyled ">
										<li><i class="ace-icon fa fa-caret-right blue"></i><b>Sale Date:</b> {{date('d-m-Y',strtotime($sale->sale_date)) }}</li>
										<li><i class="ace-icon fa fa-caret-right blue"></i><b>Invoice No: #</b> {{$sale->invoice_no }}</li>
										<li><i class="ace-icon fa fa-caret-right green"></i><b>Name:</b> {{$sale->customer->customer_name}}</li>
										<li><i class="ace-icon fa fa-caret-right green"></i><b>Phone:</b> {{$sale->customer->customer_phone}}</li>
									</ul>
								</div>
							</div>
							<div class="col-xs-6">
								<div>
									<ul class="list-unstyled ">
										<li><i class="ace-icon fa fa-caret-right blue"></i><b>Total Price:</b> {{$sale->total_price }}</li>
										<li><i class="ace-icon fa fa-caret-right blue"></i><b>Discount:</b> {{$sale->discount }}</li>
										<li><i class="ace-icon fa fa-caret-right blue"></i><b>Paymant:</b> <b >{{$sale->payment }}</b></li>
										<li><i class="ace-icon fa fa-caret-right blue"></i><b>Due: </b ><b class="red">{{$sale->due_amount }}</b></li>
									</ul>
								</div>
							</div>
						</div>
						<div>
						<div class="table-responsive">
							<table class="table table-condensed table-bordered" >
								<thead>
									<tr>
										<th class="center">SL</th>
										<th>Product</th>
										<th>Model</th>
										<th>Qty</th>
										<th>Rate</th>
										<th>Total</th>
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
										<td>{{$detail->quantity}}</td>
										<td>{{$detail->unit_price}}</td>
										<td>{{$detail->quantity * $detail->unit_price}}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						</div>
						<!--<div class="hr hr8 hr-double hr-dotted"></div>-->
						<div class="row">
							<div class="col-xs-12 pull-right">
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
						<div class="space-"></div>
						<div class="word">
							<b>In Word:</b> {{Terbilang::make($total,'Taka Only')}}.
						</div>
						
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
		
    <script type="text/javascript">
    	function printDiv(divName) {
		 var printContents = document.getElementById(divName).innerHTML;
		 var originalContents = document.body.innerHTML;

		 document.body.innerHTML = printContents;

		 window.print();

		 document.body.innerHTML = originalContents;
		}
    </script>
</body>
</html>
	


  
</script>

    
 