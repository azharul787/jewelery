@extends('layouts.backend.master')

@section('title', 'Sale')

@push('css')
	
	<!-- date Calender-->
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/examples.css') }}" type="text/css">

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Invoice Edit</h4>
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
						<form action="{{route('admin.sale.update',$sale->id)}}" method="post" class="form-" role="form" >
							@csrf
							@method('PUT')
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Customer Name <span class="required">*</span></label>
										<div class="col-sm-8">
											<select name="customer_id"  id="customer_id" class="form-control select2"  >
												<option value="{{$sale->customer_id}}" selected >{{$sale->customer->customer_name}}</option>
											</select> 
											<p class="error-sms">{{ $errors->first('customer_name') }}</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Phone</label>
										<div class="col-sm-8">
											<input type="text" name="customer_phone" id="customer_phone" value="{{$sale->customer->customer_phone}}" class="form-control" placeholder="01xxxxxxxx" readonly>
											<p class="error-sms">{{ $errors->first('customer_phone') }}</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Address</label>
										<div class="col-sm-8">
											<input type="text" name="customer_address" id="customer_address" value="{{$sale->customer->customer_address}}" class="form-control" placeholder="Customer Address" readonly>
											<p class="error-sms">{{ $errors->first('customer_address') }}</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Invoice No <span class="red">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="invoice_no"  class="form-control" value="{{$sale->invoice_no}}" placeholder="Invoice No" readonly>
											<p class="error-sms">{{ $errors->first('invoice_no') }}</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">	
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Date <span class="red">*</span></label>
										<div class="col-sm-8">
											<input id="datepicker" type="text" name="sale_date"  class="form-control" data-zdp_readonly_element="true" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy">
											<p class="error-sms">{{ $errors->first('sale_date') }}</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Note</label>
										<div class="col-sm-8">
											<input type="text" name="note"  class="form-control" value="{{$sale->note}}" placeholder="Note About this Purchase">
											<p class="error-sms">{{ $errors->first('note') }}</p>
										</div>
									</div>
								</div>
							</div>
						<hr/>
						<table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive green" id="sale">
							<thead class="info">
								<tr>
									<th class="all">SL </th>
									<th class="all">Product </th>
									<th class="all">Part No </th>
									<th class="all">Category </th>
									<th class="all">Warehouse </th>
									<th class="all">Rack No </th>
									<th class="all">Stock</th>
									<th class="all">Quantity</th>
									<th class="all">Sale Price</th>
									<th class="all">Discount</th>
									<th class="all">Sub Total</th>
									<!--<th class="all">Delete</th>-->
								</tr>
							</thead>
							<tbody>
							@php
								$sub_total = 0;
							@endphp
							@foreach($sale->saleDetail as $index=>$det)
								@php
									$sub_total = $sub_total + ($det->unit_price * $det->quantity);
								@endphp
								<tr id="{{$det->id}}">
									<td>{{$index + 1}}</td>
									<td>
										<input type="hidden" name="purchase_detail_id[]" value="{{$det->purchase_detail_id}}">
										<input type="hidden" name="product_id[]" value="{{$det->product_id}}">
										<input type="hidden" name="sale_detail_id[]" value="{{$det->id}}">
										{{$det->product->product_name}}
									</td>
									<td>{{$det->product->model_no}}</td>
									<td>{{$det->category->category_name}}</td>
									<td>{{$det->warehouse->warehouse_name}}</td>
									<td>{{$det->rack_no}}</td>
									<td><input  type='hidden' id='{{$det->id}}_stock' name='stock[]' value='{{$det->purchaseDetail->now_stock}}' size='10'/>{{$det->purchaseDetail->now_stock}}</td>
									<td><input type='text' id='{{$det->id}}_ordered_quantity' class='ordered_quantity' name='ordered_quantity[]' min='1' {{$det->purchaseDetail->now_stock == 0 ? 'readonly' : ''}} value='{{$det->quantity}}' size='8' /></td>
									<td><input type='text' id='{{$det->id}}_price'  class='sale_price' name='sale_price[]' value='{{$det->unit_price}}' size='10'/></td>
									<td><input type='text' id='"+id+"_single_discount' class='single_discount' name='single_discount[]' value='{{$det->discount}}' size='10' placeholder='0.00'></td>
									<td class='sub_total' id='{{$det->id}}_sub_total'>{{$det->quantity * $det->unit_price}}</td>
									<!--<td class='text-center'><i class='red fa fa-trash fa-lg'></i></td>-->
								</tr>
							@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th class="all" colspan="4">Total</th>
									<th id="supplier_price"></th>
									<th id="model_no"></th>
									<th id="">-</th>
									<th id="total_ordered">{{$sale->saleDetail->sum('quantity')}}</th>
									<th id="">-</th>
									<th id="single_total_dis">{{$sale->saleDetail->sum('discount')}}</th>
									<th id="total_sub">{{$sub_total}}</th>
								</tr>
							</tfoot>
						</table>
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="discount">Discount</label>
                                            <div class="col-sm-8 ">
                                              <input type="text" class="form-control" min="0" value="{{$sale->discount}}" name="discount" id="discount">
                                            	<p class="error-sms">{{ $errors->first('discount') }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Discount Type</label>
                                            <div class="col-sm-8 ">          
                                                <select class="form-control select2" id="discount_type" name="discount_type">
                                                    <option> Fixed</option>
                                                    <option>Percentage </option>
                                                </select>
                                                <p class="error-sms">{{ $errors->first('discount_type') }}</p>
                                            </div>
                                        </div>
										<!--<div class="form-group">
											<label class="control-label col-sm-4">Payment Status</label>
											<div class="col-sm-8 "> 
												<select class="form-control select2" name="payment_status">
													<option>Paid </option>                                                   
													<option>Due </option>
												</select>
											</div>    
										</div>-->
										<div class="form-group">
											<label class="control-label col-sm-4">Grand Total</label>
											<div class="col-md-8">
												<input type="number" class="form-control grand_total" value="{{$sale->grand_total_price}}" id="" min="0" readonly name="grand_total" >
												<p class="error-sms">{{ $errors->first('grand_total') }}</p>
											</div>  
										</div>
										<div class="form-group">
											<label class="control-label col-sm-4">Payment Amount</label>
											<div class="col-md-8">
												<input type="number" class="form-control" id="payment" value="{{$sale->payment}}" min="0" name="payment" placeholder="0.00" required>
												<p class="error-sms">{{ $errors->first('payment') }}</p>
											</div>  
										</div>
                                    </div>
                                    <div class="col-sm-5">
                                        <table style="max-width:80%;margin:0 auto" class="table table-striped table-bordered table-hover table-header-fixed" id="sample_2" >
											<tfoot>
												<tr>
													<th> Name: </th>
													<th>Amount:</th>
												</tr>
												<tr>
													<th> Items: </th>
													<th><span class="pull-right" id="total_items">{{$sale->saleDetail->count()}}</span></th>
												</tr>
												<tr>
													<th> Total: </th>
													<th><span class="pull-right" id="total_value">{{$sale->total_price}}</span></th>
												</tr>
												<tr>    
													<th> Discount: </th>
													<th> <span class="pull-right" id="total_discount">{{$sale->discount}}</span></th>
												</tr>
												<!--<tr>
													<th> Tax </th><th>  <span class="pull-right" id="total_tax">0</span></th>
												</tr>
												<tr>
													<th> Shipping </th><th>  <span class="pull-right" id="total_shipping">0</span></th>
												</tr>-->
												<tr>
													<th> Grand Total: </th>
													<th>  <span class="pull-right" id="grand_total">{{$sale->grand_total_price}}</span></th>
												</tr>
												 <tr>
													<th> Due: </th>
													<th><span class="pull-right" id="due">{{$sale->due_amount}}</span></th>
												</tr>
											</tfoot>
										</table>
										<input type="hidden" id="total_price" class="total_price" name="total_price" value="{{$sale->total_price}}" />
										<input type="hidden" class="due" name="due" value="{{$sale->due_amount}}" />
                                    </div>
                                </div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
									  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
									  <button type="submit" class="btn btn-xs btn-success">Update</button>
									</div>
								</div>
								<br><br>
						</form>
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
<script>
	$(document).ready(function() 
	  {
		 $('#datepicker').Zebra_DatePicker({
			format: 'd-m-Y',
			direction: 1,
		});
		// select2 section
		$('.select2').select2()	;
		/*------load customer list-------------*/
		/*var token = "{{csrf_token()}}";
		$.ajax({
			url: '{{ route('admin.sale.customerList') }}',
			type: 'Get',
			data: {'_token' : token},
			dataType: 'json',
			success: function (response) {
			//console.log(response)
				var len = response.length;
				$("#customer_id").empty();
				$("#customer_id").append("<option value=''> Select Customer </option>");
				if (len == 0) {
					$("#customer_id").empty();
					var id = "";
					var name = "";
					$("#customer_id").append("<option value='" + id + "'>" + name + "</option>");
				}
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['customer_name'];
					var distric = response[i]['distric']['distric_name'];
					var disable = "";
					$("#customer_id").append("<option " + disable + " value='" + id + "'>"+name+" ( "+distric+" ) </option>");
				}
			}
		});*/
		/*-------------------Customer Details search section-------------------------*/
		$(document).on('change','#customer_id',function(){
			var customer_id = $(this).val();
			var token = "{{csrf_token()}}";
				$.ajax({
					url: '{{ route('admin.sale.customerDetails') }}',
					type: 'GET',
					data: {customer_id:customer_id, '_token' : token},
					dataType: 'json',
					success: function (response) {					
					//console.log(response)
					$('#customer_name').val(response.customer_name)
					$('#customer_phone').val(response.customer_phone)
					$('#customer_address').val(response.customer_address)
				}
			});
		});
		/***-------------------------------*/
		/*$("#category").change(function () {
            var category = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.sale.productList2') }}',
                type: 'Get',
                data: {category: category, '_token' : token},
                dataType: 'json',
                success: function (response) {
                    var len = response.length;
                    $("#product").empty();
                    $("#product").append("<option value=''> Select Product</option>");
                    if (len == 0) {
                        $("#product").empty();
                        var id = "";
                        var name = "";
                        $("#product").append("<option value='" + id + "'>" + name + "</option>");
                    }
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id'];
                        var name = response[i]['product_name'];
                        var stock = response[i]['now_stock'];
                        var disable = "";
                        $("#product").append("<option " + disable + " value='" + id + "'>"+name+" ( "+stock+" ) </option>");
                    }
                }
            });
        });
*/
		var array = [];
        var total_tax = 0;
        var tax_type = "Fixed";
		var SL = 1;
		
       /* $("#product").change(function () {
            var id = $(this).val();
            var token = "{{csrf_token()}}";

            $.ajax({
                url: '{{ route('admin.sale.productDetails2') }}',
                type: 'Get',
                data: {id: id, '_token' : token},
                dataType: 'json',
                success: function (response) {
                    var len = response.length;
                    for (var i = 0; i < len; i++) {
                        var id = response[1][i]['id'];
                        var name = response[1][i]['product_name'];
                        var disable = "";
                        $("#product").append("<option " + disable + " id='product_" + id + "' value='" + id + "'>" + name + "</option>");
                    }

                    var id = response['id'];  
					var name = response['product_name']; 					
                    var category_name = response['category_name'];               
                    var brand_name = response['brand_name'];               
                    var unit_name = response['unit_name'];               
                    var model_no =  response['model_no'];
                    var stock =  response['now_stock'];
                    var sale_price =  response['sale_price'];
                    var ordered_quantity =  1;
                    var sub_total =  sale_price*ordered_quantity;

                    $("#sale tbody").append(
                        "<tr id='"+id+"'>"
						  +"<td>"+(SL++)+"</td>"
                          +"<td><input type='hidden' name='purchase_details_id[]' value='"+id+"' />"+name+" </td>"
						  +"<td><input id='' type='hidden' name='model_no[]' value='"+model_no+"' size='10'/>"+model_no+"</td>"
                          +"<td><input type='hidden' name='category_name[]' value='"+category_name+"' />"+category_name+" </td>"
                          +"<td><input type='hidden' name='brand_name[]' value='"+brand_name+"' />"+brand_name+" </td>"
                          +"<td><input type='hidden' name='unit_name[]' value='"+unit_name+"' />"+unit_name+" </td>"
						  +"<td><input  type='hidden' id='"+id+"_stock' name='stock[]' value='"+stock+"' size='10'/>"+stock+"</td>"
                          +"<td><input type='text' id='"+id+"_ordered_quantity' class='ordered_quantity' name='ordered_quantity[]' min='1' value='"+ordered_quantity+"' size='10' /></td>"
						  +"<td><input type='text' id='"+id+"_price' class='sale_price' name='sale_price[]' value='"+sale_price+"' size='10'></td>"
						  +"<td><input type='text' id='"+id+"_single_discount' class='single_discount' name='single_discount[]' value='' size='10' placeholder='0.00'></td>"
						  +"<td class='sub_total' id='"+id+"_sub_total'>"+sub_total+"</td>"
                          +"<td class='text-center'><i class='fa red fa-trash fa-lg'></i></td>"
                        +"</tr>");

                    array.push(id);
                    var idLength = array.length;
                    for(j = 0; j<idLength; j++){
                        $('#product_'+array[j]).attr('disabled','disabled').select2({placeholder:"",width:"auto",allowClear:!0});
                    }

                    var total_ordered = parseFloat($('#total_ordered').html());
                    total_ordered = total_ordered + 1;
                    $('#total_ordered').html(total_ordered);

                    calculate_sub_total();

                    calculate_total();
                }
            });
        });
        
        $(document).on('click','.fa-trash',function(){
            var id = $(this).parent().parent().attr('id');
            $('#'+id).remove();

            $('#product_'+id).removeAttr('disabled');
            array.splice($.inArray(id, array), 1);

            calculate_ordered_quantity();
            calculate_sub_total();
            calculate_total();
        });
	*/
        $(document).on('keyup','.ordered_quantity',function(){
            var id = $(this).parent().parent().attr('id');
            var price = $('#'+id+'_price').val();
            var quantity = $('#'+id+'_ordered_quantity').val();
            var stock = $('#'+id+'_stock').val();

			if(parseInt(stock) >= parseInt(quantity)){
				var sub_total =  price*quantity;
				$('#'+id+'_sub_total').html(sub_total);
				calculate_ordered_quantity();
				calculate_sub_total();
				calculate_total();
				
				calculate_due();
			}else{
				alert('Product Stock is low than Ordered Quantity!!!!!!');
				$('#'+id+'_sub_total').empty();
				$('#'+id+'_ordered_quantity').val('');
			}
        });
		$(document).on('keyup','.sale_price',function(){
            var id = $(this).parent().parent().attr('id');
            var price = $('#'+id+'_price').val();
            var quantity = $('#'+id+'_ordered_quantity').val();
            //var stock = $('#'+id+'_stock').val();
			
				var sub_total =  price*quantity;
				$('#'+id+'_sub_total').html(sub_total);
				calculate_ordered_quantity();
				calculate_sub_total();
				calculate_total();
				
				calculate_due();
        });
		$(document).on('keyup','.single_discount',function(){
            var id = $(this).parent().parent().attr('id');
			
            var price = $('#'+id+'_price').val();
            var quantity = $('#'+id+'_ordered_quantity').val();
            var discount = $('#'+id+'_single_discount').val() || 0;
			//alert(discount)
				var sub_total =  price*quantity;
				$('#'+id+'_sub_total').html(sub_total - discount);
				
				calculate_ordered_quantity();
				calculate_sub_total();
				calculate_total();
				
				calculate_due();
			
        });
        $(document).on('keyup','#discount',function(){
            calculate_discount();
            calculate_grand_total();
			calculate_due();
        });

        $(document).on('change','#discount_type',function(){
            calculate_discount();
            calculate_grand_total();
			calculate_due();
        });

		$(document).on('keyup','#payment',function(){
            calculate_discount();
            calculate_grand_total();
			calculate_due();
        });
      /*  $(document).on('keyup','#shipping',function(){
          //  calculate_shipping();
            calculate_grand_total();
        });

        $(document).on('change','#shipping_type',function(){
            //calculate_shipping();
            calculate_grand_total();
        });*/

      

        function calculate_ordered_quantity(){
            var total_ordered = 0;
            //iterate through each td based on class and add the values
            $(".ordered_quantity").each(function() {

                var value = parseFloat($(this).val());

                total_ordered = total_ordered + value;
            });
            $('#total_ordered').html(total_ordered);
        }

        function calculate_discount(){
            var discount = $('#discount').val();
            var type = $('#discount_type').val();
            if (type != 'Fixed') {
                discount = parseFloat($('#total_value').html()) * discount / 100;
            }
            
            $('#total_discount').html(discount);
        }

        function calculate_sub_total(){
            var total_sub = 0;
            var total_dis = 0;
            //iterate through each td based on class and add the values
            $(".sub_total").each(function() {
                var value = parseFloat($(this).html());
                total_sub = total_sub + value;
            });
            $('#total_sub').html(total_sub);
			
			/*-------single discount calculation ------------*/
			$(".single_discount").each(function() {
                var dis = parseFloat($(this).val() || 0);
                total_dis = total_dis + dis;
            });
            $('#single_total_dis').html(total_dis);
        }

        function calculate_grand_total(){
			
           // var grand_total = parseFloat($('#total_value').html())-parseFloat($('#total_discount').html())+parseFloat($('#total_tax').html())+parseFloat($('#total_shipping').html());
            var grand_total = parseFloat($('#total_value').html())- parseFloat($('#total_discount').html());
            /*------------24-15-19------------------*/
			
			/*var paid = $('#paid_amount').html();
			var due = parseInt(grand_total) - parseInt(paid);*/
			
			/*--------------------------*/
			
			$('#grand_total').html(grand_total);
            $('.grand_total').val(grand_total);
            $('#due').html(grand_total);
			//alert(grand_total)
        }

        function calculate_total(){
            var total_items = 0;            
            var total_sub = 0;
            //iterate through each td based on class and add the values
            $(".sub_total").each(function() {
                total_items++;
            });

            $('#total_items').html(total_items);
            $('#total_value').html($('#total_sub').html());
            $('#total_price').val($('#total_sub').html());

            calculate_discount();
           // calculate_tax();
            //calculate_shipping();
            calculate_grand_total();
        }
		// due section
		function calculate_due(){
			var pay = $('#payment').val() || 0;
			var grand_total = $('.grand_total').val() || 0;
			var due = parseInt(grand_total) - parseInt(pay);
			$('.due').val(due);
			$('#due').html(due);
		}
		
		
		
		/************************************************************/
		
		// dependency dropdown for Address section
	$('#distric_id').on('change',function(){
			var distric_id = $(this).val();
			
			if(distric_id != '')
			{
				var token = "{{csrf_token()}}";
					$.ajax({
						url: '{{ route('admin.union.getUpozila') }}',
						type: 'GET',
						data: {distric_id:distric_id, '_token' : token},
						dataType: 'json',
						success: function (response) {					
							var len = response.length;
							//alert(len)
							$("#upozila_id").empty();
							$("#upozila_id").append("<option value=''>-Select-</option>");
							if (len == 0) {
								$("#upozila_id").empty();
								var id = "";
								var name = "";
								$("#upozila_id").append("<option value='" + id + "'>" + name + "</option>");
							}
							for (var i = 0; i < len; i++) {
								var id = response[i]['id'];
								var name = response[i]['upozila_name'];
								$("#upozila_id").append("<option value='" + id + "'>" + name + "</option>");
							}
						}
					});
			}				
			else{
				alert('Please Select Distric');
			}
		});
	$('#upozila_id').on('change',function(){
			var upozila_id = $(this).val();
			
			if(upozila_id != '')
			{
					var token = "{{csrf_token()}}";
					$.ajax({
						url: '{{ route('admin.village.getUnion') }}',
						type: 'GET',
						data: {upozila_id:upozila_id, '_token' : token},
						dataType: 'json',
						success: function (response) {					
							var len = response.length;
							//alert(len)
							$("#union_id").empty();
							$("#union_id").append("<option value=''>-Union-</option>");
							if (len == 0) {
								$("#union_id").empty();
								var id = "";
								var name = "";
								$("#union_id").append("<option value='" + id + "'>" + name + "</option>");
							}
							for (var i = 0; i < len; i++) {
								var id = response[i]['id'];
								var name = response[i]['union_name'];
								$("#union_id").append("<option value='" + id + "'>" + name + "</option>");
							}
						}
					});
			}				
			else{
				alert('Please Select Distric');
			}
		});
		/******************************-*/
		$('#union_id').on('change',function(){
			var union_id = $(this).val();
			
			if(union_id != '')
			{
					var token = "{{csrf_token()}}";
					$.ajax({
						url: '{{ route('admin.village.getVillage') }}',
						type: 'GET',
						data: {union_id:union_id, '_token' : token},
						dataType: 'json',
						success: function (response) {					
							var len = response.length;
							//alert(len)
							$("#village_id").empty();
							$("#village_id").append("<option value=''>-Village-</option>");
							if (len == 0) {
								$("#village_id").empty();
								var id = "";
								var name = "";
								$("#village_id").append("<option value='" + id + "'>" + name + "</option>");
							}
							for (var i = 0; i < len; i++) {
								var id = response[i]['id'];
								var name = response[i]['village_name'];
								$("#village_id").append("<option value='" + id + "'>" + name + "</option>");
							}
						}
					});
			}				
			else{
				alert('Please Select Union');
			}
		});
	})
	</script>
@endpush									