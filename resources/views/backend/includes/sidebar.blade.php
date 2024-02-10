        <!-- left sidebar -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">

                            <li class="nav-divider"> Menu</li>

                            <li class="nav-item ">
                                <a class="nav-link active" href="#">Dashboard <span class="badge badge-success">6</span></a>
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


                            <li class="nav-divider">
                                Option
                            </li>
                             <!-- setting list  -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-100" aria-controls="submenu-100">
                                    <i class="fas fa-fw fa-table"></i>Setting
                                </a>

                                <div id="submenu-100" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('seo.setting') }}">SEO Setting</a>
                                        </li> 
                                        <li class="nav-item">
                                            <a class="nav-link" href="">Website Setting</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">Page Create</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('smtp.setting') }}">SMTP Setting</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">Payment Gateway</a>
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