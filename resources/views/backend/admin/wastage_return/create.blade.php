@extends('layouts.backend.master')

@section('title', 'Wastage Return')

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
					<h4 class="widget-title">Wastage Return Entry</h4>
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
						<form action="{{route('admin.wastage_return.store')}}" method="POST" class="form-horizon" role="form" >
							@csrf
								<div class="row">
                                   <!-- <div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Chalan No *</label>
											<div class="col-sm-9">
												<input type="hidden" name="order_id" value="">
												<input type="hidden" name="order_no" value="">
												<input type="text" name="chalan_no"  class="form-control" readonly value="" placeholder="Chalan No">
												<p class="error-sms">{{ $errors->first('chalan_no') }}</p>
											</div>
										</div>
									</div>-->
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Return Date <span class="red">*</span></label>
											<div class="col-sm-9">
												<input id="datepicker" type="text" name="return_date"  class="form-control" data-zdp_readonly_element="true" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy">
												<p class="error-sms">{{ $errors->first('return_date') }}</p>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Note</label>
											<div class="col-sm-9">
												<input type="text" name="note"  class="form-control" placeholder="Note About this Purchase">
												<p class="error-sms">{{ $errors->first('note') }}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-3">
										<div class="form-group ">
											<label>Select Warehouse</label>
											<select class="form-control select2" name="warehouse_id" id="warehouse_id">
												<option value="">- Select Warehouse -</option>
												@foreach($warehouses as $wr)
												<option value="{{ $wr->id }}"> {{ $wr->warehouse_name }} </option>
												@endforeach
											</select>
										</div>     
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Select Product</label>
											<select class="form-control select2" name="product_name" id="product">
												<option value="">-Select Product-</option>
											</select>
										</div>  
									</div>
									<div class="col-sm-3"></div>
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
											<th class="all">Return Qty</th>
                                            <th class="all">Purchase Price</th>
                                            <th class="all">Sub Total</th>
                                           <th class="all">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="all" colspan="3"></th>
                                            <th>Total</th>
                                            <th id="supplier_price"></th>
											<th id=""></th>
											<th id="total_ordered"></th>
											<th id=""></th>
                                            <th id="total_sub"></th>
                                            <th>-</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <!--<div class="col-sm-7">
										<div class="form-group">
											<label class="control-label col-sm-4">Custom Cost</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="custom_cost" min="0" name="custom_cost" >
												<p class="error-sms">{{ $errors->first('custom_cost') }}</p>
											</div>  
										</div>
										<div class="form-group">
											<label class="control-label col-sm-4">Transport Cost</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="transport_cost" min="0" name="transport_cost" >
												<p class="error-sms">{{ $errors->first('transport_cost') }}</p>
											</div>  
										</div>
										<div class="form-group">
											<label class="control-label col-sm-4">Other Amount</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="other_cost" min="0" name="other_cost" >
												<p class="error-sms">{{ $errors->first('other_cost') }}</p>
											</div>  
										</div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="discount">Discount</label>
                                            <div class="col-sm-8 ">
												<input type="text" class="form-control" min="0" value="0" name="discount" id="discount">
												<p class="error-sms">{{ $errors->first('discount') }}</p>
											</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Discount Type</label>
                                            <div class="col-sm-8 ">          
                                                <select class="form-control" id="discount_type" name="discount_type">
                                                    <option> Fixed</option>
                                                    <option>Percentage </option>
                                                </select>
												<p class="error-sms">{{ $errors->first('discount_type') }}</p>
                                            </div>
                                        </div>
										<div class="form-group">
											<label class="control-label col-sm-4">Payment Amount</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="payment" min="0" name="payment" >
												<p class="error-sms">{{ $errors->first('payment') }}</p>
											</div>  
										</div>
                                    </div>-->
									<div class="col-sm-3"></div>
                                    <div class="col-sm-6">
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
													<th><span class="pull-right" id="total_value"></span></th>
												</tr>
												<!--<tr>    
													<th>Discount: </th>
													<th> <span class="pull-right" id="total_discount">0</span></th>
												</tr>-->
												<tr>
													<th>Grand Total: </th>
													<th><span class="pull-right" id="grand_total"></span></th>
												</tr>
												<!--<tr>
													<th>Due Amount: </th>
													<th>  <span class="pull-right" id="due"></span></th>
												</tr>-->
											</tfoot>
										</table>
                                    </div>
									<div class="col-sm-3"></div>
									
                                </div>
								<hr/>
									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
										  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
										  <button type="submit" class="btn btn-xs btn-success">Save</button>
										</div>
									</div>
								<br/>
								<br/>
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
			direction:1,
		});
		// select2 section
		$('.select2').select2()	;
	
		/*-------------search order section-------------------*/
		 $("#order_no").on("change",function(){
			//alert($(this).val())
			$("#orderSearch").submit(); 
		})
	/*-----------add product item section--------------*/
	  
		$('#warehouse_id').change(function(){
			var warehouse = $(this).val();
			var token = "{{csrf_token()}}";
				$.ajax({
					url: '{{ route('admin.wastage_return.productList3') }}',
					type: 'GET',
					data: {warehouse:warehouse,'_token' : token},
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
	  /*---------------------------*/
		var array = [];
        var total_tax = 0;
        var tax_type = "Fixed";
        var sl = 0
        $("#product").change(function () {
            var id = $(this).val();
           // $("#product").attr('disabled', true);
            var token = "{{csrf_token()}}";
		//alert(id)
            $.ajax({
                url: '{{ route('admin.wastage_return.productDetails3') }}',
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
                    var product_id = response['product_id'];  
					var name = response['product']['product_name']; 					              
                    var category_id =  response['category_id'];
                    var brand_id =  response['brand_id'];
                    var unit_id =  response['unit_id'];
                    var model_no =  response['model_no'];
                    var purchase_price =  response['purchase_price'];
                    var now_stock =  response['now_stock'];
					var warehouse = response['warehouse']['warehouse_name'];
					var rack_no = response['rack_no'];
                    var ordered_quantity =  1;
                    var sub_total =  purchase_price*ordered_quantity;

                    $("#product-table tbody").append(
                        "<tr id='"+id+"'>"
                          +"<td>"+(sl++)+"</td>"
                          +"<td>"
						  +"<input type='hidden' name='purchase_detail_id[]' value='"+id+"' />"
						  +"<input type='hidden' name='product_id[]' value='"+product_id+"' />"
						  +"<input type='hidden' name='category_id[]' value='"+category_id+"'/>"
						  +"<input type='hidden' name='brand_id[]' value='"+brand_id+"'/>"
						  +"<input type='hidden' name='unit_id[]' value='"+unit_id+"'/>"+name+" </td>"
						  +"<td><input type='hidden' name='model_no[]' value='"+model_no+"' />"+model_no+" </td>"
                          +"<td>"+warehouse+" </td>"
                          +"<td><input type='hidden' name='rack_no[]' value='"+rack_no+"' />"+rack_no+"</td>"
                          +"<td id='"+id+"_stock'>"+now_stock+"</td>"
						  +"<td><input type='text' id='"+id+"_ordered_quantity' class='ordered_quantity' name='return_quantity[]' min='1' value='"+ordered_quantity+"' size='10' /></td>"
						  +"<td><input id='"+id+"_price' type='text' name='return_price[]' class='supplier_price' value='"+purchase_price+"' size='10'/></td>"
						 // +"<td><input type='text' name='sale_price[]' value='"+sale_price+"' size='10'></td>"
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
            var stock = $('#'+id+'_stock').html();
            var price = $('#'+id+'_price').val() || 0;
            var quantity = $('#'+id+'_ordered_quantity').val() || 0;
			
	        if(parseInt(stock) >= parseInt(quantity)){
				var sub_total =  price*quantity;
	            $('#'+id+'_sub_total').html(sub_total);
	            calculate_ordered_quantity();
	            calculate_sub_total();
	            calculate_total();
	        }else{
	        	alert('Purchase Quantity is lower than Return Quantity!!');
	        	$('#'+id+'_sub_total').empty();
				$('#'+id+'_ordered_quantity').val('');
				 calculate_ordered_quantity();
	            calculate_sub_total();
	            calculate_total();
	        }
        });
		$(document).on('keyup','.supplier_price',function(){
            var id = $(this).parent().parent().attr('id');
            var price = $('#'+id+'_price').val();
            var quantity = $('#'+id+'_ordered_quantity').val() || 0;
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
		
		$(document).on('keyup','#payment',function(){
            calculate_discount();
            calculate_grand_total();
			calculate_due();
        });
       
        function calculate_ordered_quantity(){
            var total_ordered = 0;
            //iterate through each td based on class and add the values
            $(".ordered_quantity").each(function() {
                var value = parseFloat($(this).val() || 0);
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
            //iterate through each td based on class and add the values
            $(".sub_total").each(function() {
                var value = parseFloat($(this).html() || 0);
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