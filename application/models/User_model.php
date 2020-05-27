<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
    public function GetUser($id){
        $data = $this->db->get_where('user', ['id' => $id]);
        return $data->row_array();
    }


    public function getAllUser($id){
        $data = $this->db->query("SELECT * FROM user WHERE id !='$id'");
        return $data->result_array();
    }

    public function getUserTarget($data){
        $user_id = $data['user_id'];
        $id_target = $data['id_target'];
        $target_data = $this->db->get_where('user' , ['id' => $id_target ])->row_array();
        $target_user = $this->db->get_where('user' , ['id' => $user_id ])->row_array();

        $message_user = $this->db->query("SELECT * FROM message WHERE user_id = '$user_id' AND id_target = '$id_target' OR user_id = '$id_target' AND id_target = '$user_id' ")->result_array();

        // $message_target = $this->db->query("SELECT * FROM message WHERE user_id = '$id_target' AND id_target = '$user_id'")->result_array();

        $message_re = $message_user;

        $allData = ['target_data' => $target_data,
                    'target_user' => $target_user,
                    'message' => $message_re
                     ];

        return $allData;
    }

    public function sending($dataku)
    {
        $user_id = $dataku['user_id'];
        $id_target = $dataku['id_target'];
        $target_data = $this->db->get_where('user' , ['id' => $id_target ])->row_array();
        $target_user = $this->db->get_where('user' , ['id' => $user_id ])->row_array();
        $date = date("Y-m-d H:i:s");
        $message = $dataku['message'];
        $insert = ['id' => null,
                 'user_id' => $user_id,
                 'id_target' => $id_target,
                 'time' => $date,
                 'message' => $message
                ];
        $this->db->insert('message', $insert);
        $message_user = $this->db->query("SELECT * FROM message WHERE user_id = '$user_id' AND id_target = '$id_target' OR user_id = '$id_target' AND id_target = '$user_id' ")->result_array();

        $message_re = $message_user;

        $allData = ['target_data' => $target_data,
                    'target_user' => $target_user,
                    'message' => $message_re
                     ];

        //pusher
        require_once(APPPATH.'vendor/autoload.php');
        // require __DIR__ . '/vendor/autoload.php';

            $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
            '65d281942673c0bd54b4',
            'efef26186dacd4033fa3',
            '965667',
            $options
            );
        
            $data['message'] = 'success';
            $pusher->trigger('my-channel', 'my-event', $data);
        //endpusher

        return $allData;
    }
}
?>