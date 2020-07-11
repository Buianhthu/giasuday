<?php
  session_start();
  $time = $_SERVER['REQUEST_TIME'];
  $timeout_duration = 900;
  if ( isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration ) {
    session_unset();
    session_destroy();
    session_start();
  }
  $_SESSION['LAST_ACTIVITY'] = $time;
  if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['level']) || !isset($_SESSION['avatar']) || $_SESSION['level'] != 1){
    header("location:../index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Danh sách review</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script type="text/javascript">
        function huyduyetreviewgs(temp) {
            var ID = temp.getAttribute("data-id");
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("notification").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "controllers/huyduyetreviewgs.php?id=" + ID, true);
            xhttp.send();
        }

            function duyetreviewgs(temp) {
                var ID = temp.getAttribute("data-id");
                var xhttp;
                xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("notification").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "controllers/duyetreviewgs.php?id=" + ID, true);
                xhttp.send();
            }
    </script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="duyettim_gs.php">Bài đăng tìm gia sư</a>
                        <a class="collapse-item" href="index.php">Danh sách gia sư</a>
                        <a class="collapse-item" href="duyetreview_gs.php">Đánh giá gia sư</a>
                    </div>
                </div>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin duyet tim kiem gia su-->
                <div id="main">
                    <div class="container">
                        <div id="notification"></div>
                        <h2>Quản lý bài viết đánh giá gia sư</h2>
                        <table class="table table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Nội Dung</th>
                                    <th>Ngày Đăng</th>
                                    <th>Kiểm Duyệt</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="content">
                                <?php
                                require_once('controllers/data_access_helper.php');

                                // Create an instance of data access helper
                                $db = new DataAccessHelper();

                                // Connect to database
                                $db->connect();

                                // Set up biến, query
                                $limit = 4;
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $start = ($page - 1) * $limit;
                                $result = $db->executeQuery("SELECT * FROM review LIMIT $start, $limit");

                                if (!$result) {
                                    die("ERROR: " . $db->connect_error);
                                    exit();
                                }

                                // Count page numbers
                                $result1 = $db->executeQuery("SELECT count(*) AS id FROM review");
                                $count = $result1->fetch_array(MYSQLI_ASSOC);
                                $total = $count['id'];
                                $numPages = ceil($total / $limit);

                                $Previous = $page - 1;
                                if ($Previous < 1) {
                                    $Previous = 1;
                                }
                                $Next = $page + 1;
                                if ($Next > $numPages) {
                                    $Next = $numPages;
                                }

                                while ($row = mysqli_fetch_row($result)) {  /*
                                    echo "<tr>";
                                    //lay field tung dong
                                    echo "<td>" . $row[0] . "</td>" . "<td>" . $row[1] . "</td>" . "<td>" . $row[2] . "</td>" . "<td>" . $row[3] . "</td>" . "<td>" . $row[4] . "</td>" . "<td>" . $row[5] . "</td>";
                                    echo "</tr>"; 
                                    */

                                    echo "<tr>";

                                    echo "<td>" . $row[0] . "</td>";
                                    echo "<td>" . $row[1] . "</td>";
                                    echo "<td>" . $row[2] . "</td>";
                                    echo "<td>" . $row[3] . "</td>";
                                    
                                    if($row[4]== 1)
                                    {
                                        
                                        echo"<td>đã kiểm duyệt</td>";
                                        echo '<td><button class="icon" data-id="' . $row[0] . '" onclick="huyduyetreviewgs(this)"><i class="fas fa-times-circle" style="color:#4e73df"></i></button>';
                                    }
                                    else
                                    {
                                        echo"<td>chưa kiểm duyệt</td>";
                                        echo '<td><button class="icon" data-id="' . $row[0] . '" onclick="duyetreviewgs(this)"><i class="fas fa-check-circle" style="color:#4e73df"></i></button>';
                                    }
                                    
                                    echo '<button class="icon"><a class="icon" href="detailreview_gs.php?id='.$row[0].'"> <i class="fas fa-info-circle "></i></a></button>';
                                    echo "</tr>";
                                }

                                //Close connection
                                $db->close();
                                ?>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div style="text-align:center">
                            <ul class="pagination justify-content-center mt-5">
                                <li class="page-item"><a class="page-link" href="duyetreview_gs.php?page=<?= $Previous; ?>">
                                        <i class="fas fa-angle-left mr-2"></i></a>
                                </li>
                                <li>
                                    <?php
                                    $pagination = "";
                                    for ($i = 1; $i <= $numPages; $i++) {
                                        if ($i == $page) {
                                            $pagination .= '<li class="page-item active"><a class="page-link" href="duyetreview_gs.php?page=' . $i . '">' . $i . '</a><li>';
                                        } else {
                                            $pagination .= '<li class="page-item"><a class="page-link" href="duyetreview_gs.php?page=' . $i . '">' . $i . '</a><li>';
                                        }
                                    }
                                    echo $pagination;
                                    ?>
                                </li>
                                <li class="page-item"><a class="page-link" href="duyetreview_gs.php?page=<?= $Next; ?>">
                                        <i class="fas fa-angle-right ml-2"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">

                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>