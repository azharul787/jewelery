@extends('layouts.backend.master')

@section('title', 'Order')

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
					<h4 class="widget-title">Order Entry</h4>
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
						<form action="{{route('admin.order.store')}}" method="post" class="form-horizont" role="form" >
							@csrf
							<div class="row">
								<div class="col-sm-3">	
									<div class="form-group">
										<label>Customer Search<span class="required">*</span></label>
										<input class="typeahead scrollable input-sm" type="text" id="customer_name" name="customer_name" placeholder="Customer Name & Phone" required style="width: 100%" />
										<input type="hidden" name="customer_id" id="customer_id">
										<p class="error-sms">{{ $errors->first('customer_name') }}</p>
									</div>
									<div class="form-group">
										<label>Per 10 Gram Price <span class="required">*</span></label>
										<input type="text" id="per_10_gram_price" name="gross_price" class="form-control input-sm" value="{{setting()->per_10_gm_price}}">
										<p class="error-sms">{{ $errors->first('gross_price') }}</p>

									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label> Phone <span class="required">*</span></label>
										<input type="text" name="customer_phone" id="customer_phone" class="form-control input-sm" placeholder="01xxxxxxxx" required>
										<p class="error-sms">{{ $errors->first('customer_phone') }}</p>
									</div>
									<div class="form-group">
										<label>Per Gram Price</label>
										<input type="text" id="per_gram_price" name="per_rote_price" class="form-control per_rote_price input-sm" readonly="readonly">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label>Address</label>
										<input type="text" name="address" id="address" class="form-control input-sm" placeholder="Your Address">
										<p class="error-sms">{{ $errors->first('address') }}</p>
									</div>
									<div class="form-group">
										<label> Order No <span class="required">*</span></label>
										<input type="text" name="order_no"  class="form-control input-sm" value="{{old('order_no') ?? $order_no}}" placeholder="Order No">
										<p class="error-sms">{{ $errors->first('order_no') }}</p>
									</div>
								</div>
                                <div class="col-sm-3">
									<div class="form-group">
										<label> Order Date <span class="required">*</span></label>
										<input id="datepicker" type="text" name="order_date"  class="form-control datepicker  input-sm" data-zdp_readonly_element="true" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy">
										<p class="error-sms">{{ $errors->first('order_date') }}</p>
									</div>
									<div class="form-group">
										<label> Delivery Date <span class="required">*</span></label>
										<input id="datepicker2" type="text" name="delivery_date"  class="form-control datepicker input-sm" data-zdp_readonly_element="true" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy">
										<p class="error-sms">{{ $errors->first('order_date') }}</p>
									</div>
								</div>
								<!--<div class="col-sm-2">	
									<div class="form-group">
										<label > Note</label>
										<input type="text" name="note"  class="form-control" placeholder="Note About this Purchase">
										<p class="error-sms">{{ $errors->first('note') }}</p>
									</div>
								</div>-->
							</div>
							<hr/>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-3">
                                    <div class="form-group ">
                                        <label>Select Type <span class="required">*</span></label>
                                        <select class="form-control select2" name="type_id" id="type">
                                            <option value="">- Select Type -</option>
                                            @foreach($types as $ty)
                                            <option value="{{ $ty->id }}"> {{ $ty->type_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>     
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Select Product <span class="required">*</span></label>
                                        <select class="form-control select2" name="product_name" id="product">
											<option value="">-Select Product-</option>
                                        </select>
                                    </div>  
                                </div>
								<div class="col-sm-3"></div>
                            </div>
                            <table class="table table-bordered green" id="sale">
                                <thead class="info">
                                    <tr>
                                        <th class="all">SL </th>
                                        <th class="all">Product </th>
                                        <th class="all">Category </th>
                                        <th class="all">Type</th>
										<th class="all">Caret</th>
                                        <th class="all">Weight(gm)</th>
                                        <th class="all">Wage</th>
                                        <th class="all">Sub Total</th>
                                       <th class="all">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    	<th>-</th>
                                        <th class="all" colspan="4">Total</th>
										<th id="total_ordered">0</th>
										<th id="total_wage">0</th>
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
									<input type="hidden" id="total_price" name="total_price"  />
									<input type="hidden" class="due" name="due"  />
                                </div>
                            </div>
                            <hr>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
								  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
								  <button type="submit" class="btn btn-xs btn-success">Save</button>
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
		 $('.datepicker').Zebra_DatePicker({
			format: 'd-m-Y',
			direction:1,
		});
		// select2 section
		$('.select2').select2();
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
		/*-------calculate per gram price---------*/
		var per_gram = 0;
		calculate_per_gram();
		$('#per_10_gram_price').keyup(function(){
			calculate_per_gram();
		});
		function calculate_per_gram(){
			var total = $('#per_10_gram_price').val() || 0;
			per_gram = total / 10 ;
			$('#per_gram_price').val(per_gram);
		}
		/***-------------------------------*/
		$("#type").change(function () {
            var type = $(this).val();
            var token = "{{csrf_token()}}";
			if(per_gram != 0 ){
				$.ajax({
					url: '{{ route('admin.order.productList5') }}',
					type: 'post',
					data: {type:type,'_token' : token},
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
						for (var i = 0; i < len; i++) {
							var id = response[i]['id'];
							var name = response[i]['product_name'];
							var part_no = response[i]['model_no'];
							var disable = "";
							$("#product").append("<option " + disable + " value='" + id + "'>"+name+" ( "+part_no+" )</option>");
						}
					}
				});
			}
			else{
				alert('Please Input Per 10 Gram Price!!')
			}
        });

		var array = [];
        var total_tax = 0;
        var tax_type = "Fixed";
        var sl = 1
        $("#product").change(function () {
            var id = $(this).val();
           // $("#supplier").attr('disabled', true);
            var token = "{{csrf_token()}}";

            $.ajax({
                url: '{{ route('admin.order.productDetails5') }}',
                type: 'post',
                data: {id: id, '_token' : token},
                dataType: 'json',
                success: function (response) {
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
                    var category_name = response['category']['category_name'];               
                    var type_name = response['type']['type_name'];               
                    //var unit_name = response['unit']['unit_name'];               
                   // var sale_price =  response['sale_price'];
                    var weight =  1;
                    var wage = {{setting()->customer_wage_per_gram}};
                    var total_price = parseFloat(per_gram) * weight;
                    var total_wage =  parseFloat(weight) * parseFloat(wage);
                    var sub_total =  total_price + total_wage;

                    $("#sale tbody").append(
                        "<tr id='"+id+"'>"
                          +"<td>"+(sl++)+"</td>"
                          +"<td><input type='hidden' name='product_id[]' value='"+id+"' />"+name+" </td>"
                          +"<td><input type='hidden' name='category_name[]' value='"+category_name+"' />"+category_name+" </td>"
                          +"<td><input type='hidden' name='type_name[]' value='"+type_name+"' />"+type_name+" </td>"
                          +"<td>"
                          	+"<select name='caret_id[]'' class='form-control' required='required'>"
                					@foreach($carets as $cr)
                						+"<option value='{{$cr->id}}'>{{$cr->caret_name}}</option>"
                					@endforeach
                				+"</select>"
                          +"</td>"
                          //order quantity
                          +"<td><input type='text' id='"+id+"_weight' class='weight' name='weight[]' min='1' value='"+weight+"' size='10' /></td>"
						  +"<td><input id='"+id+"_wage' type='text' name='wage[]' class='wage' value='"+wage+"' size='10'/></td>"
                         //price
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
                    /*--------calculate total wage------*/
                    var total_wage = parseFloat($('#total_wage').html());
                    total_wage = total_wage + 0;
                    $('#total_wage').html(total_wage);

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

           // $('#product').select2("destroy").select2({placeholder:"",width:"auto",allowClear:!0});

            calculate_ordered_quantity();

            calculate_sub_total();

            calculate_total();
        });

        $(document).on('keyup','.weight',function(){
            var id = $(this).parent().parent().attr('id');
            var wage = $('#'+id+'_wage').val();
            var weight = $('#'+id+'_weight').val();
            //(per_gram * weight) + (per_gram * parseFloat(wage));
            var sub_total =  (weight * parseFloat(wage))+(weight*per_gram);
            $('#'+id+'_sub_total').html(sub_total);

            calculate_ordered_quantity();
            calculate_sub_total();
            calculate_total();
        });
		$(document).on('keyup','.wage',function(){
            var id = $(this).parent().parent().attr('id');
            var wage = $('#'+id+'_wage').val();
            var weight = $('#'+id+'_weight').val();
           // var stock = $('#'+id+'_stock').val();
			
				var sub_total =  (weight * parseFloat(wage))+(weight*per_gram);

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
            $(".weight").each(function() {
                var value = parseFloat($(this).val());
                total_ordered = total_ordered + value;
            });
            $('#total_ordered').html(total_ordered);
			// calculate total wage
            var total_wage = 0;
            $(".wage").each(function() {
                var wg = parseFloat($(this).val());
                total_wage = total_wage + wg;
            });
            $('#total_wage').html(total_wage);
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
	})
	</script>
@endpush									