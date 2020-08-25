@extends('layouts.backend.master')

@section('title', 'Code Generate')

@push('css')
	<style>
		button#btn {
			margin-top: 24px;
		}
	</style>
@endpush
@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Code Generate Stock List</h4>
					<span class="widget-toolbar">
						<a href="#" onclick="printDiv('printableArea')">
							<i class="ace-icon fa fa-print"></i>
						</a>
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
						<div class="row search-section">
							<form action="{{route('admin.stock.stocks')}}" id="searchForm" method="Post">
								@csrf
								@method('PUT')
								<div class="col-sm-3">
									<div class="form-group">
										<label for="form-field-1"> Warehouse</label>
										<select class="form-control input-sm select2" name="warehouse" id="warehouse">
											<option value="All"> All </option>
											@foreach($warehouses as $wr)
												<option value="{{$wr->id}}">{{$wr->warehouse_name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="form-field-1"> Category Name</label>
										<select class="form-control input-sm select2" name="category" id="category">
											<option value="All"> All </option>
											@foreach($categories as $cat)
												<option value="{{$cat->id}}">{{$cat->category_name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="form-field-1"> Brand Name</label>
										<select class="form-control input-sm select2" name="brand" id="brand">
											<option value="All"> All </option>
											@foreach($brands as $br)
												<option value="{{$br->id}}">{{$br->brand_name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="form-field-1">Product/Part No</label>
										<select class="form-control input-sm select2" name="model_no" id="product">
											<option value="All"> All </option>
											
										</select>
									</div>
								</div>
								<!--<div class="col-sm-2">
									<div class="form-group">
										<button class="btn btn-xs btn-info" id="btn">
											<i class="fa fa-search"></i>
											Search
										</button>
									</div>
								</div>-->
							</form> 
							<div class="">
								<div class="col-sm-12">
										<div class="input-group">
											<input type="text" id="myInput" class="form-control" placeholder="Search">
											<span class="input-group-btn">
												<button type="button" class="btn btn-purple btn-sm">
												<span class="ace-icon fa fa-search icon-on-right bigger-110"></span></button>
											</span>
										</div>
								</div>
							</div>
						</div>
						<hr/>
						<div class="table-content" id="printableArea">
							<div class="text-center">
								<h5>{{$about->bangla_name}}</h5>
								{{$about->address}}<br/>
									Stock Report
							</div>
							<br/>
							<table id="product_list" class="table table-bordered table-condensed" role="grid" aria-describedby="dynamic-table_info">
								<thead>
									<tr>
										<th>SL</th>
										<th>Product</th>
										<th>Part No</th>
										<th>Warehouse</th>
										<th>Category</th>
										<th>Brand</th>
										<th>Unit</th>
										<th>Sale Price</th>
										<th>Stock</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
										$total_stock = 0;
									@endphp
									@foreach($products as $key=>$pro)
										@php
											$total_stock = $total_stock + $pro->product_stock;
										@endphp
										<tr class="{{$pro->product_stock < $pro->re_order_label ? 'red' : ''}} ">
											<td>{{$key + 1}}</td>
											<td>{{$pro->product_name}}</td>
											<td>{{$pro->model_no}}</td>
											<td>{{$pro->warehouse_name}}</td>
											<td>{{$pro->category_name}}</td>
											<td>{{$pro->brand_name}}</td>
											<td>{{$pro->unit_name}}</td>
											<td>{{$pro->sale_price}}</td>
											<td>{{$pro->product_stock}}</td>
											<td>
												<a  href="{{route('admin.pos.barcode_generate',$pro->id)}}" target="_blank" title="Generate Barcode and Print"><i class="ace-icon fa fa-barcode bigger-130"></i></a>
												&nbsp &nbsp
												<a  href="{{route('admin.pos.qrcode_generate',$pro->id)}}" target="_blank" title="Generate QRcode and Print"><i class="ace-icon fa fa-qrcode bigger-130"></i></a>
											</td>
										</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<td colspan="7"></td>
										<td>Total =</td>
										<td id="total_stock">{{$total_stock}}</td>
										<td></td>
									</tr>
								</tfoot>
							</table>
							<div class="text-center">
							
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
	$(document).ready(function(){
		// select2 section
		$('.select2').select2()	;
		/*-------search section------------*/
		 $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("tbody tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		  // sub,it query
		/*  $("#show").on("change",function(){
			$("#searchForm").submit(); 
		  })*/
		/*-----------warehouse wise stock list------------*/
		$("#warehouse").change(function(){
            var warehouse = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.stock.wpList') }}',
                type: 'post',
                data: {warehouse: warehouse, '_token' : token},
                dataType: 'json',
                success: function (response) {
				console.log(response)
                    var len = response.length;
                    $("#product").empty();
                    $("#product").append("<option value=''> Select Product</option>");
                    if (len == 0) {
                        $("#product").empty();
                        var id = "";
                        var name = "";
                        $("#product").append("<option value='" + id + "'>" + name + "</option>");
                    }
					//empty the table tbody
					$("#product_list tbody tr").remove();
					var total_stock = 0;
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['product_id'];
                        var name = response[i]['product_name'];
                        var part_no = response[i]['model_no'];
                        var warehouse = response[i]['warehouse_name'];
                        var category = response[i]['category_name'];
                        var brand = response[i]['brand_name'];
                        var unit = response[i]['unit_name'];
                        var stock = response[i]['product_stock'];
						total_stock = parseInt(total_stock) + parseInt(stock);
                        var disable = "";
                        $("#product").append("<option " + disable + " value='" + id + "'>"+name+" ( "+part_no+" )</option>");
						/*--------------*/
						$("#product_list tbody").append(
									"<tr>"
										+"<td>"+(i+1)+"</td>"
										+"<td>"+name+"</td>"
										+"<td>"+part_no+"</td>"
										+"<td>"+warehouse+"</td>"
										+"<td>"+category+"</td>"
										+"<td>"+brand+"</td>"
										+"<td>"+unit+"</td>"
										+"<td>"+stock+"</td>"
									+"</tr>"
								)
						$('#total_stock').html(total_stock);
					}
                }
            });
        });
		/***-------------category wise product stock search------------------*/
		$("#category").change(function () {
            var category = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.stock.cpList') }}',
                type: 'post',
                data: {category: category, '_token' : token},
                dataType: 'json',
                success: function (response) {
				//console.log(response)
                    var len = response.length;
                    $("#product").empty();
                    $("#product").append("<option value=''> Select Product</option>");
                    if (len == 0) {
                        $("#product").empty();
                        var id = "";
                        var name = "";
                        $("#product").append("<option value='" + id + "'>" + name + "</option>");
                    }
					//empty the table tbody
					$("#product_list tbody tr").remove();
					var total_stock = 0;
					
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['product_id'];
                        var name = response[i]['product_name'];
                        var part_no = response[i]['model_no'];
                        var warehouse = response[i]['warehouse_name'];
                        var category = response[i]['category_name'];
                        var brand = response[i]['brand_name'];
                        var unit = response[i]['unit_name'];
                        var stock = response[i]['product_stock'];
						total_stock = parseInt(total_stock) + parseInt(stock);
                        var disable = "";
                        $("#product").append("<option " + disable + " value='" + id + "'>"+name+" ( "+part_no+" )</option>");
						/*--------------*/
						$("#product_list tbody").append(
									"<tr>"
										+"<td>"+(i+1)+"</td>"
										+"<td>"+name+"</td>"
										+"<td>"+part_no+"</td>"
										+"<td>"+warehouse+"</td>"
										+"<td>"+category+"</td>"
										+"<td>"+brand+"</td>"
										+"<td>"+unit+"</td>"
										+"<td>"+stock+"</td>"
									+"</tr>"
								)
						$('#total_stock').html(total_stock);
					}
                }
            });
        });
		/*--------brand wise product list------------*/
		$("#brand").change(function () {
            var brand = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.stock.bpList') }}',
                type: 'post',
                data: {brand: brand, '_token' : token},
                dataType: 'json',
                success: function (response) {
				//console.log(response)
                    var len = response.length;
                    $("#product").empty();
                    $("#product").append("<option value=''> Select Product</option>");
                    if (len == 0) {
                        $("#product").empty();
                        var id = "";
                        var name = "";
                        $("#product").append("<option value='" + id + "'>" + name + "</option>");
                    }
					//empty the table tbody
					$("#product_list tbody tr").remove();
					var total_stock = 0;
					
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['product_id'];
                        var name = response[i]['product_name'];
                        var part_no = response[i]['model_no'];
                        var warehouse = response[i]['warehouse_name'];
                        var category = response[i]['category_name'];
                        var brand = response[i]['brand_name'];
                        var unit = response[i]['unit_name'];
                        var stock = response[i]['product_stock'];
						total_stock = parseInt(total_stock) + parseInt(stock);
                        var disable = "";
                        $("#product").append("<option " + disable + " value='" + id + "'>"+name+" ( "+part_no+" )</option>");
						/*--------------*/
						$("#product_list tbody").append(
									"<tr>"
										+"<td>"+(i+1)+"</td>"
										+"<td>"+name+"</td>"
										+"<td>"+part_no+"</td>"
										+"<td>"+warehouse+"</td>"
										+"<td>"+category+"</td>"
										+"<td>"+brand+"</td>"
										+"<td>"+unit+"</td>"
										+"<td>"+stock+"</td>"
									+"</tr>"
								)
						$('#total_stock').html(total_stock);
					}
                }
            });
        });
		/*--------brand wise product list------------*/
		$("#product").change(function () {
            var product = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.stock.pList') }}',
                type: 'post',
                data: {product: product, '_token' : token},
                dataType: 'json',
                success: function (response) {
				console.log(response)
                    var len = response.length;
                    $("#product").empty();
                    $("#product").append("<option value=''> Select Product</option>");
                    if (len == 0) {
                        $("#product").empty();
                        var id = "";
                        var name = "";
                        $("#product").append("<option value='" + id + "'>" + name + "</option>");
                    }
					//empty the table tbody
					$("#product_list tbody tr").remove();
					var total_stock = 0;
					
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['product_id'];
                        var name = response[i]['product_name'];
                        var part_no = response[i]['model_no'];
                        var warehouse = response[i]['warehouse_name'];
                        var category = response[i]['category_name'];
                        var brand = response[i]['brand_name'];
                        var unit = response[i]['unit_name'];
                        var stock = response[i]['product_stock'];
						total_stock = parseInt(total_stock) + parseInt(stock);
                        var disable = "";
                        $("#product").append("<option " + disable + " value='" + id + "'>"+name+" ( "+part_no+" )</option>");
						/*--------------*/
						$("#product_list tbody").append(
									"<tr>"
										+"<td>"+(i+1)+"</td>"
										+"<td>"+name+"</td>"
										+"<td>"+part_no+"</td>"
										+"<td>"+warehouse+"</td>"
										+"<td>"+category+"</td>"
										+"<td>"+brand+"</td>"
										+"<td>"+unit+"</td>"
										+"<td>"+stock+"</td>"
									+"</tr>"
								)
						$('#total_stock').html(total_stock);
					}
                }
            });
        });
	})
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