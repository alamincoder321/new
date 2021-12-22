  <!-- ========== Left Sidebar Start ========== -->

  <div class="left side-menu" >
    <div class="slimScrollDiv">
      <div class="sidebar-inner slimscrollleft" style="width: auto;overflow: scroll;height: 700px; position: relative;">
        <!--- Divider -->
        <div id="sidebar-menu">
          <ul>
            <li class="bg-success">
              <a href="{{ route('pos') }}" class="waves-effect @yield('Pos')"><i
                class=" md-account-balance"></i><span> POS </span></a>
              </li>

              <li>
                <a href="{{ route('dashboard') }}" class="waves-effect @yield('dashboard')"><i
                  class="md md-home"></i><span> Dashboard </span></a>
                </li>

                <li class="has_sub">
                  <a class="waves-effect @yield('chalan')"><i class="md-payment"></i><span> Chalan
                  </span><span class="pull-right"><i class="md md-add"></i></span></a>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('chalan.create') }}">Chalan Create</a></li>
                    <li><a href="{{ route('chalan.index') }}">Manage Chalan</a></li>
                  </ul>
                </li>
                
                <li class="has_sub">
                  <a class="waves-effect @yield('order')"><i class="md-shopping-cart"></i><span> Sells
                  </span><span class="pull-right"><i class="md md-add"></i></span></a>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('details') }}">Sells Details</a></li>
                  </ul>
                </li>

                <li class="has_sub">
                  <a class="waves-effect @yield('customer')"><i class="fa fa-users"></i><span> Customer
                  </span><span class="pull-right"><i class="md md-add"></i></span></a>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('customer.create') }}">Add Customer</a></li>
                    <li><a href="{{ route('customer.index') }}">Manage Customer</a></li>
                  </ul>
                </li>

                <li class="has_sub">
                  <a class="waves-effect @yield('employee')"><i class="fa fa-users"></i><span> Employee
                  </span><span class="pull-right"><i class="md md-add"></i></span></a>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('employee.create') }}">Add Employee</a></li>
                    <li><a href="{{ route('employee.index') }}">Manage Employee</a></li>
                  </ul>
                </li>

                <li class="has_sub">
                  <a class="waves-effect @yield('job')"><i class=" md-palette"></i><span> Job
                  </span><span class="pull-right"><i class="md md-add"></i></span></a>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('job.create') }}">Add Job</a></li>
                    <li><a href="{{ route('job.index') }}">Manage Job</a></li>
                  </ul>
                </li>

                <li class="has_sub">
                  <a class="waves-effect @yield('salary')"><i class=" md-palette"></i><span> Salary
                  </span><span class="pull-right"><i class="md md-add"></i></span></a>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('salary.create') }}">Add Salary</a></li>
                    <li><a href="{{ route('salary.index') }}">Manage Salary</a></li>
                  </ul>
                </li>

                <li class="has_sub">
                  <a class="waves-effect @yield('supplier')"><i class="fa fa-users"></i><span> Supplier
                  </span><span class="pull-right"><i class="md md-add"></i></span></a>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('supplier.create') }}">Add Supplier</a></li>
                    <li><a href="{{ route('supplier.index') }}">Manage Supplier</a></li>
                    <li><a href="{{ route('supdue') }}">Supplier Due</a></li>
                  </ul>
                </li>

                <li class="has_sub">
                  <a class="waves-effect @yield('category')"><i class=" md-palette"></i><span> Category
                  </span><span class="pull-right"><i class="md md-add"></i></span></a>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('category.create') }}">Add Category</a></li>
                    <li><a href="{{ route('category.index') }}">Manage Category</a></li>
                  </ul>
                </li>

                <li class="has_sub">
                  <a class="waves-effect @yield('product')"><i class=" md-palette"></i><span> Product
                  </span><span class="pull-right"><i class="md md-add"></i></span></a>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('product.create') }}">Add Product</a></li>
                    <li><a href="{{ route('product.index') }}">Manage Product</a></li>
                  </ul>
                </li>

                <li class="has_sub">
                  <a class="waves-effect @yield('expense')"><i class=" md-palette"></i><span> Expense
                  </span><span class="pull-right"><i class="md md-add"></i></span></a>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('expense.create') }}">Add Expense</a></li>
                    <li><a href="{{ route('expense.index') }}">Mange Expense</a></li>
                  </ul>
                </li>

                <li class="has_sub">
                  <a class="waves-effect @yield('report')"><i class=" md-payment"></i><span> Sells Report
                  </span><span class="pull-right"><i class="md md-add"></i></span></a>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('index') }}">Manage</a></li>
                    <li><a href="{{ route('due.show') }}">Due List</a></li>
                  </ul>
                </li>

                <li class="has_sub">
                  <a class="waves-effect @yield('setting')"><i class="fa fa-cogs" aria-hidden="true"></i><span> Setting
                  </span><span class="pull-right"><i class="md md-add"></i></span></a>
                  <ul class="list-unstyled">
                    <li><a href="{{ route('setting.create') }}">Software Setting create</a></li>
                    <li><a href="{{ route('setting.index') }}">Software Setting manage</a></li>
                    <li><a href="{{ route('company.create') }}">Invoice setting Create</a></li>
                    <li><a href="{{ route('company.index') }}">Invoice Setting Manage</a></li>
                  </ul>
                </li>

              </ul>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
  <!-- Left Sidebar End -->