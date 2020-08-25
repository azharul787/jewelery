@extends('layouts.backend.master')

@section('title', 'Dashboard')

@push('css')
	<style>
		.infobox-yellow>.infobox-icon>.ace-icon {
			background-color: #69221e;
		}
		.infobox-megento>.infobox-icon>.ace-icon {
			background-color: #ff6d17e3;
		}
		.infobox-olive>.infobox-icon>.ace-icon {
			background-color: navy;
		}
		svg{
			height: 250px;
		}
	</style>
	  <link rel="stylesheet" href="{{asset('myfile/backend/assets/charts/morris-v0.5.1.css')}}">
	
@endpush

@section('content')
	<div class="ace-settings-container" id="ace-settings-container">
		<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
			<i class="ace-icon fa fa-cog bigger-130"></i>
		</div>
		<div class="ace-settings-box clearfix" id="ace-settings-box">
			<div class="pull-left width-50">
				<div class="ace-settings-item">
					<div class="pull-left">
						<select id="skin-colorpicker" class="hide">
							<option data-skin="no-skin" value="#438EB9">#438EB9</option>
							<option data-skin="skin-1" value="#222A2D">#222A2D</option>
							<option data-skin="skin-2" value="#C6487E">#C6487E</option>
							<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
						</select>
					</div>
					<span>&nbsp; Choose Skin</span>
				</div>
				<div class="ace-settings-item">
					<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
					<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
				</div>
				<div class="ace-settings-item">
					<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
					<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
				</div>
				<div class="ace-settings-item">
					<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
					<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
				</div>
				<div class="ace-settings-item">
					<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
					<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
				</div>
					<div class="ace-settings-item">
						<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
						<label class="lbl" for="ace-settings-add-container">
							Inside
							<b>.container</b>
						</label>
					</div>
				</div><!-- /.pull-left --> 
				<div class="pull-left width-50">
					<div class="ace-settings-item">
					<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
					<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
				</div>
				<div class="ace-settings-item">
					<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
					<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
				</div>
				<div class="ace-settings-item">
					<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
					<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
				</div>
			</div><!-- /.pull-left -->
		</div><!-- /.ace-settings-box -->
	</div><!-- /.ace-settings-container -->
	<div class="row">
		<div class="col-xs-12">
		@can('dashboard')
			<div class="row">
				<div class="space-6"></div>
				<div class="col-sm-12 infobox-container">
					<div class="infobox infobox-yellow">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-user"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">{{$customers}}</span>
							<div class="infobox-content">Customer</div>
						</div>
					</div>
					<div class="infobox infobox-green2">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-asterisk"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">{{$suppliers}}</span>
							<div class="infobox-content">Supplier</div>
						</div>
						<!--<div class="stat stat-success">8%</div>-->
					</div>
					<div class="infobox infobox-megento">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-gift"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">{{$products}}</span>
							<div class="infobox-content">Product</div>
						</div>
					</div>
					<div class="infobox infobox-red">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-shopping-bag"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">{{$orders}}</span>
							<div class="infobox-content">Total Order</div>
						</div>
					</div>
					<div class="infobox infobox-pink">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-check-circle"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">{{$stockins}}</span>
							<div class="infobox-content">Order Stock In</div>
						</div>
					</div>
					<div class="infobox infobox-blue">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-anchor"></i>
						</div>

						<div class="infobox-data">
							<span class="infobox-data-number">{{$pendings}}</span>
							<div class="infobox-content">Order Pending</div>
						</div>
					</div>
					<div class="infobox infobox-green">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-shopping-cart"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">{{$purchases}}</span>
							<span class="infobox-text">Chalan</span>
						</div>
					</div>
					<div class="infobox infobox-orange">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-balance-scale"></i>
						</div>

						<div class="infobox-data">
							<span class="infobox-data-number">{{$invoices}}</span>
							<div class="infobox-content">Invoice</div>
						</div>
					</div>
					
					
					
					
					<div class="infobox infobox-olive">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-cube"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">{{$stocks}}</span>
							<div class="infobox-content">Stock</div>
						</div>
					</div>
					<div class="infobox infobox-orange2">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-cubes"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">{{$assets}}</span>
							<div class="infobox-content">Assets</div>
						</div>
					</div>
					<!--<div class="space-6"></div>
					<div class="infobox infobox-green infobox-small infobox-dark">
						<div class="infobox-progress">
							<div class="easy-pie-chart percentage" data-percent="98" data-size="39">
								<span class="percent">61</span>%
							</div>
						</div>

						<div class="infobox-data">
							<div class="infobox-content">Task</div>
							<div class="infobox-content">Completion</div>
						</div>
					</div>
					<div class="infobox infobox-blue infobox-small infobox-dark">
						<div class="infobox-chart">
							<span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
						</div>

						<div class="infobox-data">
							<div class="infobox-content">Earnings</div>
							<div class="infobox-content">5000</div>
						</div>
					</div>
					<div class="infobox infobox-grey infobox-small infobox-dark">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-download"></i>
						</div>

						<div class="infobox-data">
							<div class="infobox-content">Downloads</div>
							<div class="infobox-content">1,205</div>
						</div>
					</div>-->
				</div>
			</div>
			
			<!-- morris chart area-->
			<script src="{{asset('myfile/backend/assets/charts/jquery-2.2.4.min.js')}}"></script>
			<script src="{{asset('myfile/backend/assets/charts/raphael-2.1.0-min.js')}}"></script>
			<script src="{{asset('myfile/backend/assets/charts/morris-0.5.1.min.js')}}"></script>
				<div class="hr hr32 hr-dotted"></div>
			<div class="row">
				<!--{{--<div class="col-sm-7">
					<div class="widget-box ">
						<div class="widget-header widget-header-flat widget-header-small">
							<div class="widget-header widget-header-flat widget-header-small">
								<h5 class="widget-title">
									<i class="ace-icon fa fa-signal"></i>
									Order, Purchase & Sale Report
								</h5>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main padding-4">
								<div id="sales-charts"></div>
							</div>
						</div>
					</div>
				</div>--}}-->
				<div class="col-sm-12">
					<div class="widget-box">
						<div class="widget-header widget-header-flat widget-header-small">
							<h5 class="widget-title">
								<i class="ace-icon fa fa-signal"></i>
								Last 30 Day Sales Report
							</h5>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div id="morris-line"></div>
									{!!
									 Morris::line( 'morris-line' )
							           ->xkey( [ 'date' ] )
							           ->ykeys( [ 'value' ] )
							           ->labels( [ 'Money' ] )
							           ->data( $sale );
						      		!!}
						    </div>
						</div>
					</div>
				</div>
			</div>
			<!------------moris area library--------------->
			<div class="hr hr32 hr-dotted"></div>
			<div class="row">
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat widget-header-small">
							<h5 class="widget-title">
								<i class="ace-icon fa fa-signal"></i>
								Bar Chat Wise Sale Report
							</h5>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div id="morris-bar"></div>
									{!!
										 Morris::bar( 'morris-bar' )
								           ->xkey( [ 'y' ] )
								           ->ykeys( [ 'a'] )
								           ->labels( [ 'Sale'] )
								           ->data( $barchat_sale );
								       !!}
				        	</div> 
				        </div> 
				    </div> 
				</div>
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat widget-header-small">
							<h5 class="widget-title">
								<i class="ace-icon fa fa-signal"></i>
								Area Chat Wise Sale Return Report
							</h5>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div id="morris-area"></div>
								{!!	 Morris::area( 'morris-area' )
									   ->xkey( [ 'y' ] )
									   ->ykeys( [ 'a'] )
									   ->labels( [ 'Sale Return' ] )
									   ->data($sale_return)  
								  	!!}
							</div>
						</div>
					</div>
				</div>
			</div>
		
		
		
		
		
			<div class="hr hr32 hr-dotted"></div>
			<div class="row">
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat widget-header-small">
							<h5 class="widget-title">
								<i class="ace-icon fa fa-signal"></i>
								Donut Chat Wise Purchase Quantity Report
							</h5>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div id="morris-donut"></div>
								<?php

									echo Morris::donut( 'morris-donut' )
							  		 ->data([
							             [ "label" => "Purchase Quantity", "value" => $purchaseDetails->sum('quantity') ],
							             [ "label" => "Sale Quantity", "value" =>  $sale_qty ],
							             [ "label" => "Stock Quantity", "value" => $purchaseDetails->sum('now_stock')],
							             [ "label" => "Return Quantity", "value" => $prqty ],
							             [ "label" => "Wastage Quantity", "value" => $wastage ],
							           ]);
							    ?>
							</div>
						</div>
					</div>
				</div>
				<div class="vspace-12-sm"></div>
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat widget-header-small">
							<h5 class="widget-title">
								<i class="ace-icon fa fa-signal"></i>
								Chat Wise Order Report
							</h5>						
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<div id="piechart-placeholder"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="hr hr32 hr-dotted"></div>
			@endcan
		</div>
	</div>
