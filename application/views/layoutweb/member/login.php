<!--Body Content-->
<div id="page-content" style="padding-bottom: 5%">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Login</h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                <div class="mb-4">
                    <?= $this->session->flashdata('message'); ?>
                    <form method="post" action="<?= base_url('member') ?>" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="CustomerEmail">Email atau Username</label>
                                    <input type="text" name="email" placeholder="email atau username" id="CustomerEmail" class="" autocorrect="off" autocapitalize="off" autofocus="" value="<?= set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="CustomerPassword">Password</label>
                                    <input type="password" value="" name="password" placeholder="password" id="CustomerPassword" class="">
                                    <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" class="btn mb-3" value="Sign In">
                                <p class="mb-4">
                                    <a href="<?= base_url('member/forgotPassword') ?>" id="RecoverPassword">Lupa password anda?</a> &nbsp; | &nbsp;
                                    <a href="<?= base_url('member/register') ?>" id="customer_register_link">Buat Akun!</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!--End Body Content-->