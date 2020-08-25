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
					<h4 class="widget-title">New Invoice</h4>
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
						<form action="{{route('admin.sale.store')}}" id="myForm" method="post" class="form-" role="form" >
							@csrf
							<div class="row">
								<div class="col-sm-3">	
									<div class="form-group">
										<label>Customer Search<span class="required">*</span></label>
										<input class="typeahead scrollable input-sm" type="text" id="customer_name" name="customer_name" placeholder="Customer Name & Phone" required />
										<input type="hidden" name="customer_id" id="customer_id">
										<p class="error-sms">{{ $errors->first('customer_name') }}</p>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label> Phone</label>
										<input type="text" name="customer_phone" id="customer_phone" class="form-control" placeholder="01xxxxxxxx">
										<p class="error-sms">{{ $errors->first('customer_phone') }}</p>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label > Invoice No <span class="required">*</span></label>
										<input type="text" name="invoice_no"  class="form-control" value="{{$inv_no}}" placeholder="Invoice No" readonly>
										<p class="error-sms">{{ $errors->first('invoice_no') }}</p>
									</div>
								</div>
								<div class="col-sm-2">	
									<div class="form-group">
										<label> Date <span class="required">*</span></label>
										<input id="datepicker" type="text" name="sale_date"  class="form-control" data-zdp_readonly_element="true" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy">
										<p class="error-sms">{{ $errors->first('sale_date') }}</p>
									</div>
								</div>
							</div>	
							<div class="row">	
								
								<!--<div class="col-sm-8">
									<div class="form-group">
										<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Note</label>
										<div class="col-sm-11">
											<input type="text" name="note"  class="form-control" placeholder="Note About this Purchase">
											<p class="error-sms">{{ $errors->first('note') }}</p>
										</div>
									</div>
								</div>-->
							</div>
							<hr/>
							<div class="row">
								<div class="col-sm-2"></div>
								<div class="col-sm-2">
									<label>Input Code</label>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<!--<input type="text" class="form-control" name="model_no" placeholder="Input Code" id="bar_code" autofocus onfocusout="myFunction(event)">-->
										<input type="text" class="form-control" name="model_no" placeholder="Input Code" id="bar_code"  autocomplete='off' tabindex="1">
									</div>
								</div>
								<div class="col-sm-2"></div>
							</div>
                                <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive green" id="sale">
                                    <thead class="info">
                                        <tr>
                                            <th class="all">SL </th>
                                            <th class="all">Product </th>
											<th class="all">Code No </th>
                                            <th class="all">Category </th>
                                            <th class="all">Brand </th>
                                            <th class="all">Unit </th>
                                            <th class="all">Stock</th>
                                            <th class="all">Quantity</th>
                                            <th class="all">Sale Price</th>
											<th class="all">Discount</th>
                                            <th class="all">Sub Total</th>
                                            <th class="all">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="all" colspan="4">Total</th>
                                            <th id="supplier_price"></th>
											<th id="model_no"></th>
											<th id="">-</th>
											<th id="total_ordered">0</th>
                                            <th id="">-</th>
                                            <th id="single_total_dis">0</th>
                                            <th id="total_sub">0</th>
                                            <th>-</th>
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
											<label class="control-label col-sm-4">Grand Total</label>
											<div class="col-md-8">
												<input type="number" class="form-control grand_total" id="" min="0" readonly name="grand_total" >
												<p class="error-sms">{{ $errors->first('grand_total') }}</p>
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
										<input type="hidden" id="total_price" class="total_price" name="total_price"  />
										<input type="hidden" class="due" name="due"  />
                                    </div>
                                </div>
                               <hr/>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
										<a href="{{route('admin.sale.index')}}" class="btn btn-danger btn-xs">Cancel</a>
									  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
									  <button type="button" id="saveBtn" class="btn btn-xs btn-success">Save</button>
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
	<script src="{{ asset('myfile/backend/assets/js/jquery-typeahead.js') }}"></script>
