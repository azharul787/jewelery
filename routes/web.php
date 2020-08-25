<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// backend section
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () 
{
    // Role and Permission section @Azharul
    Route::resource('roles','Admin\RoleController');
    Route::resource('users','Admin\UserController');
    Route::resource('permission','Admin\PermissionController');

    // Password change section @Azharul
    Route::Get('change-password','Auth\ChangePasswordController@index')->name('password.change');
    Route::Post('update','Auth\ChangePasswordController@update')->name('password.update');
 
    // Profile change section @Azharul
    Route::Get('changeProfile','Admin\ProfileController@changeProfile')->name('profile.changeProfile');
    Route::Post('updateprofile','Admin\ProfileController@updateprofile')->name('profile.updateprofile');

    // setting section
    Route::resource('about','Admin\AboutController');
    Route::Get('setting/edit','Admin\SettingController@edit')->name('setting.edit');
    Route::PUT('setting/{id}/update','Admin\SettingController@update')->name('setting.update');

    // adress section
    Route::resource('distric','Admin\DistricController');
    Route::resource('upozila','Admin\UpozilaController');
    Route::resource('union','Admin\UnionController');
    Route::Get('getUpozila','Admin\UnionController@getUpozila')->name('union.getUpozila');
    

    Route::resource('village','Admin\VillageController');
    Route::Get('getUnion','Admin\VillageController@getUnion')->name('village.getUnion');
    Route::Get('getVillage','Admin\VillageController@getVillage')->name('village.getVillage');
    

    // setting section
    Route::resource('warehouse','Admin\WarehouseController');
    Route::resource('category','Admin\CategoryController');
    Route::resource('unit','Admin\UnitController');
    Route::resource('brand','Admin\BrandController');
    Route::resource('type','Admin\TypeController');
    Route::resource('caret','Admin\CaretController');

    /*-----supplier section--------*/
    Route::resource('supplier','Admin\SupplierController');

    // customer section
    Route::resource('customer','Admin\CustomerController');
    Route::Get('customer/{id}/status','Admin\CustomerController@status')->name('customer.status');
    Route::Get('customerList2','Admin\CustomerController@customerList2')->name('customer.customerList2');

    // order section
    Route::resource('order','Admin\OrderController');
    Route::Get('order/{id}/customerOrder','Admin\OrderController@customerOrder')->name('order.customerOrder');
    Route::post('productList5','Admin\OrderController@productList5')->name('order.productList5');
    Route::post('productDetails5','Admin\OrderController@productDetails5')->name('order.productDetails5');

    Route::resource('worker','Admin\WorkerController');
    Route::resource('worker_order','Admin\WorkerOrderController');
    Route::post('productList6','Admin\WorkerOrderController@productList6')->name('worker_order.productList6');
    Route::post('productDetails6','Admin\WorkerOrderController@productDetails6')->name('worker_order.productDetails6');
    Route::Get('return_worker_order','Admin\WorkerOrderController@return_worker_order')->name('worker_order.return_worker_order');
    Route::Get('getOrderNo','Admin\WorkerOrderController@getOrderNo')->name('worker_order.getOrderNo');
    Route::Get('worker_order_search','Admin\WorkerOrderController@worker_order_search')->name('worker_order.worker_order_search');
    Route::Post('worker_order_store','Admin\WorkerOrderController@worker_order_store')->name('worker_order.worker_order_store');
    //Raw purchase section
    Route::resource('raw_purchase','Admin\RawPurchaseController');

    Route::resource('purchase','Admin\PurchaseController');
    Route::POST('search','Admin\PurchaseController@search')->name('purchase.search');
    Route::post('productList','Admin\PurchaseController@productList')->name('purchase.productList');
    Route::GET('supplierList','Admin\PurchaseController@supplierList')->name('purchase.supplierList');
    Route::Get('purchase/{id}/supplierSale','Admin\PurchaseController@supplierSale')->name('purchase.supplierSale');
    Route::post('productDetails','Admin\PurchaseController@productDetails')->name('purchase.productDetails');
    Route::resource('product','Admin\ProductController');
    /*===========================================================================*/
    /*---------------------------Stock list  Section-----------------------------*/
    Route::Get('stocklist','Admin\StockController@stocklist')->name('stock.stocklist');
    Route::Get('tsList','Admin\StockController@tsList')->name('stock.tsList');
    Route::Put('stocks','Admin\StockController@stocks')->name('stock.stocks');
    Route::post('wpList','Admin\StockController@wpList')->name('stock.wpList');
    Route::post('cpList','Admin\StockController@cpList')->name('stock.cpList');
    Route::post('bpList','Admin\StockController@bpList')->name('stock.bpList');
    Route::post('pList','Admin\StockController@pList')->name('stock.pList');
    /*--------------------------from warehouse click show this route-------------------------------------*/
    Route::get('stock/{id}/wstock','Admin\StockController@wstock')->name('stock.wstock');
    /*----------------------------stock transfer section------------------------------------------*/
    Route::Get('stock_transfer','Admin\StockController@stock_transfer')->name('stock.stock_transfer');
    Route::POST('spList','Admin\StockController@spList')->name('stock.spList');
    Route::POST('spDetails','Admin\StockController@spDetails')->name('stock.spDetails');
    Route::Put('sptupdate','Admin\StockController@sptupdate')->name('stock.sptupdate');
    /*===============================================================================*/
    /*--------------------sale section-------------------*/
    Route::resource('sale','Admin\SaleController');
    Route::Get('productList2','Admin\SaleController@productList2')->name('sale.productList2');
    Route::Get('productDetails2','Admin\SaleController@productDetails2')->name('sale.productDetails2');
    Route::Get('sale/{id}/customerPurchase','Admin\SaleController@customerPurchase')->name('sale.customerPurchase');
    Route::Get('sale/{id}/salePrint','Admin\SaleController@salePrint')->name('sale.salePrint');
    Route::Get('customerDetails','Admin\SaleController@customerDetails')->name('sale.customerDetails');
    Route::Get('customerList','Admin\SaleController@customerList')->name('sale.customerList');
    
    /*-----pos system sale controller---------*/
    Route::resource('pos','Admin\PosController');
    /*----------barcode generate section--------------*/
    Route::Get('bar_qr','Admin\PosController@bar_qr')->name('pos.bar_qr');
    Route::Get('pos/{id}/barcode_generate','Admin\PosController@barcode_generate')->name('pos.barcode_generate');
    Route::Get('pos/{id}/qrcode_generate','Admin\PosController@qrcode_generate')->name('pos.qrcode_generate');
    
    /*------------purchase return section-----------------*/
    Route::resource('purchase_return','Admin\PurchaseReturnController');
    Route::POST('getChalanNo','Admin\PurchaseReturnController@getChalanNo')->name('purchase_return.getChalanNo');
    Route::Get('purchase_return/{id}/supplierReturn','Admin\PurchaseReturnController@supplierReturn')->name('purchase_return.supplierReturn');

    /*---------------sale return section-------------------*/
    Route::resource('sale_return','Admin\SaleReturnController');
    Route::POST('getInvoiceNo','Admin\SaleReturnController@getInvoiceNo')->name('sale_return.getInvoiceNo');
    Route::Get('sale_return/{id}/customerReturn','Admin\SaleReturnController@customerReturn')->name('sale_return.customerReturn');
    /*-------------wastage return section-----------------*/
    Route::resource('wastage_return','Admin\WastageReturnController');
    Route::GET('productList3','Admin\WastageReturnController@productList3')->name('wastage_return.productList3');
    Route::post('productDetails3','Admin\WastageReturnController@productDetails3')->name('wastage_return.productDetails3');
    Route::Get('wastage_return/{id}/srList','Admin\WastageReturnController@srList')->name('wastage_return.srList');

    //supplier payment section
    Route::Get('spi','Admin\AccountController@spi')->name('account.spi');
    Route::Post('spsearch','Admin\AccountController@spsearch')->name('account.spsearch');
    Route::Post('spstore','Admin\AccountController@spstore')->name('account.spstore');
    
    // Customer payment section
    Route::Get('cpi','Admin\AccountController@cpi')->name('account.cpi');
    Route::POST('cpsearch','Admin\AccountController@cpsearch')->name('account.cpsearch');
    Route::POST('cpstore','Admin\AccountController@cpstore')->name('account.cpstore');

    /*--------bank controller section-----------------*/
    Route::resource('bank','Admin\BankController');
    Route::resource('bank_transaction','Admin\BankTransactionController');
    Route::GET('accountNo','Admin\BankTransactionController@accountNo')->name('bank_transaction.accountNo');
    Route::POST('bank_transaction/btlist','Admin\BankTransactionController@btlist')->name('bank_transaction.btlist');

    /*--------------------loan management section-------------------------*/
    Route::resource('loaner','Admin\LoanerController');
    Route::resource('loan','Admin\LoanController');
    Route::Get('lreceive','Admin\LoanController@lreceive')->name('loan.lreceive');
    Route::POST('loan/ltlist','Admin\LoanController@ltlist')->name('loan.ltlist');

    // expense section
    Route::resource('expense_type','Admin\ExpenseTypeController');
    Route::resource('expense','Admin\ExpenseController');

    /**
     * All Report Section
     */ 

    Route::Get('incomeReportIndex','Admin\ReportController@incomeReportIndex')->name('report.incomeReportIndex');
    Route::PUT('incomeReportSearch','Admin\ReportController@incomeReportSearch')->name('report.incomeReportSearch');
    /*------------purchase report -------------------*/
    /*-
    * cpri => c = chalan, p = purchase, r = report , i = index
    * cprs => c = chalan, p = purchase, r = report , s = search
    */
    Route::Get('cpri','Admin\ReportController@cpri')->name('report.cpri');
    Route::PUT('cprs','Admin\ReportController@cprs')->name('report.cprs');
    /*-
    * pri => p = purchase, r = report , i = index
    * prs => p = purchase, r = report , s = search
    */
    Route::Get('pri','Admin\ReportController@pri')->name('report.pri');
    Route::PUT('prs','Admin\ReportController@prs')->name('report.prs');
    /*- 
    * spri => s = supplier, p = purchase, r = report , i = index
    * sprs => s = supplier, p = purchase, r = report , s = search
    */
    Route::Get('spri','Admin\ReportController@spri')->name('report.spri');
    Route::PUT('sprs','Admin\ReportController@sprs')->name('report.sprs');
    /**
     * sale report
    */
    /*-
    * isri => i = invoice, s = sale, r = report , i = index
    * isrs => i = invoice, s = sale, r = report , s = search
    */
    Route::Get('isri','Admin\ReportController@isri')->name('report.isri');
    Route::PUT('isrs','Admin\ReportController@isrs')->name('report.isrs');
    /*-
    * psri => p = product, s = sale, r = report , i = index
    * psrs => p = product, s = sale, r = report , s = search
    */
    Route::Get('psri','Admin\ReportController@psri')->name('report.psri');
    Route::PUT('psrs','Admin\ReportController@psrs')->name('report.psrs');
    /*- 
    * csri => c = customer, s = sale, r = report , i = index
    * csrs => c = customer, s = sale, r = report , s = search
    */
    Route::Get('csri','Admin\ReportController@csri')->name('report.csri');
    Route::PUT('csrs','Admin\ReportController@csrs')->name('report.csrs');

    /*- 
    * wri => w = wastage,  r = report , i = index
    * wrs => w = wastage, r = report , s = search
    */
    Route::Get('wri','Admin\ReportController@wri')->name('report.wri');
    Route::PUT('wrs','Admin\ReportController@wrs')->name('report.wrs');

    /*----------expense report---------------*/
    Route::Get('expenseReportIndex','Admin\ReportController@expenseReportIndex')->name('report.expenseReportIndex');
    Route::PUT('expenseReportSearch','Admin\ReportController@expenseReportSearch')->name('report.expenseReportSearch');

   
    /*--------------customer ledger section---------------------------*/
    Route::Get('cledgeri','Admin\LedgerController@cledgeri')->name('ledger.cledgeri');
    Route::POST('cledgers','Admin\LedgerController@cledgers')->name('ledger.cledgers');
    /*--------------Supplier ledger section---------------------------*/
    Route::Get('sledgeri','Admin\LedgerController@sledgeri')->name('ledger.sledgeri');
    Route::POST('sledgers','Admin\LedgerController@sledgers')->name('ledger.sledgers');
    /*----------Ledger Report Section----------------*/
    Route::Get('bankbalance','Admin\LedgerController@bankbalance')->name('ledger.bankbalance');
    /*---------------profit calculation report--------------------------------*/
    /** ppri = produt profit report index */
    Route::Get('ppri','Admin\LedgerController@ppri')->name('ledger.ppri');
    Route::PUT('pprs','Admin\LedgerController@pprs')->name('ledger.pprs');
    /*---------invoice wise profit creport index--------------*/
    Route::Get('ipri','Admin\LedgerController@ipri')->name('ledger.ipri');
    Route::PUT('iprs','Admin\LedgerController@iprs')->name('ledger.iprs');

    /*-------------income expense report----------------*/
    Route::Get('income_expense','Admin\LedgerController@income_expense')->name('ledger.income_expense');
    Route::POST('income_expenses','Admin\LedgerController@income_expenses')->name('ledger.income_expenses');
    Route::Get('ledger/daily_summary','Admin\LedgerController@daily_summary')->name('ledger.daily_summary');
    Route::Get('ledger/summaryDetails','Admin\LedgerController@summaryDetails')->name('ledger.summaryDetails');

    /*-----------cash section--------------------*/
    Route::Get('closing_index','Admin\CashController@closing_index')->name('cash.closing_index');
    Route::POST('closing_save','Admin\CashController@closing_save')->name('cash.closing_save');
    Route::Get('closing_ledger','Admin\CashController@closing_ledger')->name('cash.closing_ledger');
    Route::POST('closing_search','Admin\CashController@closing_search')->name('cash.closing_search');

   
});
