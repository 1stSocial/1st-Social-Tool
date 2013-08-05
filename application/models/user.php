<?php
Class User extends CI_Model
{
    function login($username, $password) {
        $this->db->select('id, username, password, user_level');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        }
        else {
            return false;
        }
    }

    function get_user_domain($user_id) {
        $this->db->select('domain');
        $query = $this->db->get_where('users', array('id' => $user_id));
        return $query->result();
    }

    function set_user_domain() {

    }

    /**
     * Short desc
     *
     * Long description first sentence starts here
     * and continues on this line for a while
     * finally concluding here at the end of
     * this paragraph
     *
     * The blank line above denotes a paragraph break
     */
    function add_user($user_data) {
        $data = array(
            "username" => $user_data['username'],
            "domain" => $user_data['domain'],
            "user_level" => $user_data['user_level'],
            "avatar" => $user_data['avatar_image_url']
        );

        $this->db->insert('users', $data);
    }

    function remove_user($user_id) {

    }

    function get_user_details($user_id) {

    }

    function set_user_details($user_id, $update_data) {
        $data = array();
        if (isset($update_data)) {
            if (isset($update_data['username'])) {
                $data['username'] = $user_data['username'];
            }
            if (isset($update_data['username'])) {
                $data['domain'] = $user_data['domain'];
            }
            if (isset($update_data['username'])) {
                $data['user_level'] = $user_data['user_level'];
            }
            if (isset($update_data['username'])) {
                $data['avatar'] = $user_data['avatar_image_url'];
            }
        }

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }
}
?>