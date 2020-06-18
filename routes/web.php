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

// Route::get('/', function () {
//     return view('admin.main');
// });
 Route::get('/logout','SuperAdminController@logout')->name('logout');
 Route::get('admin/','AdminController@index');
 Route::get('admin/dashboard','AdminController@showdashbord')->name('admin.dashboard')->middleware('Admin');
 Route::post('/admin/login','AdminController@login')->name('admin.login');
 //.....................profile

 Route::get('/admin/user/profile/{id}','AdminController@profile')->name('admin.user.profile')->middleware('Admin')
 ;
 Route::post('/admin/user/upprofile/{id}','AdminController@up_profile')->name('admin.user.upprofile');
 Route::post('/admin/user/changepassword','AdminController@password');
 Route::post('/admin/user/upppass/{id}','AdminController@upppass')->name('admin.user.upppass');

 //.....................category
 Route::get('/admin/category','CategoryController@index')->name('admin.category.index')->middleware('Admin');
 Route::get('/admin/category/create','CategoryController@create')->name('admin.category.create')->middleware('Admin');
 Route::post('/admin/category/store','CategoryController@store')->name('admin.category.store');
 Route::post('/admin/category/edit','CategoryController@edit')->name('admin.category.edit');
 Route::post('/admin/category/update','CategoryController@update')->name('admin.category.update');
 Route::post('/admin/category/delete/{id}','CategoryController@delete')->name('admin.category.delete');


 //......................product
 Route::get('/admin/product','ProductController@index')->name('admin.product.index')->middleware('Admin');
 Route::post('/admin/product/store','ProductController@store')->name('admin.product.store');
 Route::post('/admin/product/edit','ProductController@edit')->name('admin.product.edit');
 Route::post('/admin/product/dropdown','ProductController@dropdown');
 Route::post('/admin/product/update','ProductController@update')->name('admin.product.update');
 Route::post('/admin/product/delete/{id}','ProductController@delete')->name('admin.product.delete');
 Route::get('/admin/product/stock','ProductController@stock');
 Route::post('/admin/product/newstock','ProductController@newstock')->name('admin.product.newstock');
 Route::get('/admin/product/barcode/{id}','ProductController@barcode')->name('admin.product.barcode');
 Route::get('/admin/product/create','ProductController@create')->name('admin.product.create')->middleware('Admin');

 //.......................supplier
  Route::get('/admin/supplier','SupplierController@index')->name('admin.supplier.index')->middleware('Admin');
  Route::post('/admin/supplier/store','SupplierController@store')->name('admin.supplier.store');
  Route::post('/admin/supplier/edit','SupplierController@edit')->name('admin.supplier.edit');
  Route::post('/admin/supplier/update','SupplierController@update')->name('admin.supplier.update');
  Route::post('/admin/supplier/delete/{id}','SupplierController@delete')->name('admin.supplier.delete');
  Route::get('/admin/supplier/create','SupplierController@create')->name('admin.supplier.create')->middleware('Admin');
  //.......................clent

  Route::get('/admin/client','ClientController@index')->name('admin.client.index')->middleware('Admin');
  Route::post('/admin/client/store','ClientController@store')->name('admin.client.store');
  Route::post('/admin/client/edit','ClientController@edit')->name('admin.client.edit');
  Route::post('/admin/client/update','ClientController@update')->name('admin.client.update');
  Route::post('/admin/client/delete/{id}','ClientController@delete')->name('admin.client.delete');
  Route::get('/admin/client/create','ClientController@create')->name('admin.client.create')->middleware('Admin');

  //.......................pos
  Route::get('admin/pos/pos-print','PrintController@print')->name('admin.pos.pos-print');
  Route::get('/admin/pos/create','PosController@create')->name('admin.pos.create')->middleware('Admin');
  Route::post('/admin/pos/append','PosController@append')->name('admin.pos.append');
  Route::post('/admin/pos/store','PosController@store')->name('admin.pos.store');
  Route::get('/admin/pos/edit/{id}','PosController@edit')->name('admin.pos.edit')->middleware('Admin');
  Route::post('/admin/pos/edit/{id}','PosController@update')->name('admin.pos.update')->middleware('Admin');
  Route::get('/admin/pos/invoice/{id}','PrintController@invoice')->name('admin.pos.invoice')->middleware('Admin');
  Route::get('/admin/pos/invoice-print/{id}','PrintController@invoice_print')->name('admin.pos.invoice-print')->middleware('Admin');
  Route::post('/admin/pos/delete/{id}','PosController@delete')->name('admin.pos.delete');
  Route::get('/admin/pos/scanner','PosController@scanner')->name('admin.pos.scanner');
  Route::get('/admin/pos/scannerappend','PosController@scannerappend');
  Route::get('/admin/pos/scannerappend1','PosController@scannerappend1');
  Route::post('admin/pos/cnannerstore','PosController@cnannerstore')->name('admin.pos.cnannerstore');

  //......................sell
  Route::get('/admin/sell','PosController@index')->name('admin.sell.index')->middleware('Admin');
