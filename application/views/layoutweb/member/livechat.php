<style>
    body {
        min-height: 100vh;
    }

    ::-webkit-scrollbar {
        width: 5px;
    }

    ::-webkit-scrollbar-track {
        width: 5px;
        background: #f5f5f5;
    }

    ::-webkit-scrollbar-thumb {
        width: 1em;
        background-color: #ddd;
    }

    .text-small {
        font-size: 0.9rem;
    }

    .messages-box,
    .chat-box {
        height: 600px;
        overflow-y: scroll;
    }

    .rounded-lg {
        border-radius: 0.5rem;
    }

    input::placeholder {
        font-size: 0.9rem;
        color: #999;
    }

    .user-picture {
        display: inline-block;
        width: 50px;
        height: 50px;
        border-radius: 50%;

        object-fit: cover;
    }
</style>
<!--Body Content-->
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width"><?= $title ?></h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 cart__footer mb-4">
                <div class="cart-note">
                    <div class="solid-border">
                        <div class="row">
                            <div class="col-sm-10">
                                <h5><label for="CartSpecialInstructions" class="cart-note__label small--text-center">Foto Profile</label></h5>
                            </div>
                            <div class="col-sm-2">
                                <a href="javascript:void(0)" title="Ganti Foto" data-toggle="modal" data-target="#content_quickview">
                                    <i class="anm anm-edit" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="customer-profile">
                                <a href="#" class="d-inline-block"><img src="<?= base_url('assets/gambar_member/') . $user['gambar'] ?>" class="img-fluid rounded-circle customer-image">
                                </a>
                            </div>
                            <div class="col-lg pt-3">
                                <h5 class="d-flex justify-content-center"><?= $user['nama_lengkap'] ?></h5>
                                <p class="text-muted text-small d-flex justify-content-center"><?= $user['email'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <nav class="list-group customer-nav">
                            <a href="<?= base_url('member/orders') ?>" class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Orders</span>
                                <small class="badge badge-pill badge-primary"><?= $list ?></small>
                            </a>
                            <a href="<?= base_url('livechat') ?>" class="<?php if ($this->uri->segment(1) == 'livechat') {
                                                                                echo 'active';
                                                                            } ?> list-group-item d-flex justify-content-between align-items-center">
                                <span>Live Chat</span>
                            </a>
                            <a href="<?= base_url('member/dashboard') ?>" class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Profile</span>
                            </a>
                            <a href="<?= base_url('member/edit') ?>" class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Edit Profile</span>
                            </a>
                            <a href="<?= base_url('member/logout') ?>" class="list-group-item d-flex justify-content-between align-items-center">
                                <span><span class="fa fa-sign-out"></span>Log out</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                <div class="container">
                    <div class="row rounded-lg overflow-hidden shadow">
                        <!-- Chat Box-->
                        <div class="col-md px-0">
                            <div class="px-4 py-5 chat-box bg-white" id="chat_body">
                                <!-- chat body -->
                            </div>

                            <!-- Typing area -->
                            <div class="input-group">
                                <input type="text" id="input_message" placeholder="Type a message..." aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                <div class="input-group-append">
                                    <input type="file" id="file_input" accept="image/png,image/jpg,image/jpeg" hidden />
                                    <button id="input_gambar" type="button" class="btn btn--secondary btn-link"> <i class="fa fa-paperclip"></i></button>
                                </div>
                                <div class="input-group-append">
                                    <button id="tombol_kirim" type="button" class="btn btn--secondary btn-link"> <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--End Body Content-->

<!--Quick View popup-->
<div class="modal fade quick-view-popup" id="content_quickview">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="ProductSection-product-template" class="product-template__container prstyle1">
                    <div class="product-single">
                        <!-- Start model close -->
                        <a href="javascript:void()" data-dismiss="modal" class="model-close-btn pull-right" title="close"><span class="icon icon anm anm-times-l"></span></a>
                        <!-- End model close -->
                        <div class="row">
                            <div class="col-sm-6 mx-auto">
                                <div class="product-details-img">
                                    <div class="pl-20">
                                        <img src="<?= base_url('assets/gambar_member/') . $user['gambar'] ?>" class="rounded" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-sm-10 mx-auto">
                                <div class="product-single__meta">
                                    <form method="post" action="<?= base_url('member/gambar') ?>" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                                        <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                            <div class="product-form__item">
                                                <input type="hidden" value="<?= $user['member_id'] ?>" name="id" id="id">
                                                <input type="file" id="gambar" name="gambar" class="form-control" required>
                                            </div>
                                        </div>
                                        <!-- Product Action -->
                                        <div class="product-action clearfix">
                                            <div class="product-form__item--submit">
                                                <button type="submit" name="add" class="btn product-form__cart-submit">
                                                    <span>Simpan</span>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- End Product Action -->
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--End-product-single-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Quick View popup-->

