@extends('layouts.backend.master')

@section('title', 'Sale')

@push('css')
	<!-- select2 section-->
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/css/select2.min.css') }}" />
	<!-- date Calender-->
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/zebra_datepicker.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('myfile/backend/assets/datepicker/examples.css') }}" type="text/css">

@endpush

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Sale Entry</h4>
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
						<form action="{{route('admin.sale.store')}}" method="post" class="form-horizontal" role="form" >
							@csrf
						<div class="row">
								<div class="tabbable">
									<ul class="nav nav-tabs" id="myTab">
										<li class="active">
											<a data-toggle="tab" href="#home">
												<i class="green ace-icon fa fa-user bigger-120"></i>
												Old Customer
												<span class="badge badge-danger">{{$customers->count()}}</span>
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#messages">
												<i class="green ace-icon fa fa-plus bigger-120"></i>
												New Customer
											</a>
										</li>
									</ul>
									<div class="tab-content">
										<div id="home" class="tab-pane fade in active">
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Name*</label>
													<div class="col-sm-8">
														<select name="customer_id"  class="form-control select2">
															<option value="">-Select Customer Name-</option>
															@foreach($customers as $cus)
																<option value="{{$cus->id}}">{{$cus->customer_name}}</option>
															@endforeach
														</select> 
														<p class="error-sms">{{ $errors->first('customer_name') }}</p>
													</div>
												</div>
											</div>
											
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Phone</label>
													<div class="col-sm-9">
														<input type="text" name="customer_phone" id="customer_phone" class="form-control" placeholder="01xxxxxxxx" readonly>
														<p class="error-sms">{{ $errors->first('customer_phone') }}</p>
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email</label>
													<div class="col-sm-9">
														<input type="text" name="email_phone" id="email_phone" class="form-control" placeholder="example@domain.com" readonly>
														<p class="error-sms">{{ $errors->first('email_phone') }}</p>
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Address</label>
													<div class="col-sm-10">
														<input type="text" name="customer_address" id="customer_address"  class="form-control" placeholder="Customer Address" readonly>
														<p class="error-sms">{{ $errors->first('customer_address') }}</p>
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Invoice No *</label>
													<div class="col-sm-8">
														<input type="text" name="invoice_no"  class="form-control" value="{{$inv_no}}" placeholder="Invoice No" readonly>
														<p class="error-sms">{{ $errors->first('invoice_no') }}</p>
													</div>
												</div>
											</div>
											<div class="col-sm-3">	
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date *</label>
													<div class="col-sm-9">
														<input id="datepicker" type="text" name="sale_date"  class="form-control" data-zdp_readonly_element="false" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy">
														<p class="error-sms">{{ $errors->first('sale_date') }}</p>
													</div>
												</div>
											</div>
											
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Note</label>
													<div class="col-sm-11">
														<input type="text" name="note"  class="form-control" placeholder="Note About this Purchase">
														<p class="error-sms">{{ $errors->first('note') }}</p>
													</div>
												</div>
											</div>
										</div>
										<div id="messages" class="tab-pane fade">
										<div class="row">
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Name *</label>
													<div class="col-sm-9">
														<input type="text" name="customer_name"  class="form-control" value="{{old('customer_name')}}" placeholder="Customer Name" >
														<p class="error-sms">{{ $errors->first('customer_name') }}</p>
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Phone*</label>
													<div class="col-sm-9">
														<input type="text" name="customer_phone" id="" class="form-control" placeholder="01xxxxxxxx" >
														<p class="error-sms">{{ $errors->first('customer_phone') }}</p>
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Distric*</label>
													<div class="col-sm-8">
														<select name="distric_id" id="distric_id" class="form-control select2">
															<option value="">-Select Distric-</option>
															@foreach($districs as $dis)
																<option value="{{$dis->id}}">{{$dis->distric_name}}</option>
															@endforeach
														</select> 
														<p class="error-sms">{{ $errors->first('distric_name') }}</p>
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Upozila*</label>
													<div class="col-sm-8">
														<select name="upozila_id" id="upozila_id" class="form-control select2">
															<option value="">-Select Upozila-</option>
															
														</select> 
														<p class="error-sms">{{ $errors->first('upozila_id') }}</p>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Union*</label>
													<div class="col-sm-10">
														<select name="union_id" id="union_id" class="form-control select2">
															<option value="">-Select Union-</option>
															
														</select> 
														<p class="error-sms">{{ $errors->first('union_id') }}</p>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Address</label>
													<div class="col-sm-10">
														<input type="text" name="customer_address" id="" value="{{old('customer_address')}}" class="form-control" placeholder="Customer Address" >
														<p class="error-sms">{{ $errors->first('customer_address') }}</p>
													</div>
												</div>
											</div>
										</div>
										<div class="row">	
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Invoice No *</label>
													<div class="col-sm-8">
														<input type="text" name="invoice_no"  class="form-control" value="{{$inv_no}}" placeholder="Invoice No" readonly>
														<p class="error-sms">{{ $errors->first('invoice_no') }}</p>
													</div>
												</div>
											</div>
											
											<div class="col-sm-3">
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date *</label>
													<div class="col-sm-9">
														<input id="datepicker" type="text" name="sale_date"  class="form-control" data-zdp_readonly_element="false" value="{{ date('d-m-Y')}}" placeholder="dd-mm-yyyy">
														<p class="error-sms">{{ $errors->first('sale_date') }}</p>
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
									</div>
								</div>  
							</div>
						</div>
								<hr/>
                                    <div class="row">
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
                                    </div>
                                
                                <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive green" id="sale">
                                    <thead class="info">
                                        <tr>
                                            <th class="all">Product </th>
                                            <th class="all">Category </th>
                                            <th class="all">Brand </th>
                                            <th class="all">Unit </th>
											<th class="all">Model No </th>
                                            <th class="all">Stock</th>
                                            <th class="all">Quantity</th>
                                            <th class="all">Sale Price</th>
                                            <th class="all">Sub Total</th>
                                            <th class="all">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="all" colspan="4">Total</th>
                                            <th id="supplier_price">0</th>
											 <th id="model_no">0</th>
											  <th id="total_ordered">0</th>
                                            <th id="">-</th>
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
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Discount Type</label>
                                            <div class="col-sm-8 ">          
                                                <select class="form-control select2" id="discount_type" name="discount_type">
                                                    <option> Fixed</option>
                                                    <option>Percentage </option>
                                                </select>
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
												<input type="number" class="form-control grand_total" id="grand_total" min="0" readonly name="grand_total" >
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
										<!--<input type="hidden" class="grand_total" name="grand_total"  />-->
										<input type="hidden" class="due" name="due"  />
                                    </div>
                                </div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
									  <button class="btn btn-xs btn-warning" type="reset">Reset</button>
									  <button type="submit" class="btn btn-xs btn-success">Save</button>
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
	<!-- select2 section-->
	<script src="{{ asset('myfile/backend/assets/js/select2.min.js') }}"></script>
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
			
		/***-------------------------------*/
		$("#category").change(function () {
            var category = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: '{{ route('admin.sale.productList2') }}',
                type: 'Get',
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

		var array = [];
        var total_tax = 0;
        var tax_type = "Fixed";

        $("#product").change(function () {
            var id = $(this).val();
           // $("#supplier").attr('disabled', true);
            var token = "{{csrf_token()}}";

            $.ajax({
                url: '{{ route('admin.sale.productDetails2') }}',
                type: 'Get',
                data: {id: id, '_token' : token},
                dataType: 'json',
                success: function (response) {
			//alert(response)
			console.log(response)
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
                          +"<td><input type='hidden' name='purchase_details_id[]' value='"+id+"' />"+name+" </td>"
                          +"<td><input type='hidden' name='category_name[]' value='"+category_name+"' />"+category_name+" </td>"
                          +"<td><input type='hidden' name='brand_name[]' value='"+brand_name+"' />"+brand_name+" </td>"
                          +"<td><input type='hidden' name='unit_name[]' value='"+unit_name+"' />"+unit_name+" </td>"
                          +"<td><input id='' type='hidden' name='model_no[]' value='"+model_no+"' size='10'/>"+model_no+"</td>"
						  +"<td><input  type='hidden' id='"+id+"_stock' name='stock[]' value='"+stock+"' size='10'/>"+stock+"</td>"
                          +"<td><input type='text' id='"+id+"_ordered_quantity' class='ordered_quantity' name='ordered_quantity[]' min='1' value='"+ordered_quantity+"' size='10' /></td>"
						  +"<td><input type='text' id='"+id+"_price' class='sale_price' name='sale_price[]' value='"+sale_price+"' size='10'></td>"
                          +"<td class='sub_total' id='"+id+"_sub_total'>"+sub_total+"</td>"
                          +"<td class='text-center'><i class=' fa fa-trash fa-lg'></i></td>"
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

           // $('#product').select2("destroy").select2({placeholder:"",width:"auto",allowClear:!0});

            calculate_ordered_quantity();

            calculate_sub_total();

            calculate_total();
        });

        $(document).on('keyup','.ordered_quantity',function(){
            var id = $(this).parent().parent().attr('id');
			//alert(id)
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
				//alert(stock)
				alert('Product Stock is low than Ordered Quantity!!!!!!');
				$('#'+id+'_sub_total').empty();
				$('#'+id+'_ordered_quantity').val('');
			}
        });
		$(document).on('keyup','.sale_price',function(){
            var id = $(this).parent().parent().attr('id');
			//alert(id)
            var price = $('#'+id+'_price').val();
            var quantity = $('#'+id+'_ordered_quantity').val();
            var stock = $('#'+id+'_stock').val();
			
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
			var pay = $('#payment').val();
			var grand_total = $('.grand_total').val();
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