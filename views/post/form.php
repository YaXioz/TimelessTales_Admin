<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/vendors/ti-icons/css/themify-icons.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/vendors/css/vendor.bundle.base.css" />
    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css" />
    <link href="<?= BASE_URL ?>/assets/vendors/datatables/datatables.css" rel="stylesheet" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <a class="navbar-brand text-primary brand-logo" href="index.html">
                    TimelessTales <sup><i class="fa fa-compass"></i></sup>
                </a>
                <a class="navbar-brand brand-logo-mini" href="index.html">
                    <i class="fa fa-compass text-primary fs-3"></i>
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button
                    class="navbar-toggler navbar-toggler align-self-center"
                    type="button"
                    data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input
                                type="text"
                                class="form-control bg-transparent border-0"
                                placeholder="Search projects" />
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            id="profileDropdown"
                            href="#"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="<?= BASE_URL ?>/assets/images/faces/face27.jpg" alt="image" />
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">Bima Maulana H</p>
                            </div>
                        </a>
                        <div
                            class="dropdown-menu navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-user me-2 text-success"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= BASE_URL ?>/logout">
                                <i class="fa fa-sign-out me-2 text-primary"></i> Signout
                            </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li>
                </ul>
                <button
                    class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
                    type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="<?= BASE_URL ?>/assets/images/faces/face27.jpg" alt="profile" />
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">Bima Maulana H</span>
                                <span class="text-secondary text-small">Project Manager</span>
                            </div>
                            <i class="fa fa-certificate text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/dashboard">
                            <span class="menu-title">Dashboard</span>
                            <i class="fa fa-desktop menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/users">
                            <span class="menu-title">User</span>
                            <i class="mdi mdi-contacts menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/timelines">
                            <span class="menu-title">Timeline</span>
                            <i class="fa fa-road menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= BASE_URL ?>/posts">
                            <span class="menu-title">Post</span>
                            <i class="fa fa-camera-retro menu-icon"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span
                                class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-contacts"></i>
                            </span>
                            Post Data
                        </h3>
                    </div>
                    <?php if (isset($message['server'])): ?>
                        <div class="alert alert-<?php echo $message_type ?? 'success'; ?>" role="alert">
                            <?php
                            echo $message['server'];
                            ?>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $action == 'edit' ? 'Edit Post Data' : 'Create New Post' ?></h4>
                                    <p class="card-description"> Basic form elements </p>
                                    <form class="forms-sample" method="post" action="<?= BASE_URL ?>/posts/<?= $action ?>" enctype="multipart/form-data">
                                        <?php if ($action == 'edit') : ?>
                                            <input type="hidden" name="id" value="<?= $action == 'edit' ? $post->id : '' ?>">
                                        <?php endif ?>

                                        <div class="form-group">
                                            <label for="timeline_id">Timeline</label>
                                            <select class="form-select" id="timeline_id" name="timeline_id">
                                                <?php foreach ($timelines as $timeline): ?>
                                                    <option value="<?= $timeline->id ?>"><?= $timeline->user_id . " | " . $timeline->year ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <?php if (isset($message['timeline_id'])): ?>
                                                <div class="form-text text-danger">
                                                    <?= $message['timeline_id'] ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                        <div class="form-group">
                                            <label>File upload</label>
                                            <input type="file" name="image" class="file-upload-default">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-gradient-primary py-3" type="button">Upload</button>
                                                </span>
                                            </div>
                                            <?php if (isset($message['image'])): ?>
                                                <div class="form-text text-danger">
                                                    <?= $message['image'] ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="desc">Description</label>
                                            <input type="text" class="form-control" id="desc" name="desc" value="<?= $action == 'edit' ? htmlspecialchars($post->description) : ''; ?>" placeholder="Description">
                                            <?php if (isset($message['desc'])): ?>
                                                <div class="form-text text-danger">
                                                    <?= $message['desc'] ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="year">Even Date</label>
                                            <input type="date" class="form-control" id="date" name="date" value="<?= $action == 'edit' ? htmlspecialchars($post->date) : ''; ?>" placeholder="Year">
                                            <?php if (isset($message['date'])): ?>
                                                <div class="form-text text-danger">
                                                    <?= $message['date'] ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                        <a class="btn btn-light" href="<?= BASE_URL ?>/users">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer bg-gradient-light shadow-sm">
                    <div
                        class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023
                            <a
                                class="text-primary"
                                href="https://www.bootstrapdash.com/"
                                target="_blank">BootstrapDash</a>. All rights reserved.</span>
                        <span
                            class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="fa fa-heart text-danger"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= BASE_URL ?>/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= BASE_URL ?>/assets/vendors/chart.js/chart.umd.js"></script>
    <script src="<?= BASE_URL ?>/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?= BASE_URL ?>/assets/vendors/datatables/datatables.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/datatables.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= BASE_URL ?>/assets/js/off-canvas.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/misc.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/settings.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/todolist.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?= BASE_URL ?>/assets/js/file-upload.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/typeahead.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/select2.js"></script>
    <!-- End custom js for this page -->
</body>

</html>