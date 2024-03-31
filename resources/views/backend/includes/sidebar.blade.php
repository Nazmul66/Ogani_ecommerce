        <!-- left sidebar -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">

                            <li class="nav-divider">Menu</li>

                            <li class="nav-item ">
                                <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard <span class="badge badge-success">6</span></a>
                            </li>

                            <!-- Blog list  -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9">
                                    <i class="fas fa-fw fa-table"></i>Blog
                                </a>

                                <div id="submenu-9" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('blog.create') }}">Add Blogs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('blog.manage') }}">Manage Blogs</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
                            <!-- Category list  -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1">
                                    <i class="fas fa-fw fa-table"></i>Category
                                </a>

                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('category.create') }}">Add Categories</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('category.manage') }}">Manage Categories</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- SubCategory list  -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2">
                                    <i class="fas fa-fw fa-table"></i>SubCategory
                                </a>

                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('subCategory.create') }}">Add SubCategory</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('subCategory.manage') }}">Manage SubCategory</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                             <!-- ChildCategory list  -->
                             <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3">
                                    <i class="fas fa-fw fa-table"></i>ChildCategory
                                </a>

                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('childCategory.create') }}">Add ChildCategory</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('childCategory.manage') }}">Manage ChildCategory</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Brand list  -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4">
                                    <i class="fas fa-fw fa-table"></i>Brand
                                </a>

                                <div id="submenu-4" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('brand.create') }}">Add Brand</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('brand.manage') }}">Manage Brand</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Products list  -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7" aria-controls="submenu-7">
                                    <i class="fas fa-fw fa-table"></i>Products
                                </a>

                                <div id="submenu-7" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('product.create') }}">New Products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('product.manage') }}">Manage Products</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                             <!-- Warehouse list  -->
                             <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5">
                                    <i class="fas fa-fw fa-table"></i>Warehouse
                                </a>

                                <div id="submenu-5" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('warehouse.create') }}">Add Warehouse</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('warehouse.manage') }}">Manage Warehouse</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Pickup Point list  -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6">
                                    <i class="fas fa-fw fa-table"></i>Pickup Point
                                </a>

                                <div id="submenu-6" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('pickup.create') }}">Add Pickup Point</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('pickup.manage') }}">Manage Pickup Point</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                             <!-- Customer list  -->
                             <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" aria-expanded="false" data-target="#submenu-12" aria-controls="submenu-12">
                                    <i class="fas fa-fw fa-table"></i>Customer
                                </a>

                                <div id="submenu-12" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('customer.manage') }}">Manage Customer</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Order list  -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" aria-expanded="false" data-target="#submenu-11" aria-controls="submenu-11">
                                    <i class="fas fa-fw fa-table"></i>Order
                                </a>

                                <div id="submenu-11" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('order.manage') }}">Orders</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            
                            <!-- Country list  -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" aria-expanded="false" data-target="#submenu-13" aria-controls="submenu-13">
                                    <i class="fas fa-fw fa-table"></i>Country
                                </a>

                                <div id="submenu-13" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('country.create') }}">Add Country</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('country.manage') }}">Manage Country</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Division list  -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" aria-expanded="false" data-target="#submenu-15" aria-controls="submenu-15">
                                    <i class="fas fa-fw fa-table"></i>Division
                                </a>

                                <div id="submenu-15" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('division.create') }}">Add Division</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('division.manage') }}">Manage Division</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                             <!-- User Role list  -->
                             <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" aria-expanded="false" data-target="#submenu-14" aria-controls="submenu-14">
                                    <i class="fas fa-fw fa-table"></i>User Role
                                </a>

                                <div id="submenu-14" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="">Create New Role</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">Manage Role</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <li class="nav-divider">
                                Option
                            </li>
                            <!-- offer list  -->
                            <li class="nav-item" style="cursor: pointer;">
                                <a class="nav-link" data-toggle="collapse" aria-expanded="false" data-target="#submenu-100" aria-controls="submenu-100">
                                    <i class="fas fa-fw fa-table"></i>Offer
                                </a>

                                <div id="submenu-100" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('coupon.manage') }}">Coupon</a>
                                        </li> 
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('campaign.manage') }}">E Campaign</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                             <!-- setting list  -->
                            <li class="nav-item" style="cursor: pointer;">
                                <a class="nav-link" data-toggle="collapse" aria-expanded="false" data-target="#submenu-101" aria-controls="submenu-101">
                                    <i class="fas fa-fw fa-table"></i>Setting
                                </a>

                                <div id="submenu-101" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('seo.setting') }}">SEO Setting</a>
                                        </li> 
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('website.setting') }}">Website Setting</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('page.manage') }}">Page Manage</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('smtp.setting') }}">SMTP Setting</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('payment.gateway') }}">Payment Gateway</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- end left sidebar -->