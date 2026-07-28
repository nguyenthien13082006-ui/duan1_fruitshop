<?php require_once 'views/layout/header.php'; ?>

<?php require_once 'views/layout/menu.php'; ?>
<style>
    /* căn giữa form đăng ký */
    .login-reg-form-wrap {
        width: 100%;
        max-width: 500px;
        margin: 60px auto;
        /* căn giữa ngang */
    }

    .col-lg-6 {
        margin: 0 auto;
    }
</style>
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">login-Register</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- login register wrapper start -->
    <div class="col-lg-6">
        <div class="login-reg-form-wrap sign-up-form">
            <h5 class="text-center">Đăng kí</h5>

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger">

                    <?php
                    if (is_array($_SESSION['error'])) {
                        foreach ($_SESSION['error'] as $error) {
                            echo "<p class='text-center'>$error</p>";
                        }
                    } else {
                        echo "<p class='text-center'>" . $_SESSION['error'] . "</p>";
                    }
                    ?>

                </div>
            <?php unset($_SESSION['error']);
            } ?>

            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success text-center">
                    <?= $_SESSION['success'] ?>
                </div>
            <?php unset($_SESSION['success']);
            } ?>

            <form action="<?= BASE_URL ?>?act=post-signup" method="POST">

                <div class="single-input-item">
                    <input type="text" name="ten" placeholder="Full Name" required>
                </div>

                <div class="single-input-item">
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="single-input-item">
                    <input type="date" name="ngay_sinh" required>
                </div>

                <div class="single-input-item">
                    <input type="text" name="so_dien_thoai" placeholder="Số điện thoại" required>
                </div>

                <div class="single-input-item">
                    <input type="text" name="dia_chi" placeholder="Địa chỉ" required>
                </div>

                <div class="row">

                    <div class="col-lg-6">
                        <div class="single-input-item">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="single-input-item">
                            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                        </div>
                    </div>

                </div>

                <div class="single-input-item">
                    <button class="btn btn-sqr">Đăng ký</button>
                </div>

            </form>

        </div>
    </div>
    <!-- login register wrapper end -->
</main>
<!-- offcanvas mini cart start -->
<div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="pe-7s-close"></i>
            </div>
            <div class="minicart-content-box">
                <div class="minicart-item-wrapper">
                    <ul>
                        <li class="minicart-item">
                            <div class="minicart-thumb">
                                <a href="product-details.html">
                                    <img src="assets/img/cart/cart-1.jpg" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
                                    <a href="product-details.html">Dozen White Botanical Linen Dinner Napkins</a>
                                </h3>
                                <p>
                                    <span class="cart-quantity">1 <strong>&times;</strong></span>
                                    <span class="cart-price">$100.00</span>
                                </p>
                            </div>
                            <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                        </li>
                        <li class="minicart-item">
                            <div class="minicart-thumb">
                                <a href="product-details.html">
                                    <img src="assets/img/cart/cart-2.jpg" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
                                    <a href="product-details.html">Dozen White Botanical Linen Dinner Napkins</a>
                                </h3>
                                <p>
                                    <span class="cart-quantity">1 <strong>&times;</strong></span>
                                    <span class="cart-price">$80.00</span>
                                </p>
                            </div>
                            <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                        </li>
                    </ul>
                </div>

                <div class="minicart-pricing-box">
                    <ul>
                        <li>
                            <span>sub-total</span>
                            <span><strong>$300.00</strong></span>
                        </li>
                        <li>
                            <span>Eco Tax (-2.00)</span>
                            <span><strong>$10.00</strong></span>
                        </li>
                        <li>
                            <span>VAT (20%)</span>
                            <span><strong>$60.00</strong></span>
                        </li>
                        <li class="total">
                            <span>total</span>
                            <span><strong>$370.00</strong></span>
                        </li>
                    </ul>
                </div>

                <div class="minicart-button">
                    <a href="<?= BASE_URL . '?act=gio-hang' ?>"><i class="fa fa-shopping-cart"></i> View Cart</a>
                    <a href="<?= BASE_URL . '?act=thanh-toan' ?>"><i class="fa fa-share"></i> Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas mini cart end -->

<?php require_once 'views/layout/footer.php'; ?>