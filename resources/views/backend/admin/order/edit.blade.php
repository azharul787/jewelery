@extends('layouts.backend.master')

@section('title', 'Order Edit')

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
                        <a href="{{ route('admin.order.index')}}" calss="btn" >
                            <i class="fa fa-mail-reply"></i>
                        </a>
                        Order Edit
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
						<form action="{{route('admin.order.update',$order->id)}}" method="post" class="form-horizont" role="form" >
							@csrf
                            @method('PUT')
								<div class="row">
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Supplier Name <span class="required">*</span></label>
											<div class="col-sm-9">
												<select name="supplier_name"  class="form-control select2" required="required">
													<option value="{{$order->supplier_id}}">{{$order->supplier->supplier_name}}</option>
													{{--<!--@foreach($suppliers as $sup)
														<option value="{{$sup->id}}" {{$sup->id == $order->supplier_id ? 'Selected' : ''}}>{{$sup->supplier_name}}</option>
													@endforeach-->--}}
												</select> 
												<p class="error-sms">{{ $errors->first('supplier_name') }}</p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Order No <span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="order_no"  class="form-control" value="{{old('order_no') ?? $order->order_no}}" readonly placeholder="Order No">
												<p class="error-sms">{{ $errors->first('order_no') }}</p>
											</div>
										</div>
									</div>
                                    <div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Order Date <span class="required">*</span></label>
											<div class="col-sm-9">
												<input id="datepicker" type="text" name="order_date"  class="form-control" data-zdp_readonly_element="true" value="{{ date('d-m-Y', strtotime($order->order_date))}}" placeholder="dd-mm-yyyy">
												<p class="error-sms">{{ $errors->first('order_date') }}</p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Note</label>
											<div class="col-sm-9">
												<input type="text" name="note"  class="form-control" value="{{ old('note') ?? $order->note}}" placeholder="Note About this Purchase">
												<p class="error-sms">{{$errors->first('note')}}</p>
											</div>
										</div>
									</div>
								</div>
								<hr/>
								{{--<!-- <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                <label>Select Category</label>
                                                <select class="form-control select2" name="category_id" id="category">
                                                    <option value="">- Select Category -</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"> {{ $category->category_name }} </option>
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
                                    </div>-->--}}
                                
                                <table class="table table-bordered table-hover table-header-fixed dt-responsive green" id="sale">
                                    <thead class="info">
                                        <tr>
                                            <th class="all">SL </th>
                                            <th class="all">Product </th>
                                            <th class="all">Category </th>
                                            <th class="all">Brand </th>
											<th class="all">Part No </th>
                                            <th class="all">Quantity</th>
                                            <th class="all">MRP Rate</th>
                                            <th class="all">Sub Total</th>
                                           <!--<th class="all">Delete</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->details as $key=>$detail)
                                            <tr id='{{$detail->id}}'>
                                              <td><input type='hidden' name='order_detail_id[]' value='{{$detail->id}}' />{{$key + 1}}</td>
                                              <td><input type='hidden' name='product_id[]' value='{{$detail->product_id}}' />{{$detail->product->product_name}}</td>
                                              <td><input type='hidden' name='category_name[]' value='{{$detail->category_id}}' />{{$detail->category->category_name}}</td>
                                              <td><input type='hidden' name='brand_name[]' value='{{$detail->brand_id}}' />{{$detail->brand->brand_name}}</td>
                                              <td><input type='hidden' name='model_no[]' value='{{$detail->model_no}}' />{{$detail->model_no}}</td>
                                              <td><input type='text' id='{{$detail->id}}_ordered_quantity' class='ordered_quantity' name='ordered_quantity[]' min='1' value='{{$detail->quantity}}' size='10' /></td>
                                              <td><input id='{{$detail->id}}_price' type='hidden' name='supplier_price[]' class='supplier_price' value='{{$detail->rate}}' size='10'/>{{$detail->rate}}</td>
                                              <td class='sub_total' id='{{$detail->id}}_sub_total'>{{$detail->quantity * $detail->rate}}</td>
                                              <!--<td class='text-center'><i class='red fa fa-trash fa-lg'></i></td>-->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        	<th>-</th>
                                            <th class="all" colspan="3">Total</th>
											<th>-</th>
											<th id="total_ordered">0</th>
                                            <th>-</th>
											<th id="total_sub">0</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-sm-7">
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
											<label class="control-label col-sm-4">Payment Amount</label>
											<div class="col-md-8">
												<input type="number" class="form-control" id="payment" min="0" name="payment" >
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
													<th><span class="pull-right" id="total_items">0</span></th>
												</tr>
												<tr>
													<th> Total: </th>
													<th><span class="pull-right" id="total_value">0</span></th>
												</tr>
												<tr>    
													<th> Discount: </th>
													<th> <span class="pull-right" id="total_discount">0</span></th>
												</tr>
												<!--<tr>
													<th> Tax </th><th>  <span class="pull-right" id="total_tax">0</span></th>
												</tr>
												<tr>
													<th> Shipping </th><th>  <span class="pull-right" id="total_shipping">0</span></th>
												</tr>-->
												<tr>
													<th> Grand Total: </th>
													<th>  <span class="pull-right" id="grand_total">0</span></th>
												</tr>
												<tr>
													<th> Due: </th>
													<th>  <span class="pull-right" id="due">0</span></th>
												</tr>
											</tfoot>
										</table>
										<input type="hidden" class="grand_total" name="grand_total"  />
										<input type="hidden" class="due" name="due"  />
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
			direction:1,
		});
		// select2 section
		$('.select2').select2();
		/*------call the function--------*/
		calculate_ordered_quantity();
		calculate_sub_total();
		calculate_total();
		/***-------------------------------*/
		/*$("#category").change(function () {
            var category = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.purchase.productList') }}',
                type: 'post',
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
                        var part_no = response[i]['model_no'];
                        var disable = "";
                        $("#product").append("<option " + disable + " value='" + id + "'>"+name+" ( "+part_no+" )</option>");
                    }
                }
            });
        });

		var array = [];
        var total_tax = 0;
        var tax_type = "Fixed";
        var sl = 1
        $("#product").change(function () {
            var id = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.purchase.productDetails') }}',
                type: 'post',
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
                    var category_name = response['category']['category_name'];               
                    var brand_name = response['brand']['brand_name'];               
                    var unit_name = response['unit']['unit_name'];               
                    var model_no =  response['model_no'];
                    var supplier_price =  response['supplier_price'];
                    var sale_price =  response['sale_price'];
                    var ordered_quantity =  1;
                    var sub_total =  supplier_price*ordered_quantity;

                    $("#sale tbody").append(
                        "<tr id='"+id+"'>"
                          +"<td>"+(sl++)+"</td>"
                          +"<td><input type='hidden' name='product_id[]' value='"+id+"' />"+name+" </td>"
                          +"<td><input type='hidden' name='category_name[]' value='"+category_name+"' />"+category_name+" </td>"
                          +"<td><input type='hidden' name='brand_name[]' value='"+brand_name+"' />"+brand_name+" </td>"
                          +"<td><input type='hidden' name='model_no[]' value='"+model_no+"' />"+model_no+" </td>"
                           +"<td><input type='text' id='"+id+"_ordered_quantity' class='ordered_quantity' name='ordered_quantity[]' min='1' value='"+ordered_quantity+"' size='10' /></td>"
						  +"<td><input id='"+id+"_price' type='text' name='supplier_price[]' class='supplier_price' value='"+supplier_price+"' size='10'/></td>"
                         
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
            var sub_total =  price*quantity;

            $('#'+id+'_sub_total').html(sub_total);

            calculate_ordered_quantity();
            calculate_sub_total();
            calculate_total();
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

        function calculate_grand_total(){
			
           // var grand_total = parseFloat($('#total_value').html())-parseFloat($('#total_discount').html())+parseFloat($('#total_tax').html())+parseFloat($('#total_shipping').html());
            var grand_total = parseFloat($('#total_value').html())-parseFloat($('#total_discount').html());
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
	})
	</script>
@endpush									