//.............sellinfo..
  Route::get('/admin/sellinfo/due','SellinfoController@due')->name('admin.sellinfo.due')->middleware('Admin');
  Route::get('/admin/sellinfo/editdue/{id}','SellinfoController@editdue')->name('admin.sellinfo.editdue')->middleware('Admin');;
  Route::post('/admin/sellinfo/editdue/{id}','PosController@update')->name('admin.sellinfo.update')->middleware('Admin');
  Route::get('/admin/sellinfo/paid','SellinfoController@paid')->name('admin.sellinfo.paid')->middleware('Admin');
  Route::get('/admin/sellinfo/invoice/{id}','SellinfoController@invoice')->name('admin.sellinfo.invoice')->middleware('Admin');


  //.....................purchase
  Route::get('admin/purchase/purchase-print','PrintController@purchaseprint')->name('admin.purchase.purchase-print');
  Route::get('/admin/purchase','PurchaseController@index')->name('admin.purchase.index')->middleware('Admin');
  Route::get('/admin/purchase/create','PurchaseController@create')->name('admin.purchase.create')->middleware('Admin');
  Route::post('/admin/purchase/product','PurchaseController@product')->name('admin.purchase.product');
  Route::post('/admin/purchase/store','PurchaseController@store')->name('admin.purchase.store');
  Route::get('/admin/purchase/edit/{id}','PurchaseController@edit')->name('admin.purchase.edit')->middleware('Admin');
  Route::post('/admin/purchase/update/{id}','PurchaseController@update')->name('admin.purchase.update')->middleware('Admin');
  Route::get('/admin/purchase/invoice/{id}','PrintController@purchaseinvoice')->name('admin.purchase.invoice')->middleware('Admin');
  Route::post('/admin/purchase/delete/{id}','PurchaseController@delete')->name('admin.purchase.delete');
   Route::get('/admin/purchase/bysupplier','PurchaseController@bysupplier')->name('admin.purchase.bysupplier')->middleware('Admin');
   Route::post('/admin/purchase/searching','PurchaseController@searching')->name('admin.purchase.searching');

   //...................expense
  Route::get('/admin/expense','ExpenseController@index')->name('admin.expense.index')->middleware('Admin');
   Route::get('/admin/expense/create','ExpenseController@create')->name('admin.expense.create')->middleware('Admin');
  Route::post('/admin/exp[ense/store','ExpenseController@store')->name('admin.expense.store');
  Route::post('/admin/expense/edit','ExpenseController@edit')->name('admin.expense.edit');
    Route::post('/admin/expense/update','ExpenseController@update')->name('admin.expense.update')->middleware('Admin');
  Route::post('/admin/expense/delete/{id}','ExpenseController@delete')->name('admin.expense.delete');

  //..................report
  Route::get('/admin/report/supplierreport','ReportController@supplier')->name('admim.report.supplierreport')->middleware('Admin');
  Route::get('/admin/report/singlesuppdetails/{id}','ReportController@singlesuppdetails')->name('admin.report.singlesuppdetails')->middleware('Admin');;
  Route::get('/admin/report/clientreport','ReportController@client')->name('admin.report.clientreport')->middleware('Admin');
  Route::get('/admin/report/singleclientdetails/{id}','ReportController@singleclientreport')->name('admin.report.singleclientdetails')->middleware('Admin');
  Route::get('/admin/report/sellsreport','ReportController@sellsreport')->name('admin.report.sellsreport')->middleware('Admin');
   Route::post('/admin/report/sellsreport','ReportController@rng_sellsreport')->name('admin.report.rng-sellsreport')->middleware('Admin');
  Route::get('/admin/report/expensereport','ReportController@expensereport')->name('admin.report.expensereport')->middleware('Admin');
  Route::post('/admin/report/expensereport','ReportController@rng_expensereport')->name('admin.report.rng-expensereport')->middleware('Admin');
  Route::get('/admin/report/todays','ReportController@todaysreport')->name('admin.report.todays')->middleware('Admin');
  Route::get('/admin/report/stock','ReportController@stockreport')->name('admin.report.stock')->middleware('Admin');


  //................loan

  Route::get('/admin/loan','LoanController@index')->name('admin.loan.index')->middleware('Admin');
  Route::get('/admin/loan/singledetails/{id}','LoanController@singledetails')->name('admin.loan.singledetails')->middleware('Admin');
  Route::post('/admin/loan/store','LoanController@store')->name('admin.loan.store')->middleware('Admin');
  Route::get('/admin/loan/edit/{id}','LoanController@edit')->name('admin.loan.edit')->middleware('Admin');
  Route::post('/admin/loan/update/{id}','LoanController@update')->name('admin.loan.update')->middleware('Admin');

  Route::get('/admin/loan/loanee','LoanController@loanee')->name('admin.loan.loanee')->middleware('Admin');
  Route::post('/admin/loan/loaneestore','LoanController@loaneestore')->name('admin.loan.loaneestore')->middleware('Admin');
  Route::post('/admin/laon/loaneeedit','LoanController@loaneeedit')->name('admin.loan.loaneeedit')->middleware('Admin');
  Route::post('/admin/laon/loaneeupdate','LoanController@loaneeupdate')->name('admin.loan.loaneeupdate')->middleware('Admin');
  Route::post('/admin/loan/laoneedelete/{id}','LoanController@loaneedelete')->name('admin.loan.loaneedelete');
  Route::get('/admin/loan/lendar','LoanController@lender')->name('admin.loan.lendar')->middleware('Admin');
  Route::post('/admin/loan/lendarstore','LoanController@lendarstore')->name('admin.loan.lendarstore')->middleware('Admin');
  Route::post('/admin/laon/lendaredit','LoanController@lendaredit')->name('admin.loan.lendaredit')->middleware('Admin');
  Route::post('/admin/laon/lendarupdate','LoanController@lendarupdate')->name('admin.loan.lendarupdate')->middleware('Admin');
  Route::post('/admin/loan/lendardelete/{id}','LoanController@lendardelete')->name('admin.loan.lendardelete');