@endsection

@push('js')

	<!-- page specific plugin scripts -->

	<!--[if lte IE 8]>
	  <script src="assets/js/excanvas.min.js"></script>
	<![endif]-->
	<script src="{{ asset('myfile/backend/assets/js/jquery-ui.custom.min.js') }}"></script>
	<script src="{{ asset('myfile/backend/assets/js/jquery.ui.touch-punch.min.js') }}"></script>
	<script src="{{ asset('myfile/backend/assets/js/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ asset('myfile/backend/assets/js/jquery.sparkline.index.min.js') }}"></script>
	<script src="{{ asset('myfile/backend/assets/js/jquery.flot.min.js') }}"></script>
	<script src="{{ asset('myfile/backend/assets/js/jquery.flot.pie.min.js') }}"></script>
	<script src="{{ asset('myfile/backend/assets/js/jquery.flot.resize.min.js') }}"></script>
	<!-- inline scripts related to this page -->
	<script type="text/javascript">
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: ace.vars['old_ie'] ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});
			
			
			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'250px'});
			  var data = [
				{ label: "Total Order",  data: 22, color: "#68BC31"},
				{ label: "Stock In",  data: 65, color: "#2091CF"},
				{ label: "Pending",  data: 88, color: "#AF4E96"},
				/*{ label: "Chalan",  data: 332, color: "#DA5430"},
				{ label: "Invoice",  data: 252, color: "#FEE074"}*/
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
				/////////////////////////////////////
			/*	$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'265px'});
				$.plot("#sales-charts", [
					{ label: "Product", data: d1 },
					{ label: "Purchase", data: d2 },
					{ label: "Requisition", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			*/
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if(ace.vars['touch'] && ace.vars['android']) {
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				  });
				}
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
			
			
				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();
			
					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});
			
			});
	</script>

	<!-------------------------------->

@endpush
