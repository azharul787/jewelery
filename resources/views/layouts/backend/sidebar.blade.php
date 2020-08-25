	<ul class="nav nav-list">
		<li class="{{ Request::is('home') ? 'active' : '' }}">
			<a href="{{route('home')}}">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Dashboard </span>
			</a>
			<b class="arrow"></b>
		</li>
	@can('role-group')
		<li class="{{ Request::is('admin/permission') || Request::is('admin/permission/edit')|| Request::is('admin/roles') || Request::is('admin/roles/edit') || Request::is('admin/users') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-users"></i>
				<span class="menu-text"> Role Management </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('permission-list')
				<li class="{{ Request::is('admin/permission') ? 'active' : '' }}">
					<a href="{{route('admin.permission.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Permission
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('role-list')
				<li class="{{ Request::is('admin/roles') ? 'active' : '' }}">
					<a href="{{route('admin.roles.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Roles
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('user-list')
				<li class="{{ Request::is('admin/users') ? 'active' : '' }}">
					<a href="{{route('admin.users.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage User
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('setting-group')
		<li class="{{  Request::is('admin/about') || Request::is('admin/setting/edit') || Request::is('admin/category') || Request::is('admin/category/*/edit') || Request::is('admin/brand') || Request::is('admin/brand/*/edit') || Request::is('admin/type') || Request::is('admin/type/*/edit') || Request::is('admin/caret') || Request::is('admin/caret/*/edit') || Request::is('admin/unit') || Request::is('admin/unit/*/edit') ||  Request::is('admin/distric') ||  Request::is('admin/upozila') ||  Request::is('admin/union') ||  Request::is('admin/village') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-cog"></i>
				<span class="menu-text">Software Setting</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('about-information')
				<li class="{{ Request::is('admin/about') ? 'active' : '' }}">
					<a href="{{route('admin.about.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						About Information
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('setting-group')
				<li class="{{ Request::is('admin/setting/edit') ? 'active' : '' }}">
					<a href="{{route('admin.setting.edit')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Setting Information
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('category-list')
				<li class="{{ Request::is('admin/category') || Request::is('admin/category/*/edit') ? 'active' : '' }}">
					<a href="{{route('admin.category.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Category
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('brand-list')
				<li class="{{ Request::is('admin/brand') || Request::is('admin/brand/*/edit') ? 'active' : '' }}">
					<a href="{{route('admin.brand.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Brand
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('type-list')
				<li class="{{ Request::is('admin/type') || Request::is('admin/type/*/edit') ? 'active' : '' }}">
					<a href="{{route('admin.type.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Type
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('caret-list')
				<li class="{{ Request::is('admin/caret') || Request::is('admin/caret/*/edit') ? 'active' : '' }}">
					<a href="{{route('admin.caret.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Caret
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('unit-list')
				<li class="{{ Request::is('admin/unit') || Request::is('admin/unit/*/edit') ? 'active' : '' }}">
					<a href="{{route('admin.unit.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Unit
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('address-group')
				<li class="{{ Request::is('admin/distric') ||  Request::is('admin/upozila') ||  Request::is('admin/union') || Request::is('admin/village') ? 'active open' : '' }}">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>
						Address Section
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<b class="arrow"></b>
					<ul class="submenu">
					@can('district-list')
						<li class="{{ Request::is('admin/distric') ? 'active' : '' }}">
							<a href="{{route('admin.distric.index')}}">
								<i class="menu-icon fa fa-leaf green"></i>
								Distric List
							</a>
							<b class="arrow"></b>
						</li>
					@endcan
					@can('upozila-list')
						<li class="{{ Request::is('admin/upozila') ? 'active' : '' }}">
							<a href="{{route('admin.upozila.index')}}">
								<i class="menu-icon fa fa-leaf green"></i>
								Upozila List
							</a>
							<b class="arrow"></b>
						</li>
					@endcan
					@can('union-list')
						<li class="{{ Request::is('admin/union') ? 'active' : '' }}">
							<a href="{{route('admin.union.index')}}">
								<i class="menu-icon fa fa-leaf green"></i>
								Union List
							</a>
							<b class="arrow"></b>
						</li>
					@endcan
					</ul>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('supplier-group')
		<li class="{{ Request::is('admin/supplier') || Request::is('admin/supplier/create') || Request::is('admin/sledgeri') || Request::is('admin/sledgers') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-list"></i>
				<span class="menu-text"> Supplier </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('supplier-entry')
				<li class="{{ Request::is('admin/supplier/create')? 'active' : '' }}">
					<a href="{{route('admin.supplier.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Supplier Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('supplier-list')
				<li class="{{ Request::is('admin/supplier') ? 'active' : '' }}">
					<a href="{{route('admin.supplier.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Supplier
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('supplier-ledger')
				<li class="{{ Request::is('admin/sledgeri') || Request::is('admin/sledgers') ? 'active' : '' }}">
					<a href="{{route('admin.ledger.sledgeri')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Supplier Ledger
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('customer-group')
		<li class="{{ Request::is('admin/customer') || Request::is('admin/customer/create') || Request::is('admin/cledgeri') || Request::is('admin/cledgers')  ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-user"></i>
				<span class="menu-text"> Customer </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('customer-entry')
				<li class="{{  Request::is('admin/customer/create')? 'active' : '' }}">
					<a href="{{route('admin.customer.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Customer Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('customer-list')
				<li class="{{ Request::is('admin/customer') ? 'active' : '' }}">
					<a href="{{route('admin.customer.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Customer
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('customer-ledger')
				<li class="{{ Request::is('admin/cledgeri') || Request::is('admin/cledgers') ? 'active' : '' }}">
					<a href="{{route('admin.ledger.cledgeri')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Customer Ledger
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('product-group')
		<li class="{{ Request::is('admin/product') || Request::is('admin/product/create') || Request::is('admin/product/*/edit') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-gift"></i>
				<span class="menu-text"> Product </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('product-entry')
				<li class="{{ Request::is('admin/product/create') ? 'active' : '' }}">
					<a href="{{route('admin.product.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Product Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('product-list')
				<li class="{{ Request::is('admin/product') || Request::is('admin/product/*/edit') ? 'active' : '' }}">
					<a href="{{route('admin.product.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Product List
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('purchase-group')	
		<li class="{{ Request::is('admin/raw_purchase') || Request::is('admin/raw_purchase/create')  ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-shopping-cart"></i>
				<span class="menu-text">Gold Purchase </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('purchase-entry')
				<li class="{{ Request::is('admin/raw_purchase/create') ? 'active' : '' }}">
					<a href="{{route('admin.raw_purchase.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Purchase Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('purchase-list')	
				<li class="{{ Request::is('admin/raw_purchase') ? 'active' : '' }}">
					<a href="{{route('admin.raw_purchase.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Purchase List
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('order-group')
		<li class="{{ Request::is('admin/order*') || Request::is('admin/order/create') || Request::is('admin/order/search')? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-cart-plus"></i>
				<span class="menu-text"> Order </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('order-entry')
				<li class="{{ Request::is('admin/order/create') ? 'active' : '' }}">
					<a href="{{route('admin.order.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Order Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('order-list')
				<li class="{{ Request::is('admin/order') ? 'active' : '' }}">
					<a href="{{route('admin.order.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Order List
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('worker-group')
		<li class="{{ Request::is('admin/worker') || Request::is('admin/worker/create') || Request::is('admin/worker/*/edit') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-code-fork"></i>
				<span class="menu-text"> Worker </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('worker-entry')
				<li class="{{ Request::is('admin/worker/create') ? 'active' : '' }}">
					<a href="{{route('admin.worker.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Worker Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('worker-list')
				<li class="{{ Request::is('admin/worker') || Request::is('admin/worker/*/edit') ? 'active' : '' }}">
					<a href="{{route('admin.worker.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Worker
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('worker-order-group')
		<li class="{{ Request::is('admin/worker_order') || Request::is('admin/worker_order/create') || Request::is('admin/worker_order/*/edit') || Request::is('admin/return_worker_order') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-arrows"></i>
				<span class="menu-text"> Worker Order</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('worker-order-entry')
				<li class="{{ Request::is('admin/worker_order/create') ? 'active' : '' }}">
					<a href="{{route('admin.worker_order.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Worker Order Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('worker-order-list')
				<li class="{{ Request::is('admin/worker_order') || Request::is('admin/worker_order/*/edit') ? 'active' : '' }}">
					<a href="{{route('admin.worker_order.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Worker Order
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('worker-order-entry')
				<li class="{{ Request::is('admin/return_worker_order')  ? 'active' : '' }}">
					<a href="{{route('admin.worker_order.return_worker_order')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Return Worker Order
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('purchase-group')	
		<li class="{{ Request::is('admin/purchase') || Request::is('admin/purchase/create') || Request::is('admin/search') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-shopping-cart"></i>
				<span class="menu-text"> Purchase </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('purchase-entry')
				<li class="{{ Request::is('admin/purchase/create') || Request::is('admin/search')? 'active' : '' }}">
					<a href="{{route('admin.purchase.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Purchase Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('purchase-list')	
				<li class="{{ Request::is('admin/purchase') ? 'active' : '' }}">
					<a href="{{route('admin.purchase.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Purchase List
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('stock-group')
		<!--<li class="{{ Request::is('admin/stock')? 'active' : '' }}">
			<a href="{{route('admin.stock.stocklist')}}">
				<i class="menu-icon fa fa-list-alt"></i>
				<span class="menu-text"> Stocks </span>
			</a>
			<b class="arrow"></b>
		</li>-->
		<li class="{{ Request::is('admin/stocklist') || Request::is('admin/stock_transfer') || Request::is('admin/tsList') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-list-alt"></i>
				<span class="menu-text"> Stock </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('stock-list')
				<li class="{{ Request::is('admin/stocklist') ? 'active' : '' }}">
					<a href="{{route('admin.stock.stocklist')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Total Stock List
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('stock-list')
				<li class="{{ Request::is('admin/tsList') ? 'active' : '' }}">
					<a href="{{route('admin.stock.tsList')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Filter Stock List
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('stock-transfer')
				<li class="{{ Request::is('admin/stock_transfer') ? 'active' : '' }}">
					<a href="{{route('admin.stock.stock_transfer')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Stock Transfer
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('warehouse-group')
		<li class="{{ Request::is('admin/warehouse') || Request::is('admin/warehouse/create') || Request::is('admin/stock*') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-folder-open-o"></i>
				<span class="menu-text"> Warehouse </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('warehouse-entry')
				<li class="{{  Request::is('admin/warehouse/create') ? 'active' : '' }}">
					<a href="{{route('admin.warehouse.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Warehouse Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('warehouse-list')
				<li class="{{ Request::is('admin/warehouse') ? 'active' : '' }}">
					<a href="{{route('admin.warehouse.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Warehouse Manage
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('stock-list')
			@if(Request::session()->has('warehouses'))
				@foreach(Session::get('warehouses') as $wr)
				<li class="{{ Request::url() == asset('admin/stock/'.$wr->id.'/wstock') ? 'active' : '' }}">
					<a href="{{route('admin.stock.wstock',$wr->id)}}">
						<i class="menu-icon fa fa-caret-right"></i>
						{{$wr->warehouse_name}} ({{$wr->warehouse_code}})
					</a>
					<b class="arrow"></b>
				</li>
				@endforeach
				@endif
			@endcan
			</ul>
		</li>
	@endcan
	@can('sale-group')
		<li class="{{ Request::is('admin/pos') || Request::is('admin/pos/create') || Request::is('admin/bar_qr') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-desktop"></i>
				<span class="menu-text"> POS </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('sale-entry')
				<li class="{{ Request::is('admin/pos/create') ? 'active' : '' }}">
					<a href="{{route('admin.pos.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						POS Sale
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('barcode-generate')
				<li class="{{ Request::is('admin/bar_qr') ? 'active' : '' }}">
					<a href="{{route('admin.pos.bar_qr')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Code Generate
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('sale-group')
		<li class="{{ Request::is('admin/sale') || Request::is('admin/sale/create')? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-balance-scale"></i>
				<span class="menu-text"> Sale </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('sale-entry')
				<li class="{{ Request::is('admin/sale/create') ? 'active' : '' }}">
					<a href="{{route('admin.sale.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Sale Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('sale-list')
				<li class="{{ Request::is('admin/sale') ? 'active' : '' }}">
					<a href="{{route('admin.sale.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Sale List
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('return-group')
		<li class="{{ Request::is('admin/purchase_return') || Request::is('admin/purchase_return/create') || Request::is('admin/sale_return') || Request::is('admin/sale_return/create') ||Request::is('admin/wastage_return') || Request::is('admin/wastage_return/create') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-mail-reply"></i>
				<span class="menu-text"> Return </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('purchase-return-list')
				<li class="{{ Request::is('admin/purchase_return') || Request::is('admin/purchase_return/create') ? 'active' : '' }}">
					<a href="{{route('admin.purchase_return.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Purchase Return
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('sale-return-list')
				<li class="{{ Request::is('admin/sale_return') || Request::is('admin/sale_return/create')? 'active' : '' }}">
					<a href="{{route('admin.sale_return.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Sale Return
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('wastage-return-entry')
				<li class="{{ Request::is('admin/wastage_return/create')? 'active' : '' }}">
					<a href="{{route('admin.wastage_return.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Wastage Return
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('wastage-return-list')
				<li class="{{ Request::is('admin/wastage_return') ? 'active' : '' }}">
					<a href="{{route('admin.wastage_return.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Wastage List
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
		@can('payment-group')
		<li class="{{ Request::is('admin/spi') || Request::is('admin/cpi')? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-dollar"></i>
				<span class="menu-text"> Payment </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('supplier-payment-list')
				<li class="{{ Request::is('admin/spi') ? 'active' : '' }}">
					<a href="{{route('admin.account.spi')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Pay To Supplier
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('customer-payment-list')
				<li class="{{ Request::is('admin/cpi') ? 'active' : '' }}">
					<a href="{{route('admin.account.cpi')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Pay From Customer
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('expense-group')
		<li class="{{ Request::is('admin/expense_type') || Request::is('admin/expense_type/create') || Request::is('admin/expense') || Request::is('admin/expense/create')? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-eraser"></i>
				<span class="menu-text"> Expense </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('expense-type-entry')
				<li class="{{ Request::is('admin/expense_type/create') ? 'active' : '' }}">
					<a href="{{route('admin.expense_type.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Category Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('expense-type-list')
				<li class="{{ Request::is('admin/expense_type') ? 'active' : '' }}">
					<a href="{{route('admin.expense_type.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Category Manage
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('expense-entry')
				<li class="{{ Request::is('admin/expense/create') ? 'active' : '' }}">
					<a href="{{route('admin.expense.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Expense Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('expense-list')
				<li class="{{ Request::is('admin/expense') ? 'active' : '' }}">
					<a href="{{route('admin.expense.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Expense List
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('bank-group')
		<li class="{{ Request::is('admin/bank') || Request::is('admin/bank/create') || Request::is('admin/bank_transaction') || Request::is('admin/bank_transaction/create') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-bank"></i>
				<span class="menu-text"> Bank </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('bank-name-entry')
				<li class="{{ Request::is('admin/bank/create') ? 'active' : '' }}">
					<a href="{{route('admin.bank.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Bank Name Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('bank-name-list')
				<li class="{{ Request::is('admin/bank') ? 'active' : '' }}">
					<a href="{{route('admin.bank.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Bank Name
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('bank-transaction-entry')
				<li class="{{ Request::is('admin/bank_transaction/create') ? 'active' : '' }}">
					<a href="{{route('admin.bank_transaction.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Bank Transaction Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('bank-transaction-list')
				<li class="{{ Request::is('admin/bank_transaction') ? 'active' : '' }}">
					<a href="{{route('admin.bank_transaction.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Bank Trans.
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('loan-group')
		<li class="{{ Request::is('admin/loaner') || Request::is('admin/loaner/create') || Request::is('admin/loan') || Request::is('admin/loan/create')  || Request::is('admin/lreceive') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-cubes"></i>
				<span class="menu-text"> Loan </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('loaner-entry')
				<li class="{{ Request::is('admin/loaner/create') ? 'active' : '' }}">
					<a href="{{route('admin.loaner.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Person Entry
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('loaner-list')
				<li class="{{ Request::is('admin/loaner') ? 'active' : '' }}">
					<a href="{{route('admin.loaner.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Person
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('loan-entry')
				<li class="{{ Request::is('admin/loan/create') ? 'active' : '' }}">
					<a href="{{route('admin.loan.create')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Payment
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('loan-entry')
				<li class="{{ Request::is('admin/lreceive') ? 'active' : '' }}">
					<a href="{{route('admin.loan.lreceive')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Receive
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			@can('loan-list')
				<li class="{{ Request::is('admin/loan') ? 'active' : '' }}">
					<a href="{{route('admin.loan.index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Manage Transaction.
					</a>
					<b class="arrow"></b>
				</li>
			@endcan
			</ul>
		</li>
	@endcan
	@can('report-group')
		<li class="{{  Request::is('admin/cpri') || Request::is('admin/cprs') || Request::is('admin/pri') || Request::is('admin/prs') ||  Request::is('admin/spri') ||  Request::is('admin/sprs') || Request::is('admin/isri') || Request::is('admin/isrs') || Request::is('admin/psri') || Request::is('admin/psrs') || Request::is('admin/csri') || Request::is('admin/csrs') || Request::is('admin/wri') || Request::is('admin/wrs') || Request::is('admin/expenseReportIndex') || Request::is('admin/expenseReportSearch') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-file-word-o"></i>
				<span class="menu-text">Report</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
			@can('purchase-report')
				<li class="{{ Request::is('admin/cpri') ||  Request::is('admin/cprs') ||  Request::is('admin/pri') || Request::is('admin/prs') || Request::is('admin/spri') || Request::is('admin/sprs') ? 'active open' : '' }}">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>
						Purchase Report
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<b class="arrow"></b>
					<ul class="submenu">
						<li class="{{ Request::is('admin/cpri') || Request::is('admin/cprs') ? 'active' : '' }}">
							<a href="{{route('admin.report.cpri')}}">
								<i class="menu-icon fa fa-leaf green"></i>
								Chalan Wise
							</a>
							<b class="arrow"></b>
						</li>
						<li class="{{ Request::is('admin/pri') || Request::is('admin/prs') ? 'active' : '' }}">
							<a href="{{route('admin.report.pri')}}">
								<i class="menu-icon fa fa-leaf green"></i>
								Product Wise
							</a>
							<b class="arrow"></b>
						</li>
						<li class="{{ Request::is('admin/spri') || Request::is('admin/sprs') ? 'active' : '' }}">
							<a href="{{route('admin.report.spri')}}">
								<i class="menu-icon fa fa-leaf green"></i>
								Supplier Wise
							</a>
							<b class="arrow"></b>
						</li>
					</ul>
				</li>
			@endcan
			@can('sale-report')
				<li class="{{ Request::is('admin/isri') ||  Request::is('admin/isrs') ||  Request::is('admin/psri') || Request::is('admin/psrs') || Request::is('admin/csri') || Request::is('admin/csrs') ? 'active open' : '' }}">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-caret-right"></i>
						Sale Report
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<b class="arrow"></b>
					<ul class="submenu">
						<li class="{{ Request::is('admin/isri') || Request::is('admin/isrs') ? 'active' : '' }}">
							<a href="{{route('admin.report.isri')}}">
								<i class="menu-icon fa fa-leaf green"></i>
								Invoice Wise
							</a>
							<b class="arrow"></b>
						</li>
						<li class="{{ Request::is('admin/psri') || Request::is('admin/psrs') ? 'active' : '' }}">
							<a href="{{route('admin.report.psri')}}">
								<i class="menu-icon fa fa-leaf green"></i>
								Product Wise
							</a>
							<b class="arrow"></b>
						</li>
						<li class="{{ Request::is('admin/csri') || Request::is('admin/csrs') ? 'active' : '' }}">
							<a href="{{route('admin.report.csri')}}">
								<i class="menu-icon fa fa-leaf green"></i>
								Customer Wise
							</a>
							<b class="arrow"></b>
						</li>
					</ul>
				</li>
			@endcan
				<li class="{{ Request::is('admin/wri') ||  Request::is('admin/wrs') ? 'active' : '' }}">
					<a href="{{route('admin.report.wri')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Wastage Return
					</a>
					<b class="arrow"></b>
				</li>
				<li class="{{ Request::is('admin/expenseReportIndex') ||  Request::is('admin/expenseReportSearch') ? 'active' : '' }}">
					<a href="{{route('admin.report.expenseReportIndex')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Expense Report
					</a>
					<b class="arrow"></b>
				</li>
			</ul>
		</li>
	@endcan
		@can('cash-group')
		<li class="{{ Request::is('admin/closing_index') || Request::is('admin/closing_ledger') || Request::is('admin/closing_search') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-briefcase"></i>
				<span class="menu-text"> Cash </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				@can('cash-closing')
				<li class="{{ Request::is('admin/closing_index') ? 'active' : '' }}">
					<a href="{{route('admin.cash.closing_index')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Closing Balance 
					</a>
					<b class="arrow"></b>
				</li>
				@endcan
				@can('cash-closing')
				<li class="{{ Request::is('admin/closing_ledger') ? 'active' : '' }}">
					<a href="{{route('admin.cash.closing_ledger')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Closing Ledger 
					</a>
					<b class="arrow"></b>
				</li>
				@endcan
			</ul>
		</li>
	@endcan
	@can('ledger-group')
		<li class="{{ Request::is('admin/bankbalance') || Request::is('admin/ppri') || Request::is('admin/pprs') || Request::is('admin/ipri') || Request::is('admin/iprs') || Request::is('admin/income_expense') || Request::is('admin/income_expenses') || Request::is('admin/ledger/daily_summary') ? 'active open' : '' }}">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-book"></i>
				<span class="menu-text"> Ledger </span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				@can('bank-balance')
				<li class="{{ Request::is('admin/bankbalance') ? 'active' : '' }}">
					<a href="{{route('admin.ledger.bankbalance')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Balance in Bank
					</a>
					<b class="arrow"></b>
				</li>
				@endcan
				@can('profit-balance')
				<li class="{{ Request::is('admin/ipri') || Request::is('admin/iprs')? 'active' : '' }}">
					<a href="{{route('admin.ledger.ipri')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Invoice Wise Profit
					</a>
					<b class="arrow"></b>
				</li>
				@endcan
				@can('profit-balance')
				<li class="{{ Request::is('admin/ppri') || Request::is('admin/pprs') ? 'active' : '' }}">
					<a href="{{route('admin.ledger.ppri')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Product Wise Profit
					</a>
					<b class="arrow"></b>
				</li>
				@endcan
				@can('income-expense')
				<li class="{{ Request::is('admin/income_expense') || Request::is('admin/income_expenses') ? 'active' : '' }}">
					<a href="{{route('admin.ledger.income_expense')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Income Expense
					</a>
					<b class="arrow"></b>
				</li>
				@endcan
				@can('daily-summary')
				<li class="{{ Request::is('admin/ledger/daily_summary') ? 'active' : '' }}">
					<a href="{{route('admin.ledger.daily_summary')}}">
						<i class="menu-icon fa fa-caret-right"></i>
						Daily Summary
					</a>
					<b class="arrow"></b>
				</li>
				@endcan
			</ul>
		</li>
	@endcan
	</ul><!-- /.nav-list -->