//....................bank

  Route::get('/admin/bank','BankController@index')->name('admin.bank.index')->middleware('Admin');
  Route::post('/admin/bank/store','BankController@store')->name('admin.bank.store')->middleware('Admin');
  Route::post('/admin/bank/edit','BankController@edit')->name('admin.bank.edit');
  Route::post('/admin/bank/update','BankController@update')->name('admin.bank.update')->middleware('Admin');
  Route::post('/admin/bank/delete/{id}','BankController@delete')->name('admin.bank.delete')->middleware('Admin');
  Route::get('/admin/bank/transfer','BankController@transfer')->name('admin.bank.transfer')->middleware('Admin');
  Route::get('/admin/bank/createtransfer','BankController@createtransfer')->name('admin.bank.createtransfer')->middleware('Admin');
  Route::post('/admin/transfer/transfer-from','BankController@transfer_from')->name('admin.transfer.transfer-from');
  Route::get('/admin/bank/edittranfer/{id}','BankController@edittranfer')->name('admin.bank.edittranfer')->middleware('Admin');
  Route::post('/admin/bank/uptransfer-fro/{id}','BankController@uptransfer_from')->name('admin.transfer.uptransfer-from');
  Route::post('/admin/transfer/delete/{id}','BankController@transfer_delete')->name('admin.transfer.delete');
  Route::get('/admin/transfer/transjaction','BankController@transjaction')->name('admin.bank.transjaction');

  //................account

  Route::get('/admin/account','AccountController@index')->name('admin.account.index')->middleware('Admin');
  Route::post('/admin/account/store','AccountController@acc_store')->name('admin.account.store');
  Route::post('/admin/account/acc-edit','AccountController@acc_edit')->name('admin.account.acc_edit');
  Route::post('/admin/account/dropdown','AccountController@dropdown');
  Route::post('/admin/account/acupdate','AccountController@acupdate')->name('admin.account.acupdate');
  Route::post('/admin/account/delete/{id}','AccountController@ac_deete')->name('admin.account.delete');
  //................payment
  Route::get('admin/account/payment','AccountController@payment')->name('admin.account.payment')->middleware('Admin');
  Route::post('/admin/account/payment','AccountController@paymentfrom');
  Route::get('/admin/account/payedit/{id}','AccountController@pay_edit')->name('admin.account.payedit')->middleware('Admin');

  Route::post('/admin/account/uppayment/{id}','AccountController@up_payment')->name('admin.account.uppayment');
  Route::post('/admin/account/pay_delete/{id}','AdminController@pay_delete')->name('admin.account.pay_delete');
  //..............Receipt
  Route::get('admin/account/receipt','AccountController@receipt')->name('admin.account.receipt')->middleware('Admin');

  Route::post('/admin/account/receipt-from','AccountController@receipt_from')->name('admin.account.receipt-from');
  Route::get('/admin/account/recedit/{id}','AccountController@rec_edit')->name('admin.account.recedit')->middleware('Admin');
  Route::post('/admin/account/upreceipt/{id}','AccountController@upreceipt')->name('admin.account.upreceipt');

  //..............mail
  Route::post('/admin/sett/mail','SettingController@sendmail')->name('admin.sett.mail');

  //..............setting

  Route::get('/admin/backup/setting','SettingController@setting')->name('admin.account.setting')->middleware('Admin');
  Route::get('/admin/account/companyprofile','SettingController@companyprofile')->name('admin.account.companyprofile');
  Route::post('/admin/setting/company','SettingController@company')->name('admin.setting.company');
  Route::post('/admin/backup/sett','SettingController@sett')->name('admin.setting.sett');
  //backup.............
  Route::get('/admin/backup/backup','BackupController@backup')->name('admin.setting.backup')->middleware('Admin');
  Route::get('/admin/backup/product','BackupController@product')->name('admin.product.backup');

  Route::post('/admin/backup/resetproduct','BackupController@resetproduct')->name('admin.backup.resetproduct');
  Route::post('/admin/backup/destroyproduct','BackupController@destroyproduct')->name('admin.backup.destroyproduct');
  Route::get('/admin/backup/category','BackupController@category')->name('admin.category.backup');

  Route::post('/admin/backup/resetcategory','BackupController@resetcategory')->name('admin.backup.resetcategory');
  Route::post('/admin/backup/destroycategory','BackupController@destroycategory')->name('admin.backup.destroycategory');
  Route::get('/admin/backup/supplier','BackupController@supplier')->name('admin.supplier.backup');

   Route::post('/admin/backup/resetsupplier','BackupController@resetsupplier')->name('admin.backup.resetsupplier');
   Route::post('/admin/backup/destroysupplier','BackupController@destroysupplier')->name('admin.backup.destroysupplier');

   Route::get('/admin/backup/client','BackupController@client')->name('admin.client.backup');




















  



  