<script src="<?= base_url() ?>template/belle/assets/js/vendor/jquery-3.3.1.min.js"></script>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script type="text/javascript">
    var Halaman = '<?= $this->uri->segment('1') ?>';
    var id_member = <?= $this->session->userdata('id') ?>;

    $(document).ready(function() {
        chat_body();
    });

    var pusher = new Pusher('53605ae7340f790a342a', {
        cluster: 'ap1',
        forceTLS: true
    });

    var chat_send = pusher.subscribe('chat-channel');
    chat_send.bind('chat-send', function(data) {
        if (data.id_member == id_member) {
            if (Halaman == 'livechat') {
                chat_body();
            }
        }
    });

    var chat_read = pusher.subscribe('chat-channel');
    chat_read.bind('chat-read-admin', function(data) {
        if (data.id_member == id_member) {
            if (Halaman == 'livechat') {
                pusher_chat_body();
            }
        }
    });

    function chat_body() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('livechat/load_chat_body') ?>",
            dataType: "JSON",
            async: false,
            success: function(data) {
                $('#chat_body').html(data.item);
                $('#input_message').focus();
                var myDiv = document.getElementById("chat_body");
                myDiv.scrollTop = myDiv.scrollHeight;
            }
        });
    }

    function pusher_chat_body() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('livechat/pusher_load_chat_body') ?>",
            dataType: "JSON",
            async: false,
            success: function(data) {
                $('#chat_body').html(data.item);
                $('#input_message').focus();
                var myDiv = document.getElementById("chat_body");
                myDiv.scrollTop = myDiv.scrollHeight;
            }
        });
    }

    $(document).on('click', '#input_gambar', function(event) {
        event.preventDefault();
        document.getElementById('file_input').click();
    });

    $("#file_input").on('change', function() {
        event.preventDefault();
        var myDiv = document.getElementById("chat_body");
        myDiv.innerHTML += '<div class="media w-50 ml-auto mb-3"><div class="media-body"><div class="bg-primary rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-white"><i class="fa fa-camera"></i> Photo</p></div><div><span class="small text-muted">sedang mengirim...</span></div></div></div>';
        myDiv.scrollTop = myDiv.scrollHeight;
        var id_member = $('#id_member').val();
        var id_admin = $('#id_admin').val();
        var type = 1;
        var formData = new FormData();
        formData.append("id_member", id_member);
        formData.append("id_admin", id_admin);
        formData.append("file_input", document.getElementById('file_input').files[0]);
        formData.append("type", type);
        $.ajax({
            url: "<?= base_url('livechat/chat_insert') ?>",
            enctype: 'multipart/form-data',
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                if (data.error !== 'true') {
                    chat_body();
                    $('#input_message').val('');
                    $('#input_message').focus();
                } else {
                    chat_body();
                    errorChatting();
                }
            }
        });
    });

    $(document).on('click', '#tombol_kirim', function(event) {
        event.preventDefault();
        var message = $('#input_message').val();
        var id_member = $('#id_member').val();
        var id_admin = $('#id_admin').val();
        var myDiv = document.getElementById("chat_body");
        myDiv.innerHTML += '<div class="media w-50 ml-auto mb-3"><div class="media-body"><div class="bg-primary rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-white">' + message + '</p></div><div><span class="small text-muted">sedang mengirim...</span></div></div></div>';
        myDiv.scrollTop = myDiv.scrollHeight;
        $('#input_message').val('');
        $('#input_message').focus();
        if (message !== '') {
            $.ajax({
                url: "<?= base_url('livechat/chat_insert') ?>",
                method: "POST",
                dataType: 'json',
                data: {
                    id_member: id_member,
                    id_admin: id_admin,
                    message: message,
                    type: 0
                },
                success: function(data) {
                    chat_body();
                }
            });
        }
    });

    $("#input_message").keyup(function(event) {
        if (event.keyCode === 13) {
            $("#tombol_kirim").click();
        }
    });
</script>