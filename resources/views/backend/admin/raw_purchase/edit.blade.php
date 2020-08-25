@extends('layouts.backend.master')

@section('title', 'Purchase Edit')

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
					<h4 class="widget-title">
						<a href="{{ route('admin.purchase.index')}}" calss="btn" ><i class="fa fa-mail-reply"></i></a>
						Purchase Edit
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
						<form action="{{route('admin.purchase.update',$purchase->id)}}" method="POST" class="form-horizontal" role="form" >
							@csrf
							@method('PUT')
								<div class="row">
                                    <div class="col-sm-4">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Chalan No</label>
											<div class="col-sm-9">
												 <input type="text" name="chalan_no"  class="form-control" readonly value="{{old('chalan_no') ?? $purchase->chalan_no}}" placeholder="Chalan No">
												<p class="error-sms">{{ $errors->first('chalan_no') }}</p>
											</div>
										</div>
										<div class="form-group">
										</div>
									</div>
                                    <div class="col-sm-4">
										<div class="form-group">
											<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Purchase Date *</label>
											<div class="col-sm-8">
												<input id="datepicker" readonly type="text" name="purchase_date"  class="form-control" data-zdp_readonly_element="true" value="{{ date('d-m-Y',strtotime($purchase->purchase_date))}}" placeholder="dd-mm-yyyy">
												<p class="error-sms">{{ $errors->first('purchase_date') }}</p>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Note</label>
											<div class="col-sm-9">
												<input type="text" name="note"  class="form-control" placeholder="Note About this Purchase">
												<p class="error-sms">{{ $errors->first('note') }}</p>
											</div>
										</div>
									</div>
								</div>
                                <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive green" id="product-table">
                                    <thead class="info">
                                        <tr>
                                            <th class="all">SL </th>
                                            <th class="all">Product </th>
                                            <th class="all">Part No </th>
                                            <th class="all">Warehouse </th>
                                            <th class="all">Rack No </th>
											<th class="all">Now Stock</th>
											<th class="all">Quantity</th>
                                            <th class="all">Supplier Price</th>
                                            <th class="all">Sale Price</th>
                                            <th class="all">Sub Total</th>
                                           <!--<th class="all">Delete</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@php
                                    		$sp_total = 0;
                                    		$qty_total = 0;
                                    		$sl_total = 0;
                                    		$sub_total = 0;
                                    	@endphp
                                    
                                    	@foreach($purchase->details as $index=>$det)
	                                    	@php
	                                    		$sp_total = $sp_total + $det->rate;
	                                    		$qty_total = $qty_total + $det->quantity;
	                                    		$sl_total = $sl_total + $det->product->sale_price;
	                                    		$sub_total = $sub_total + ($det->rate * $det->quantity);
	                                    	@endphp
                                    		<tr id="{{$det->id}}">
                                    			<td>{{$index + 1}}</td>
                                    			<td>
													<input type="hidden" name="purchase_detail_id[]" value="{{$det->id}}">
													<input type="hidden" name="product_id[]" value="{{$det->product_id}}">
													<!--<input type="hidden" name="category_id[]" value="{{$det->category_id}}">
													<input type="hidden" name="brand_id[]" value="{{$det->brand_id}}">
													<input type="hidden" name="unit_id[]" value="{{$det->unit_id}}">
													<input type="hidden" name="model_no[]" value="{{$det->model_no}}">-->
													{{$det->product->product_name}}
												</td>
                                    			<td>{{$det->product->model_no}}</td>
                                    			<td>{{$det->warehouse->warehouse_name}}</td>
                                    			<td>{{$det->rack_no}}</td>
                                    			<td>{{$det->now_stock}}</td>
												<td><input type='text' id='{{$det->id}}_ordered_quantity' class='ordered_quantity' name='ordered_quantity[]' min='1' {{$det->now_stock == 0 ? 'readonly' : ''}} value='{{$det->now_stock}}' size='8' /></td>
                                    			<td><input type='text' id='{{$det->id}}_price'  class='supplier_price' name='supplier_price[]' value='{{$det->purchase_price}}' size='10'/></td>
												<td><input type='text' name='sale_price[]' value='{{$det->sale_price}}' size='10'></td>
						                        <td class='sub_total' id='{{$det->id}}_sub_total'>{{$det->quantity * $det->purchase_price}}</td>
						                        <!--<td class='text-center'><i class='red fa fa-trash fa-lg'></i></td>-->
                                    		</tr>
                                    	@endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="all" colspan="5"></th>
                                            <th>Total</th>
											<th id="total_ordered">{{$qty_total}}</th>
                                            <th id="supplier_price"></th>
											<th id=""></th>
                                            <th id="total_sub">{{$sub_total}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-sm-7">
										<div class="form-group">
											<label class="control-label col-sm-4">Custom Cost</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="custom_cost" min="0" name="custom_cost" value="{{$purchase->custom_cost}}">
												<p class="error-sms">{{ $errors->first('custom_cost') }}</p>
											</div>  
										</div>
										<div class="form-group">
											<label class="control-label col-sm-4">Transport Cost</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="transport_cost" min="0" name="transport_cost" value="{{$purchase->transport_cost}}">
												<p class="error-sms">{{ $errors->first('transport_cost') }}</p>
											</div>  
										</div>
										<div class="form-group">
											<label class="control-label col-sm-4">Other Amount</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="other_cost" min="0" name="other_cost" value="{{$purchase->other_cost}}">
												<p class="error-sms">{{ $errors->first('other_cost') }}</p>
											</div>  
										</div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="discount">Discount</label>
                                            <div class="col-sm-8 ">
                                              <input type="text" class="form-control" min="0" value="{{$purchase->discount}}" name="discount" id="discount" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Discount Type</label>
                                            <div class="col-sm-8 ">          
                                                <select class="form-control" id="discount_type" name="discount_type">
                                                    <option> Fixed</option>
                                                    <option>Percentage </option>
                                                </select>
                                            </div>
                                        </div>
										
										<div class="form-group">
											<label class="control-label col-sm-4">Payment Amount</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="payment" min="0" name="payment" value="{{$purchase->payment}}">
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
													<th>Total Items: </th>
													<th><span class="pull-right" id="total_items">0</span></th>
												</tr>
												<tr>
													<th>Total Price: </th>
													<th><span class="pull-right" id="total_value">{{$sub_total}}</span></th>
												</tr>
												
												<tr>
													<th>Custom Cost:</th><th>  <span class="pull-right" id="custom">0</span></th>
												</tr>
												<tr>
													<th>Trasport Cost:</th><th>  <span class="pull-right" id="transport">0</span></th>
												</tr>
												<tr>
													<th>Other Cost: </th><th>  <span class="pull-right" id="other">0</span></th>
												</tr>
												<tr>    
													<th>Discount: </th>
													<th> <span class="pull-right" id="total_discount">0</span></th>
												</tr>
												<tr>
													<th>Grand Total: </th>
													<th><span class="pull-right" id="grand_total">{{$sub_total}}</span></th>
												</tr>
												<tr>
													<th>Previous Paid: </th><th> 
													<input type="hidden" name="previous_payment" value="{{$purchase != '' ? $purchase->payment  : '0'}}">
													<span class="pull-right" id="paid_amount">{{$purchase != '' ? $purchase->payment  : '0'}}</span>
												</th>
												</tr>
												<tr>
													<th>Due Amount: </th>
													<th>  <span class="pull-right" id="due">{{$purchase != '' ? $sub_total - $purchase->payment  : '0'}}</span></th>
												</tr>
											</tfoot>
										</table>
										<input type="hidden" id="total_price" name="total_price" value="{{$purchase->total_price}}" />
										<input type="hidden" class="grand_total" name="grand_total"  value="{{$purchase->total_price}}" />
										<input type="hidden" class="due" name="due" value="{{$purchase->total_price - $purchase->payment}}" />
                                    </div>
                                </div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
									  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
									  <button type="submit" class="btn btn-xs btn-success">Update</button>
									</div>
								</div>
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
			format: 'd-m-Y'
		});
		// select2 section
		$('.select2').select2()	;
	
		/*-------------search order section-------------------*/
		 $("#order_no").on("change",function(){
			//alert($(this).val())
			$("#orderSearch").submit(); 
		})
	/*-----------add product item section--------------*/
	  
		$('#category').change(function(){
			var category = $(this).val();
			var token = "{{csrf_token()}}";
				$.ajax({
					url: '{{ route('admin.purchase.productList') }}',
					type: 'post',
					data: {category:category,'_token' : token},
					dataType: 'json',
					success: function (response) {
					//console.log(response)
						var len = response.length;
						$("#product").empty();
						$("#product").append("<option value=''> -- Select Product -- </option>");
						if (len == 0) {
							$("#product").empty();
							var id = "";
							var name = "";
							$("#product").append("<option value='" + id + "'>" + name + "</option>");
						}
						for (var i = 0; i < len; i++) {
							var id = response[i]['id'];
							var name = response[i]['product_name'];
							var part_no = response[i]['model_no'];
							var disable = "";
							$("#product").append("<option " + disable + " value='" + id + "'>"+name+" ( "+part_no+" ) </option>");
						}
					}
				});
		  })
	  /*----------call the function for calculate-----------------*/
 			calculate_ordered_quantity();
            calculate_sub_total();
            calculate_total();

	  /*--------------------------*/
		var array = [];
        var total_tax = 0;
        var tax_type = "Fixed";
        var sl = {{$index + 2}}
        $("#product").change(function () {
            var id = $(this).val();
           // $("#product").attr('disabled', true);
            var token = "{{csrf_token()}}";

            $.ajax({
                url: '{{ route('admin.purchase.productDetails') }}',
                type: 'post',
                data: {id: id, '_token' : token},
                dataType: 'json',
                success: function (response) {
			//console.log(response)
                    var len = response.length;
                   // $("#product").empty();
                   // $("#product").append("<option value=''> Select Product</option>");
                    for (var i = 0; i < len; i++) {
                        var id = response[1][i]['id'];
                        var name = response[1][i]['product_name'];
                        var disable = "";
                        $("#product").append("<option " + disable + " id='product_" + id + "' value='" + id + "'>" + name + "</option>");
                    }

                    var id = response['id'];  
					var name = response['product_name']; 					              
                    var category_id =  response['category_id'];
                    var brand_id =  response['brand_id'];
                    var unit_id =  response['unit_id'];
                    var model_no =  response['model_no'];
                    var supplier_price =  response['supplier_price'];
                    var sale_price =  response['sale_price'];
                    var ordered_quantity =  1;
                    var sub_total =  supplier_price*ordered_quantity;

                    $("#product-table tbody").append(
                        "<tr id='"+id+"'>"
                          +"<td>"+(sl++)+"</td>"
                          +"<td>"
						  +"<input type='hidden' name='product_id[]' value='"+id+"' />"
						  +"<input type='hidden' name='category_id[]' value='"+category_id+"'/>"
						  +"<input type='hidden' name='brand_id[]' value='"+brand_id+"'/>"
						  +"<input type='hidden' name='unit_id[]' value='"+unit_id+"'/>+"+name+" </td>"
						  +"<td><input type='hidden' name='model_no[]' value='"+model_no+"' />"+model_no+" </td>"
                          +"<td>"
							+"<select name='warehouse[]' class='form-control' required='required'>"
                                
                               +"</select>"
						  +"</td>"
                          +"<td><input type='text' name='rack_no[]' value='' placeholder='Rack No' size='8'/></td>"
						  +"<td><input id='"+id+"_price' type='text' name='supplier_price[]' class='supplier_price' value='"+supplier_price+"' size='10'/></td>"
						  +"<td><input type='text' id='"+id+"_ordered_quantity' class='ordered_quantity' name='ordered_quantity[]' min='1' value='"+ordered_quantity+"' size='10' /></td>"
						  +"<td><input type='text' name='sale_price[]' value='"+sale_price+"' size='10'></td>"
                          +"<td class='sub_total' id='"+id+"_sub_total'>"+sub_total+"</td>"
                          +"<td class='text-center'><i class='red fa fa-trash fa-lg'></i></td>"
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

		/*----------Remove section------------*/
        $(document).on('click','.fa-trash',function(){
            var id = $(this).parent().parent().attr('id');
            $('#'+id).remove();

            $('#product_'+id).removeAttr('disabled');
            array.splice($.inArray(id, array), 1);

            calculate_ordered_quantity();
            calculate_sub_total();
            calculate_total();
        });

        $(document).on('keyup','.ordered_quantity',function(){
            var id = $(this).parent().parent().attr('id');
            var price = $('#'+id+'_price').val();
            var quantity = $('#'+id+'_ordered_quantity').val();
            var sub_total =  price*quantity;
            $('#'+id+'_sub_total').html(sub_total);

            calculate_ordered_quantity();
            calculate_sub_total();
            calculate_total();
			//16-07-19
			calculate_due();
        });
		$(document).on('keyup','.supplier_price',function(){
            var id = $(this).parent().parent().attr('id');
            var price = $('#'+id+'_price').val();
            var quantity = $('#'+id+'_ordered_quantity').val();
           // var stock = $('#'+id+'_stock').val();
			
				var sub_total =  price*quantity;
				$('#'+id+'_sub_total').html(sub_total);
				calculate_ordered_quantity();
				calculate_sub_total();
				calculate_total();
				
				//16-07-19
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
		//16-07-19
 		$(document).on('keyup','#custom_cost',function(){
			calculate_discount();
            calculate_grand_total();
			calculate_due();
			calculate_total();
        });
 		$(document).on('keyup','#transport_cost',function(){
            calculate_discount();
            calculate_grand_total();
			calculate_due();
			//calculate_total();
        });
  		 $(document).on('keyup','#other_cost',function(){
			calculate_discount();
            calculate_grand_total();
			calculate_due();
			//calculate_total();
        });
		//16-07-19
		$(document).on('keyup','#payment',function(){
            calculate_discount();
            calculate_grand_total();
			calculate_due();
        });
       

       /* $(document).on('change','#shipping_type',function(){
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

      /*  function calculate_tax(){
            if (tax_type != 'Fixed') {
                var tax_amount = (parseFloat($('#total_value').html()) * total_tax) / 100;
            }
            console.log(tax_amount);
            $('#total_tax').html(tax_amount);
        }
*/
       /* function calculate_shipping(){
            var shipping = $('#shipping').val();
            var type = $('#shipping_type').val();
            if (type != 'Fixed') {
                shipping = parseFloat($('#total_value').html()) * shipping / 100;
            }
            
            $('#total_shipping').html(shipping);
        }*/

        function calculate_sub_total(){
            var total_sub = 0;
            //iterate through each td based on class and add the values
            $(".sub_total").each(function() {

                var value = parseFloat($(this).html());

                total_sub = total_sub + value;
            });
            $('#total_sub').html(total_sub);
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
           

            calculate_discount();
           // calculate_tax();
            //calculate_shipping();
            calculate_grand_total();
        }
		/*-----------grand total calculate section---------------*/
		function calculate_grand_total(){
			
           // var grand_total = parseFloat($('#total_value').html())-parseFloat($('#total_discount').html())+parseFloat($('#total_tax').html())+parseFloat($('#total_shipping').html());
            var grand_total = parseFloat($('#total_value').html())-parseFloat($('#total_discount').html() || 0);
            
			
			/*------------15-07-19---------------*/
            var custom = $('#custom_cost').val() || 0;
            var transport = $('#transport_cost').val() || 0;
            var other = $('#other_cost').val() || 0;
            var total_cost = (parseInt(custom) + parseInt(transport) + parseInt(other));
			grand_total = parseFloat(grand_total) + parseFloat(total_cost);
			$('#custom').html(custom);
			$('#transport').html(transport);
			$('#other').html(other);
			/*------------------15-07-19-------------------*/
			
            var paid = $('#paid_amount').html();
			var due = parseInt(grand_total) - parseInt(paid);
			
            $('#grand_total').html(grand_total);
            $('.grand_total').val(grand_total);
            $('#due').html(due);
			 $('#total_price').html($('#total_value').html());
        }
		// due section
		function calculate_due(){
			var pay = $('#payment').val();
			
			/*------------16-07-19-------------------*/
			var paid = $('#paid_amount').html();
			var custom = $('#custom_cost').val() || 0;
            var transport = $('#transport_cost').val() || 0;
            var other = $('#other_cost').val() || 0;
            var total_cost = (parseInt(custom) + parseInt(transport) + parseInt(other));
            
			
			
			var grand_total = $('.grand_total').val();
			//grand_total = parseInt(grand_total) + parseInt(total_cost);
			/*----------16-07-19------------*/
			
			var due = parseInt(grand_total) - parseInt(paid);
			due = due - pay;
			$('.due').val(due);
			$('#due').html(due);
		}
	})
	</script>
@endpush									