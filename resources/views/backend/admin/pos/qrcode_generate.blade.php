@extends('layouts.backend.master')

@section('title', 'Product')

@push('css')
<style type="text/css">
	.caption{
	    text-align: center;
	    font-size: 8px;
	}
</style>
@endpush

@section('content')

	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">
						<a href="{{ route('admin.pos.bar_qr')}}" calss="btn" ><i class="fa fa-mail-reply"></i></a>
						QRcode Generate
						<a href="#" onclick="printDiv('printableArea')">
							<i class="ace-icon bigger-120 fa fa-print"></i>
						</a>
					</h4>
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
						
						<div class="table-content" id="printableArea">
							<table id="" class="table table-condensed table-bordered" role="grid" aria-describedby="dynamic-table_info">
								<tbody class="" >
									<tr>
										{{--@for($i = 0 ; $i<$product->now_stock; $i++)
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br/>
											        <span>tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										@endfor--}}
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail">
										      	  
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail">
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
										<td>
											<div class="thumbnail"> 
										        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product->id, 'QRCODE')}}" alt="barcode" />
										        <div class="caption">
										        	<span>{{$product->product->product_name}}</span> <br>
											        <span>Part: {{$product->model_no}}</span><br>
											        <span>,tk: {{$product->sale_price}}</span>
										        </div>
										    </div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('js')
<script>

	/*---------print section-------------*/
	function printDiv(divName) {
		 var printContents = document.getElementById(divName).innerHTML;
		 var originalContents = document.body.innerHTML;

		 document.body.innerHTML = printContents;

		 window.print();

		 document.body.innerHTML = originalContents;
		}
	</script>
@endpush									