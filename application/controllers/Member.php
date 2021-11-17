<?php

class Member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('mod_member', 'member');
    }

    function index()
    {
        if ($this->session->userdata('username')) {
            redirect('home');
        }

        $data['title'] = 'The Crabbys - Member Login';

        $this->form_validation->set_rules('email', 'Email atau Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run()) {
            $this->login_proses();
        } else {
            $id_member = $this->session->userdata('id');
            $data['newmessage'] = '';
            if ($id_member) {
                $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
                $chat = $this->db->query($sql)->result();
                if ($chat) {
                    $data['newmessage'] = 'ada';
                }
            }
            $this->load->view('layoutweb/header', $data);
            $this->load->view('layoutweb/navigation', $data);
            $this->load->view('layoutweb/member/login', $data);
            $this->load->view('layoutweb/footer');
        }
    }



    function register()
    {
        if ($this->session->userdata('username')) {
            redirect('home');
        }

        $data['title'] = 'The Crabbys - Member Registration';

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tabel_member.username]|alpha_numeric', [
            'is_unique' => 'Username sudah terdaftar!',
            'alpha_numeric' => 'Hanya huruf dan angka yang diperbolehkan! Tanpa spasi.'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tabel_member.email]', [
            'is_unique' => 'Email sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'min_length' => 'Password terlalu pendek!',
            'matches' => 'Password tidak cocok!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'matches' => 'Password tidak cocok!'
        ]);

        if ($this->form_validation->run()) {
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $pass = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

            $this->member->simpan($nama, $username, $email, $pass);
            //siapkan token
            $token = base64_encode(random_bytes(64));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('tabel_member_token', $user_token);

            //kirim email aktivasi
            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat akun anda telah dibuat. Mohon periksa email untuk mengaktifkan akun. Jika email belum diterima mohon ditunggu atau cek folder spam anda.</div>');
            redirect('member');
        } else {
            $id_member = $this->session->userdata('id');
            $data['newmessage'] = '';
            if ($id_member) {
                $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
                $chat = $this->db->query($sql)->result();
                if ($chat) {
                    $data['newmessage'] = 'ada';
                }
            }
            $this->load->view('layoutweb/header', $data);
            $this->load->view('layoutweb/navigation', $data);
            $this->load->view('layoutweb/member/register', $data);
            $this->load->view('layoutweb/footer');
        }
    }

    function login_proses()
    {
        $emailuser = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->query("select * from tabel_member where username='$emailuser' OR email = '$emailuser'")->row_array();

        //jika user ada
        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    //sukses
                    $data = [
                        'username' => $user['username'],
                        'nama_member' => $user['nama_lengkap'],
                        'id' => $user['member_id'],
                    ];
                    $ubahstatus = 'login';
                    $this->member->login_status($ubahstatus, $user['member_id']);
                    $this->session->set_userdata($data);
                    redirect('home');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Gagal login! Password anda salah.</div>');
                    redirect('member');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email belum diverifikasi! Silahkan cek email anda.</div>');
                redirect('member');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal login! Akun belum terdaftar. Silahkan daftar terlebih dahulu.</div>');
            redirect('member');
        }
    }

    public function logout()
    {
        $ubahstatus = 'logout';
        $this->member->login_status($ubahstatus, $this->session->userdata('id'));
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama_member');
        $this->session->unset_userdata('id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Anda telah logout!</div>');
        redirect('member');
    }

    public function dashboard()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Anda belum login! Silahkan login atau daftar terlebih dahulu.</div>');
            redirect('member');
        }

        $data['title'] = 'The Crabbys - Member Dashboard';
        $data['user'] = $this->db->get_where('tabel_member', ['username' =>
        $this->session->userdata('username')])->row_array();
        $id_user = $this->session->userdata('id');
        $list = $this->db->get_where('tabel_transaksi', array(
            'member_id' => $id_user,
            'status <' => 5
        ))->result();
        $data['list'] = count($list);
        $data['kupon'] = array();
        $kupon = $this->db->query("SELECT * FROM `tabel_kupon_user` WHERE `id_member`=0 OR `id_member`=$id_user")->result();
        foreach ($kupon as $k) {
            $data['kupon'][] = $this->db->get_where('tabel_kupon', array('id' => $k->id_kupon))->row_array();
        }

        $id_member = $this->session->userdata('id');
        $data['newmessage'] = '';
        if ($id_member) {
            $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
            $chat = $this->db->query($sql)->result();
            if ($chat) {
                $data['newmessage'] = 'ada';
            }
        }

        $this->load->view('layoutweb/header', $data);
        $this->load->view('layoutweb/navigation', $data);
        $this->load->view('layoutweb/member/dashboard', $data);
        $this->load->view('layoutweb/footer');
    }

    public function dashboard_detail_voucher()
    {
        $kupon = $this->db->get_where('tabel_kupon', array('id' => $this->input->post('id')))->row_array();
        if ($kupon['kupon_type'] == 1) {
            $diskon = $kupon['diskon'] . '%';
            $maksd = 'Dengan maksimal diskon hingga Rp. ' . number_format($kupon['maksimal_diskon'], 0, ".", ".");
            $maksl = '<br><li>Dengan maksimal diskon hingga Rp. ' . number_format($kupon['maksimal_diskon'], 0, ".", ".") . '</li>';
        } else {
            $diskon = 'Rp. ' . number_format($kupon['diskon'], 0, ".", ".");
            $maksd = '';
            $maksl = '';
        }
        $deskripsi = 'Nikmati Potongan ' . $diskon . ' dengan minimal pemesanan senilai Rp. ' . number_format($kupon['minimum_spend'], 0, ".", ".") . '! ' . $maksd . '. <br><br> Voucher ini dapat digunakan sampai tanggal ' . date('d F Y', strtotime($kupon['last_date'])) . '. <br> Setelah tanggal tersebut voucher akan hilang dengan sendirinya.';
        $layanan = '<ol type="1"><li>Voucher hanya berlaku sampai tanggal ' . date('d F Y', strtotime($kupon['last_date'])) . '. </li><br><li>Voucher hanya bisa digunakan untuk memesan menu melalui website The Crabbys. </li><br><li>Penggunaan voucher tidak dapat digabungkan dengan voucher lainnya. </li><br><li>Voucher akan hangus apabila ditemukan indikasi kecurangan dalam mendapatkan voucher ini. </li><br><li>Voucher hanya berlaku untuk minimum pembelian Rp. ' . number_format($kupon['minimum_spend'], 0, ".", ".") . '.</li> ' . $maksl . '.</ol>';

        $output = array(
            "id" => $kupon['id'],
            "deskripsi" => $deskripsi,
            "layanan" => $layanan
        );
        //output to json format
        echo json_encode($output);
    }

    public function ubahpassword()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Anda belum login! Silahkan login atau daftar terlebih dahulu.</div>');
            redirect('member');
        }

        $data['title'] = 'The Crabbys - Member Ubah Password';
        $data['user'] = $this->db->get_where('tabel_member', ['username' =>
        $this->session->userdata('username')])->row_array();
        $list = $this->db->get_where('tabel_transaksi', array(
            'member_id' => $this->session->userdata('id'),
            'status <' => 5
        ))->result();
        $data['list'] = count($list);

        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('newpassword1', 'Password Baru', 'required|trim|min_length[3]|matches[newpassword2]', [
            'min_length' => 'Password baru terlalu pendek!',
            'matches' => 'Password tidak cocok!'
        ]);
        $this->form_validation->set_rules('newpassword2', 'Password Baru', 'required|trim|matches[newpassword1]', [
            'matches' => 'Password tidak cocok!'
        ]);

        if ($this->form_validation->run()) {
            $cekpassword = $this->input->post('password');
            $newpassword = password_hash($this->input->post('newpassword1'), PASSWORD_DEFAULT);
            $username = $this->session->userdata('username');

            $user = $this->db->query("select * from tabel_member where username='$username'")->row_array();
            if (password_verify($cekpassword, $user['password'])) {
                $this->db->set('password', $newpassword);
                $this->db->where('username', $username);
                $this->db->update('tabel_member');

                $this->session->unset_userdata('username');
                $this->session->unset_userdata('nama_member');
                $this->session->unset_userdata('id');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Password berhasil diubah! Silahkan login.</div>');
                redirect('member');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password gagal diubah! Password yang anda masukan salah.</div>');
                redirect('member/ubahpassword');
            }
        } else {
            $id_member = $this->session->userdata('id');
            $data['newmessage'] = '';
            if ($id_member) {
                $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
                $chat = $this->db->query($sql)->result();
                if ($chat) {
                    $data['newmessage'] = 'ada';
                }
            }
            $id_member = $this->session->userdata('id');
            $data['newmessage'] = '';
            if ($id_member) {
                $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
                $chat = $this->db->query($sql)->result();
                if ($chat) {
                    $data['newmessage'] = 'ada';
                }
            }
            $this->load->view('layoutweb/header', $data);
            $this->load->view('layoutweb/navigation', $data);
            $this->load->view('layoutweb/member/ubahpassword', $data);
            $this->load->view('layoutweb/footer');
        }
    }

    public function orders()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Anda belum login! Silahkan login atau daftar terlebih dahulu.</div>');
            redirect('member');
        }

        $data['title'] = 'The Crabbys - Member Orders';
        $data['user'] = $this->db->get_where('tabel_member', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['order'] = $this->db->order_by('transaksi_id', 'DESC')->get_where('tabel_transaksi', ['member_id' =>
        $this->session->userdata('id')])->result();
        $data['list'] = count($this->db->get_where('tabel_transaksi', array(
            'member_id' => $this->session->userdata('id'),
            'status <' => 5
        ))->result());
        $id_member = $this->session->userdata('id');
        $data['newmessage'] = '';
        if ($id_member) {
            $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
            $chat = $this->db->query($sql)->result();
            if ($chat) {
                $data['newmessage'] = 'ada';
            }
        }

        $this->load->view('layoutweb/header', $data);
        $this->load->view('layoutweb/navigation', $data);
        $this->load->view('layoutweb/member/orders', $data);
        $this->load->view('layoutweb/footer');
    }

    public function edit()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Anda belum login! Silahkan login atau daftar terlebih dahulu.</div>');
            redirect('member');
        }

        $data['title'] = 'The Crabbys - Edit Data Member';
        $data['user'] = $this->db->get_where('tabel_member', ['username' =>
        $this->session->userdata('username')])->row_array();
        $list = $this->db->get_where('tabel_transaksi', array(
            'member_id' => $this->session->userdata('id'),
            'status <' => 5
        ))->result();
        $data['list'] = count($list);

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('hp', 'Nomor Handphone', 'required|numeric');
        $this->form_validation->set_rules('lat', 'Lokasi', 'required', [
            'required' => 'Izinkan Browser mengakses lokasi anda. Lalu tentukan titik pengiriman pada map.'
        ]);

        if ($this->form_validation->run()) {
            $nama = $this->input->post('nama');
            $hp = $this->input->post('hp');
            $lat = $this->input->post('lat');
            $lng = $this->input->post('lng');
            $id = $this->input->post('id');

            $this->member->update($nama, $hp, $lat, $lng, $id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data diri berhasil diubah.</div>');
            redirect('member/dashboard');
        } else {
            $id_member = $this->session->userdata('id');
            $data['newmessage'] = '';
            if ($id_member) {
                $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
                $chat = $this->db->query($sql)->result();
                if ($chat) {
                    $data['newmessage'] = 'ada';
                }
            }
            $this->load->view('layoutweb/header', $data);
            $this->load->view('layoutweb/navigation', $data);
            $this->load->view('layoutweb/member/edit', $data);
            $this->load->view('layoutweb/footer');
        }
    }

    public function gambar()
    {
        $id = $this->input->post('id');
        $error = 'false';
        $config['upload_path'] = "./assets/gambar_member";
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']     = '1000';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("gambar")) {
            $data = array('upload_data' => $this->upload->data());
            $image = $data['upload_data']['file_name'];
        } else {
            $error = 'true';
        }

        if ($error !== 'true') {
            $this->member->gambar($id, $image);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Gambar profil berhasil diubah.</div>');
            redirect('member/dashboard');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gambar profil gagal diubah. Pastikan gambar yang anda upload bertipe PNG/JPG/JPEG dengan size kurang dari 1 MB!</div>');
            redirect('member/dashboard');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'YOUR_SMTP_HOST',
            'smtp_user' => 'YOUR_SMTP_USER',
            'smtp_pass' => 'YOUR_SMTP_PASSWORD',
            'smtp_crypto' => 'ssl',
            'smtp_port' => 'YOUR_SMTP_PORT',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"

        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('info@thecrabbys.net', 'Crabbys.info');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $data['nama'] = $this->input->post('nama');
            $data['judul'] = 'Untuk menyelesaikan pendaftaran, tolong verifikasi email anda :';
            $data['tombol'] = 'VERIFY EMAIL';
            $data['link'] = base_url() . 'member/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token);
            $mesg = $this->load->view('layoutweb/member/emailing', $data, true);
            $this->email->subject('Verifikasi Email');
            $this->email->message($mesg);
            //$this->email->message('Silahkan buka tautan berikut untuk verifikasi email : <a 
            //href="' . base_url() . 'member/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Verifikasi</a>');
        } else if ($type == 'forgot') {
            $data['nama'] = $this->input->post('email');
            $data['judul'] = 'Untuk melakukan reset password, silahkan klik tombol dibawah ini :';
            $data['tombol'] = 'RESET PASSWORD';
            $data['link'] = base_url() . 'member/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token);
            $mesg = $this->load->view('layoutweb/member/emailing', $data, true);
            $this->email->subject('Reset Password');
            $this->email->message($mesg);
        }


        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('tabel_member', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('tabel_member_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('tabel_member');
                    $this->db->delete('tabel_member_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    ' . $email . ' telah diaktifkan! Silahkan login.</div>');
                    redirect('member');
                } else {

                    $this->db->delete('tabel_member', ['email' => $email]);
                    $this->db->delete('tabel_member_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Aktivasi akun gagal! Token expired.</div>');
                    redirect('member');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Aktivasi akun gagal! Token invalid.</div>');
                redirect('member');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Aktivasi akun gagal! Email tidak ditemukan.</div>');
            redirect('member');
        }
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'The Crabbys - Lupa Password';
            $id_member = $this->session->userdata('id');
            $data['newmessage'] = '';
            if ($id_member) {
                $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
                $chat = $this->db->query($sql)->result();
                if ($chat) {
                    $data['newmessage'] = 'ada';
                }
            }

            $this->load->view('layoutweb/header', $data);
            $this->load->view('layoutweb/navigation', $data);
            $this->load->view('layoutweb/member/forgot', $data);
            $this->load->view('layoutweb/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('tabel_member', ['email' => $email, 'is_active' => 1])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(64));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('tabel_member_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Silahkan periksa email anda untuk mengatur ulang password! Jika email belum diterima mohon ditunggu atau cek folder spam anda.</div>');
                redirect('member/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email tidak terdaftar atau tidak aktif!</div>');
                redirect('member/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('tabel_member', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('tabel_member_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                } else {
                    $this->db->delete('tabel_member_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Reset password gagal! Token expired.</div>');
                    redirect('member');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Reset password gagal! Invalid token.</div>');
                redirect('member');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset password gagal! Email tidak ditemukan.</div>');
            redirect('member');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('member');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'The Crabbys - Ubah Password';
            $id_member = $this->session->userdata('id');
            $data['newmessage'] = '';
            if ($id_member) {
                $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
                $chat = $this->db->query($sql)->result();
                if ($chat) {
                    $data['newmessage'] = 'ada';
                }
            }
            $this->load->view('layoutweb/header', $data);
            $this->load->view('layoutweb/navigation', $data);
            $this->load->view('layoutweb/member/reset', $data);
            $this->load->view('layoutweb/footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('tabel_member');
            $this->db->delete('tabel_member_token', ['email' => $email]);

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password telah diubah! Silahkan login.</div>');
            redirect('member');
        }
    }
}
