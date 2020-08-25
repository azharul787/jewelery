@extends('layouts.backend.master')

@section('title', 'Product')

@push('css')
<style type="text/css">
	.caption{
	    text-align: center;
	    font-size: 8px;
	}
	.thumbnail {
		padding: 5px;
		line-height: 1.42857143;
		background-color: #fff;
		border: 1px solid #ddd;
		border-radius: 4px;
		-webkit-transition: border .2s ease-in-out;
		-o-transition: border .2s ease-in-out;
		transition: border .2s ease-in-out;
	}
	.alert, .thumbnail {
		margin-bottom: 0px;
	}
	.thumbnail a>img, .thumbnail>img {
		margin-left: auto;
		margin-right: auto;
		margin-top: 10px;
	}
	div.thumbnail {
		height: 95px;
		width: 144px;
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
						Barcode Generate
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
						<div class="row">
						<div class="col-xs-2"> 
							<div class="table-content" id="printableArea">
									<table id="" class="table table-condensed table-bordered" role="grid" aria-describedby="dynamic-table_info" style="">
										<tbody class="">
											<tr>
												<td>
													<div class="thumbnail">
														<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->id, 'C39')}}" alt="barcode" style="height:20px"  />
														<div class="caption">
															<span>{{$product->product->product_name}}</span><br>
															<span>Code: {{$product->model_no}},Price: {{$product->sale_price}}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="thumbnail">
														<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->id, 'C39')}}" alt="barcode" style="height:20px"  />
														<div class="caption">
															<span>{{$product->product->product_name}}</span><br>
															<span>Code: {{$product->model_no}},Price: {{$product->sale_price}}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="thumbnail">
														<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->id, 'C39')}}" alt="barcode" style="height:20px"  />
														<div class="caption">
															<span>{{$product->product->product_name}}</span><br>
															<span>Code: {{$product->model_no}},Price: {{$product->sale_price}}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="thumbnail">
														<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->id, 'C39')}}" alt="barcode" style="height:20px"  />
														<div class="caption">
															<span>{{$product->product->product_name}}</span><br>
															<span>Code: {{$product->model_no}},Price: {{$product->sale_price}}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="thumbnail">
														<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->id, 'C39')}}" alt="barcode" style="height:20px"  />
														<div class="caption">
															<span>{{$product->product->product_name}}</span><br>
															<span>Code: {{$product->model_no}},Price: {{$product->sale_price}}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="thumbnail">
														<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->id, 'C39')}}" alt="barcode" style="height:20px"  />
														<div class="caption">
															<span>{{$product->product->product_name}}</span><br>
															<span>Code: {{$product->model_no}},Price: {{$product->sale_price}}</span>
														</div>
													</div>
												</td>
											</tr>
											<!--<tr>
												<td>
													<div class="thumbnail">
														<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->id, 'C39')}}" alt="barcode" style="height:20px"  />
														<div class="caption">
															<span>{{$product->product->product_name}}</span><br>
															<span>Code: {{$product->model_no}},Price: {{$product->sale_price}}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="thumbnail">
														<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->id, 'C39')}}" alt="barcode" style="height:20px"  />
														<div class="caption">
															<span>{{$product->product->product_name}}</span><br>
															<span>Code: {{$product->model_no}},Price: {{$product->sale_price}}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="thumbnail">
														<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->id, 'C39')}}" alt="barcode" style="height:20px"  />
														<div class="caption">
															<span>{{$product->product->product_name}}</span><br>
															<span>Code: {{$product->model_no}},Price: {{$product->sale_price}}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="thumbnail">
														<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->id, 'C39')}}" alt="barcode" style="height:20px"  />
														<div class="caption">
															<span>{{$product->product->product_name}}</span><br>
															<span>Code: {{$product->model_no}},Price: {{$product->sale_price}}</span>
														</div>
													</div>
												</td>
											</tr>-->
										</tbody>
									</table>
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