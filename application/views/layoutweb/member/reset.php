<!--Body Content-->
<div id="page-content" style="padding-bottom: 5%">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Ubah Password</h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                <div class="mb-4">
                    <?= $this->session->flashdata('message'); ?>
                    <form method="post" action="<?= base_url('member/changePassword') ?>" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="CustomerPassword">Password</label>
                                    <input type="password" value="" name="password1" placeholder="password" id="CustomerPassword1" class="">
                                    <?= form_error('password1', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="CustomerPassword">Ulangi Password</label>
                                    <input type="password" value="" name="password2" placeholder="ulangi password" id="CustomerPassword2" class="">
                                    <?= form_error('password2', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" class="btn mb-3" value="Reset Password">
                                <p class="mb-4">
                                    <a href="<?= base_url('member') ?>" id="RecoverPassword">Sudah memiliki akun? Login disini.</a> &nbsp; | &nbsp;
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