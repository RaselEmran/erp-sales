    <section class="sidebar">
      <!-- Sidebar user panel -->
<?php 
$id=Session::get('admin_id');
$prof =DB::table('admins')->where('id',$id)->first();
 ?>
      <div class="user-panel">
        <div class="pull-left image">
          @if(empty($prof->image))
                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                @else
                <img src="{{asset($prof->image)}}" class="img-circle" alt="User Image" width="35px">
               
                @endif
        </div>
        <div class="pull-left info">
          <p> <?php echo Session::get('admin_name') ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- /.search form -->
      <li>
        <a href="{{url('admin/dashboard')}}">Dashbord</a>
      </li>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
    
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview {{Request::is('admin/category*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Product Category</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/category') ?'active':''}}"><a href="{{route('admin.category.index')}}"><i class="fa fa-circle-o"></i>All Category</a></li>
            <li class="{{Request::is('admin/category/create') ?'active':''}}""><a href="{{route('admin.category.create')}}"><i class="fa fa-circle-o"></i> Add Category</a></li>
          </ul>
        </li>

        <li class="treeview {{Request::is('admin/product*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Product Upload</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">2</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/product') ?'active':''}}"><a href="{{route('admin.product.index')}}"><i class="fa fa-circle-o"></i>All Product</a></li>
            <li class="{{Request::is('admin/product/create') ?'active':''}}""><a href="{{route('admin.product.create')}}"><i class="fa fa-circle-o"></i> Add Product</a></li>
          </ul>
        </li>

        <li class="treeview {{Request::is('admin/supplier*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Supplier Info</span>
            <span class="pull-right-container">
              <span class="label label-info pull-right">2</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/supplier') ?'active':''}}"><a href="{{route('admin.supplier.index')}}"><i class="fa fa-circle-o"></i>All Supplier</a></li>
            <li class="{{Request::is('admin/supplier/create') ?'active':''}}""><a href="{{route('admin.supplier.create')}}"><i class="fa fa-circle-o"></i> Add Supplier</a></li>
          </ul>
        </li>

           <li class="treeview {{Request::is('admin/client*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Client Info</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/client') ?'active':''}}"><a href="{{route('admin.client.index')}}"><i class="fa fa-circle-o"></i>All Client</a></li>
            <li class="{{Request::is('admin/client/create') ?'active':''}}""><a href="{{route('admin.client.create')}}"><i class="fa fa-circle-o"></i> Add Client</a></li>
          </ul>
        </li>

         <li class="treeview {{Request::is('admin/pos*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Pos System</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">1</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/pos/create') ?'active':''}}""><a href="{{route('admin.pos.create')}}"><i class="fa fa-circle-o"></i> Add Pos</a></li>
             <li class="{{Request::is('admin/pos/scanner') ?'active':''}}""><a href="{{route('admin.pos.scanner')}}"><i class="fa fa-circle-o"></i> Barcode Scanner</a></li>
          </ul>
        </li>

          <li class="treeview {{Request::is('admin/sell*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Invoice Info</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">1</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/sell/index') ?'active':''}}""><a href="{{route('admin.sell.index')}}"><i class="fa fa-circle-o"></i> ALL Sell</a></li>
          </ul>
        </li>

         <li class="treeview {{Request::is('admin/sellinfo*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Sell Info</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">2</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/sellinfo/due') ?'active':''}}""><a href="{{route('admin.sellinfo.due')}}"><i class="fa fa-circle-o"></i> Due Info</a></li>
              <li class="{{Request::is('admin/sellinfo/paid') ?'active':''}}""><a href="{{route('admin.sellinfo.paid')}}"><i class="fa fa-circle-o"></i> Paid Info</a></li>
          </ul>
        </li>


          <li class="treeview {{Request::is('admin/purchase*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Purchase</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right">3</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/purchase/index') ?'active':''}}""><a href="{{route('admin.purchase.index')}}"><i class="fa fa-circle-o"></i> ALL Purchase</a></li>
             <li class="{{Request::is('admin/purchase/create') ?'active':''}}""><a href="{{route('admin.purchase.create')}}"><i class="fa fa-circle-o"></i> Add Purchase</a></li>
              <li class="{{Request::is('admin/purchase/bysupplier') ?'active':''}}""><a href="{{route('admin.purchase.bysupplier')}}"><i class="fa fa-circle-o"></i> By Supplier</a></li>
          </ul>
        </li>

         <li class="treeview {{Request::is('admin/expense*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Expense</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">2</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/expense/index') ?'active':''}}""><a href="{{route('admin.expense.index')}}"><i class="fa fa-circle-o"></i> Expense</a></li>
             <li class="{{Request::is('admin/expense/create') ?'active':''}}""><a href="{{route('admin.expense.create')}}"><i class="fa fa-circle-o"></i> Add Expense</a></li>
          </ul>
        </li>

          <li class="treeview {{Request::is('admin/report*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Report</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">5</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/report/supplierreport') ?'active':''}}""><a href="{{route('admim.report.supplierreport')}}"><i class="fa fa-circle-o"></i> Supplier Report</a></li>
             <li class="{{Request::is('admin/report/clientreport') ?'active':''}}""><a href="{{route('admin.report.clientreport')}}"><i class="fa fa-circle-o"></i> Client Report</a></li>
             <li class="{{Request::is('admin/report/sellreport') ?'active':''}}""><a href="{{route('admin.report.sellsreport')}}"><i class="fa fa-circle-o"></i> Sells Report</a></li>
              <li class="{{Request::is('admin/report/expense') ?'active':''}}""><a href="{{route('admin.report.expensereport')}}"><i class="fa fa-circle-o"></i> Expense Report</a></li>
               <li class="{{Request::is('admin/report/todays') ?'active':''}}""><a href="{{route('admin.report.todays')}}"><i class="fa fa-circle-o"></i> Todays Report</a></li>

                <li class="{{Request::is('admin/report/stock') ?'active':''}}""><a href="{{route('admin.report.stock')}}"><i class="fa fa-circle-o"></i> Stock Report</a></li>
          </ul>
        </li>

          <li class="treeview {{Request::is('admin/loan*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Loan</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">2</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/loan/index') ?'active':''}}""><a href="{{route('admin.loan.index')}}"><i class="fa fa-circle-o"></i> Loan</a></li>
             <li class="{{Request::is('admin/loan/loanee') ?'active':''}}""><a href="{{route('admin.loan.loanee')}}"><i class="fa fa-circle-o"></i> Lonee</a></li>
             <li class="{{Request::is('admin/loan/lendar') ?'active':''}}""><a href="{{route('admin.loan.lendar')}}"><i class="fa fa-circle-o"></i> Lendar</a></li>
          </ul>
        </li>

         <li class="treeview {{Request::is('admin/bank*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Bank</span>
            <span class="pull-right-container">
              <span class="label label-info pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/back/index') ?'active':''}}""><a href="{{route('admin.bank.index')}}"><i class="fa fa-circle-o"></i> Bank</a></li>
             <li class="{{Request::is('admin/back/transfer') ?'active':''}}""><a href="{{route('admin.bank.transfer')}}"><i class="fa fa-circle-o"></i> Manage Transfer</a></li>

             <li class="{{Request::is('admin/back/createtransfer') ?'active':''}}""><a href="{{route('admin.bank.createtransfer')}}"><i class="fa fa-circle-o"></i> Account Transfer</a></li>

            <li class="{{Request::is('admin/back/transjaction') ?'active':''}}""><a href="{{route('admin.bank.transjaction')}}"><i class="fa fa-circle-o"></i> Transactions</a></li>
          </ul>
        </li>

        <li class="treeview {{Request::is('admin/account*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Account</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">3</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/account/index') ?'active':''}}""><a href="{{route('admin.account.index')}}"><i class="fa fa-circle-o"></i> Account</a></li>

              <li class="{{Request::is('admin/account/payment') ?'active':''}}""><a href="{{route('admin.account.payment')}}"><i class="fa fa-circle-o"></i> Payment</a></li>

               <li class="{{Request::is('admin/account/receipt') ?'active':''}}""><a href="{{route('admin.account.receipt')}}"><i class="fa fa-circle-o"></i> Receipt</a></li>
          </ul>
        </li>

         <li class="treeview {{Request::is('admin/setting*') ?'active':''}}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Setting</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">1</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/backup/setting') ?'active':''}}""><a href="{{route('admin.account.setting')}}"><i class="fa fa-circle-o"></i> Setting</a></li>
               <li class="{{Request::is('admin/backup/companyprofile') ?'active':''}}""><a href="{{route('admin.account.companyprofile')}}"><i class="fa fa-circle-o"></i> Company Profile</a></li>
            <li class="{{Request::is('admin/backup/backup') ?'active':''}}""><a href="{{route('admin.setting.backup')}}"><i class="fa fa-circle-o"></i> Backup</a></li>
          </ul>
        </li>
      </ul>
    </section>