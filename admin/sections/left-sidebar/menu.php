            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="active" id="menu">
                        <a href="cashier.php">
                            <i class="material-icons">shopping_cart</i>
                            <span>Cashier</span>
                        </a>
                    </li>
                    <li class="active" id="menu">
                        <a href="products.php">
                            <i class="material-icons">view_list</i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li class="active" id="menu">
                        <a href="suppliers.php">
                            <i class="material-icons">local_shipping</i>
                            <span>Suppliers</span>
                        </a>
                    </li>
                    <li class="active" id="menu">
                        <a href="category.php">
                            <i class="material-icons">sort</i>
                            <span>Category</span>
                        </a>
                    </li>
                    <li class="active" id="menu">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">group</i>
                            <span>Users</span>
                        </a>
                        <ul class="ml-menu active"  id="menu">
                            <li>
                                <a href="#">Employees</a>
                            </li>
                            <li>
                                <a href="#">Customers</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active" id="menu">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">show_chart</i>
                            <span>Reports</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="inventory-report.php">Inventory Report</a>
                            </li>
                            <li>
                                <a href="sales-report.php">Sales Report</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>


            <script>
                $(document).ready(function () {

                    $("#menu").on("click", function () {
                        $("#menu").removeClass("active");
                        $(this).addClass("active");
                    });

                });
            </script>