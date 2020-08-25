@extends('layouts.backend.master')

@section('title', 'Sale Return')

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
						<a href="{{ route('admin.sale_return.index')}}" calss="btn" >
						<i class="fa fa-mail-reply"></i>
						</a> Sale Return List
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
						<form action="{{route('admin.sale_return.store')}}" method="post" class="form-horizontal" role="form" >
							@csrf
								<div class="row">
                                    <div class="col-sm-4">
										<div class="form-group">
											<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Customer Name *</label>
											<div class="col-sm-8">
												<input type="hidden" name="customer_id" value="{{$sl->customer_id}}"> 
												<input type="text" class="form-control" name="customer_name" value="{{$sl->customer->customer_name}}" readonly> 
												<p class="error-sms">{{ $errors->first('customer_name') }}</p>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Phone</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="phone" value="{{$sl->customer->customer_phone}}" readonly> 
												<p class="error-sms">{{ $errors->first('customer_phone') }}</p>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Address</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="customer_address" value="{{$sl->customer->customer_address}}" readonly> 
												<p class="error-sms">{{ $errors->first('customer_address') }}</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Invoice No *</label>
											<div class="col-sm-8">
												<input type="text" name="invoice_no"  class="form-control" value="{{old('invoice_no') ?? $sl->invoice_no}}" placeholder="Invoice No" readonly>
												<p class="error-sms">{{ $errors->first('invoice_no') }}</p>
											</div>
										</div>
									</div>
                                    <div class="col-sm-4">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date *</label>
											<div class="col-sm-9">
												<input id="datepicker" type="text" name="sale_date"  class="form-control" data-zdp_readonly_element="true" value="{{ date('d-m-Y',strtotime($sl->sale_date))}}" placeholder="dd-mm-yyyy" readonly="">
												<p class="error-sms">{{ $errors->first('sale_date') }}</p>
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
								<hr/>
                                <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive green" id="sale">
                                    <thead class="info">
                                        <tr>
                                            <th class="all">SL</th>
                                            <th class="all">Product </th>
                                            <th class="all">Category </th>
                                            <th class="all">Brand </th>
											<th class="all">Part No </th>
                                            <th class="all">Sold.Qty</th>
                                            <th class="all">Return Qty</th>
                                            <th class="all">Discount</th>
                                            <th class="all">Return Price</th>
                                            <th class="all">Sub Total</th>
                                            <th class="all">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($sl->saleDetail as $key=>$pur)
                                    		<tr id="{{$pur->id}}">
                                    			<td>{{$key + 1}}</td>
                                    			<td>
                                    				<input type='hidden' name="product_id[]" value="{{$pur->product_id}}"> 
                                    				<input type='hidden' name="sale_detail_id[]" value="{{$pur->id}}"> 
                                    				<input type='hidden' name="category_id[]" value="{{$pur->category_id}}"> 
                                    				<input type='hidden' name="brand_id[]" value="{{$pur->brand_id}}"> 
                                    				<input type='hidden' name="unit_id[]" value="{{$pur->unit_id}}"> 
                                    				<input type='hidden' name="model_no[]" value="{{$pur->product->model_no}}"> 
                                    				<input type='hidden' name="sale_price[]" value="{{$pur->unit_price}}"> 
                                    				<input type='hidden' name="warehouse_id[]" value="{{$pur->warehouse_id}}"> 
                                    				<input type='hidden' name="rack_no[]" value="{{$pur->rack_no}}"> 
                                    				{{$pur->product->product_name}}
                                    			</td>
                                    			<td>{{$pur->category->category_name}}</td>
                                    			<td>{{$pur->brand->brand_name}}</td>
                                    			<td>{{$pur->product->model_no}}</td>
                                    			<td  id='{{$pur->id}}_stock'>{{$pur->quantity - $pur->return_qty}}</td>
                                    			<td><input type="text" name="return_quantity[]" id='{{$pur->id}}_ordered_quantity' class='ordered_quantity' size="10"></td>
                                    			<td  id='{{$pur->id}}_discount'>{{$pur->discount}}</td>
												<td><input type="text" name="return_price[]" id='{{$pur->id}}_price' class='price' size="10" value="{{$pur->unit_price}}"></td>
                                    			<td id='{{$pur->id}}_sub_total' class="sub_total"></td>
                                    			<td>
                                    				<!--<input name="form-field-checkbox" type="checkbox" class="ace input-lg" />
													<span class="lbl bigger-120"></span>-->
													<i class='fa fa-trash fa-lg red'></i>
												</td>
                                    		</tr>
                                    	@endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="all" colspan="4">Total</th>
                                            <th id="supplier_price">0</th>
											<th id="model_no">0</th>
											<th id="total_ordered">0</th>
                                            <th id="">-</th>
                                            <th id="">-</th>
                                            <th id="total_sub">0</th>
                                            <th>-</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-sm-7">
                                    	<!--<div class="form-group">
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
										</div>-->
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="discount">Discount</label>
                                            <div class="col-sm-8 ">
                                              <input type="text" class="form-control" min="0" value="0" name="discount" id="discount">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Discount Type</label>
                                            <div class="col-sm-8 ">          
                                                <select class="chosen-select form-control " id="discount_type" name="discount_type">
                                                    <option> Fixed</option>
                                                    <option>Percentage </option>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-group">
											<label class="control-label col-sm-4">Grand Total</label>
											<div class="col-sm-8 "> 
												<input type="text" name="" class="form-control grand_total" id="grand_total2" readonly placeholder="Grand Total">
											</div>    
										</div>
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
												<!--<tr>
													<th>Custom Cost:</th><th>  <span class="pull-right" id="custom">0</span></th>
												</tr>
												<tr>
													<th>Trasport Cost:</th><th>  <span class="pull-right" id="transport">0</span></th>
												</tr>
												<tr>
													<th>Other Cost: </th><th>  <span class="pull-right" id="other">0</span></th>
												</tr>-->
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
										<input type="hidden" id="total_price" name="total_price"  />
										<input type="hidden" class="grand_total" name="grand_total"  />
										<input type="hidden" class="due" name="due"  />
                                    </div>
                                </div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
									  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
									  <button type="submit" class="btn btn-xs btn-success">Return</button>
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
			format: 'd-m-Y',
			direction:1,
		});
		// select2 section
		$('.select2').select2()	;

		var array = [];
        var total_tax = 0;
        var tax_type = "Fixed";

        $(document).on('click','.fa-trash',function(){
            var id = $(this).parent().parent().attr('id');
            $('#'+id).remove();

            $('#product_'+id).removeAttr('disabled');
            array.splice($.inArray(id, array), 1);

           // $('#product').select2("destroy").select2({placeholder:"",width:"auto",allowClear:!0});
            calculate_ordered_quantity();
            calculate_sub_total();
            calculate_total();
        });

        $(document).on('keyup','.ordered_quantity',function(){

            var id = $(this).parent().parent().attr('id');
            
            var stock = $('#'+id+'_stock').html();
            var price = $('#'+id+'_price').val() || 0;
            var quantity = $('#'+id+'_ordered_quantity').val();
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
		$(document).on('keyup','.price',function(){
            var id = $(this).parent().parent().attr('id');
            var price = $('#'+id+'_price').val() || 0;
            var quantity = $('#'+id+'_ordered_quantity').val() || 0;
            //var stock = $('#'+id+'_stock').val();
			
				var sub_total =  price*quantity;
				$('#'+id+'_sub_total').html(sub_total);
				calculate_ordered_quantity();
				calculate_sub_total();
				calculate_total();
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
 		/*$(document).on('keyup','#custom_cost',function(){
			calculate_discount();
            calculate_grand_total();
			calculate_due();
			calculate_total();
        });
 		$(document).on('keyup','#transport_cost',function(){
            calculate_discount();
            calculate_grand_total();
			calculate_due();
        });
  		 $(document).on('keyup','#other_cost',function(){
			calculate_discount();
            calculate_grand_total();
			calculate_due();
        });*/
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

        function calculate_grand_total(){
		
            var grand_total = parseFloat($('#total_value').html())-parseFloat($('#total_discount').html());
            $('#grand_total').html(grand_total);
            $('.grand_total').val(grand_total);
            $('#due').html(grand_total);
           
           
		   /* var grand_total = parseFloat($('#total_value').html())-parseFloat($('#total_discount').html() || 0);

            var custom = $('#custom_cost').val() || 0;
            var transport = $('#transport_cost').val() || 0;
            var other = $('#other_cost').val() || 0;
            var total_cost = (parseInt(custom) + parseInt(transport) + parseInt(other));
			grand_total = parseFloat(grand_total) + parseFloat(total_cost);
			$('#custom').html(custom);
			$('#transport').html(transport);
			$('#other').html(other);
			
            var paid = $('#paid_amount').html();
			var due = parseInt(grand_total) - parseInt(paid);
			
            $('#grand_total').html(grand_total);
            $('.grand_total').val(grand_total);
            $('#due').html(due);*/
        }

        function calculate_total(){
            var total_items = 0;            
            var total_sub = 0;
            //iterate through each td based on class and add the values
            $(".sub_total").each(function() {
                total_items++;
            });

            $('#total_items').html(total_items);
            $('#total_price').val($('#total_sub').html() || 0);
            $('#total_value').html($('#total_sub').html() || 0);

            calculate_discount();
           // calculate_tax();
            //calculate_shipping();
            calculate_grand_total();
        }
		// due section
		function calculate_due(){
			var pay = $('#payment').val() || 0 ;
			var grand_total = $('.grand_total').val() || 0;
			var due = parseInt(grand_total) - parseInt(pay);
			$('.due').val(due);
			$('#due').html(due);
		}
	})
	</script>
@endpush									