<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-dxzPS4HHLc9a8mRVEuqBOE-t', 'production' => false);
        $this->load->library('veritrans');
        $this->veritrans->config($params);
        $this->load->helper('url');
    }

    public function index()
    {
        echo 'test notification handler';
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result, "true");

        $id = $result['order_id'];
        if ($result['status_code'] == 200) {
            $this->db->where('transaksi_id', $id);
            $this->db->update('tabel_transaksi', array(
                'status' => 3,
                'for_event' => 0
            ));

            require_once(APPPATH . 'views/vendor/autoload.php');

            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
                '53605ae7340f790a342a',
                '41c002c7cd6bd744c3b8',
                '949402',
                $options
            );

            $data['id'] = $id;
            $pusher->trigger('adminNotif', 'settlement', $data);
            $pusher->trigger('clientNotif' . $id, 'settlement', $data);
        } else if ($result['status_code'] == 202) {
            $this->db->where('transaksi_id', $id);
            $this->db->update('tabel_transaksi', array(
                'status' => 6,
                'for_event' => 1
            ));

            $this->db->where('id_transaksi', $id);
            $this->db->delete('tabel_kupon_used');
        }
    }
}