<script>
	$(document).ready(function() 
	  {
		 $('#datepicker').Zebra_DatePicker({
			format: 'd-m-Y',
			direction: -1,
		});
		// select2 section
		$('.select2').select2();
		/*---------form submit section-------------*/

		$(document).on('click','#saveBtn',function(){
			var customer = $("#customer_name").val();
			var payment = $("#payment").val();
			if(customer != '' && payment != ''){
				$("#myForm").submit();
			}
			else{
				alert('Please Input Customer and payment')
			}
		})

		/*--------------customer search and show section------------------*/
		var substringMatcher = function(strs) {
			return function findMatches(q, cb) {
				var matches, substringRegex;
				matches = [];
				substrRegex = new RegExp(q, 'i');
				$.each(strs, function(i, str) {
					if (substrRegex.test(str)) {
						matches.push({ value: str });
					}
				});
				cb(matches);
			}
		}
		var token = "{{csrf_token()}}";
		$.ajax({
			url: '{{ route('admin.sale.customerList') }}',
			type: 'Get',
			data: {'_token' : token},
			dataType: 'json',
			success: function (response) {
				$('input.typeahead').typeahead({
					hint: true,
					highlight: true,
					minLength: 1
				 }, 
				{
					name: 'response',
					displayKey: 'value',
					//source: substringMatcher(ace.vars['US_STATES']),
					source: substringMatcher(response),
					limit: 10
				});
			}
		});		
	
		/*-------------------Customer Details search section-------------------------*/
		$(document).on('focusout','#customer_name',function(){
			getCustomer();
		});
		$(document).on('click','.tt-suggestion.tt-selectable', function(){
			getCustomer();
		})
		/*-------if press eneter this function is not working----------*/
		/*$(document).on('click','.tt-suggestion.tt-selectable', function(event){
			var x = event.which || event.keyCode;
			alert(x)
		})*/
		/*-----------*/
		function getCustomer(){
			var customer = $('#customer_name').val();
			if(customer != ''){
				var token = "{{csrf_token()}}";
				$.ajax({
					url: '{{ route('admin.sale.customerDetails') }}',
					type: 'GET',
					data: {customer:customer, '_token' : token},
					dataType: 'json',
					success: function (response) {	
						if(response != ''){
							//console.log(response)
							$('#customer_id').val(response.id)
							$('#customer_name').val(response.customer_name)
							$('#customer_phone').val(response.customer_phone)
							//$('#customer_address').val(response.customer_address)
						}
					}
				});
			}
		}
	});
		/*----------customer search and show end section------------*/
		/***--------------search product by barcode scan-----------------*/
	
		
		var array = [];
        var total_tax = 0;
        var tax_type = "Fixed";
		var SL = 1;
    //$("#product").change(function () {
   // $("#myForm").submit(function (e) {
	//$(document).on('focusout','#bar_code',function(e){
	//$("#bar_code").focusout(function(e){
	//function myFunction(e){	
	 //  e.preventDefault();

		$('#bar_code').keydown(function (e) {

        if (e.keyCode == 13) {
			var id = $('#bar_code').val();
			//var id = $(this).val();
			//console.log(id);
			//alert(id)
			var token = "{{csrf_token()}}";
			if(id != ''){
				$.ajax({
					url: '{{ route('admin.sale.productDetails2') }}',
					type: 'Get',
					data: {id: id, '_token' : token},
					dataType: 'json',
					success: function (response) {
				if(response['id'] == undefined){
					//alert('Woops!, No Product Found')
					console.log(response)
				}else{
					//console.log(response)
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
							  +"<td class='text-center'><i class=' fa fa-trash red fa-lg'></i></td>"
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

						/*---------empty the input field---------*/
						$('#bar_code').val('');
						$('#bar_code').focus();
					}
				}
				});
			}
			}

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
	//})
	</script>
@endpush									