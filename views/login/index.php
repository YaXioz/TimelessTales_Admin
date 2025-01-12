<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TimelessTales Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <?php if (isset($message)): ?>
                            <div class="alert alert-<?php echo $message_type ?? 'danger'; ?>">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        <div class="auth-form-light text-left p-5 shadow">
                            <div class="text-primary brand-logo fs-3">
                                TimelessTales <sup><i class="fa fa-compass"></i></sup>
                            </div>
                            <h4>Hello Admin! keep smile, let's work.</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" method="post" action="<?= BASE_URL; ?>/login">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                                </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= BASE_URL ?>/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= BASE_URL ?>/assets/js/off-canvas.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/misc.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/settings.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/todolist.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
</body>

</html>