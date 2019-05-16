<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User Class
 *
 * @package                Orion Project
 * @subpackage        Libraries
 * @category        Users
 * @author                Waldir Bertazzi Junior
 * @link                http://waldir.org/
 */
class user_manager {

    private $CI;

    function __construct() {
        $this->CI = & get_instance();

        // checks if the database library is loaded
        if (!isset($this->CI->db)) {
            show_error("You need the database library to use the User Library. Please check your configuration.");
        }

        // load session and bcrypt library.
        $this->CI->load->library(array('session', 'user/bcrypt'));
    }

    /**
     * @param array $data
     * @return bool
     */
    function save_user($data) {

        // first we must check if is a valid insert
        if (!$this->email_exists($data['email'])) {

            // generate the hashed password
            $data['password'] = $this->CI->bcrypt->hash($data['password']);
            // This login is fine, proceed
            if ($this->CI->db->insert('clients', $data)) {

                // Saved successfully
                $new_user_id = $this->CI->db->insert_id();
                //Saving a new key
                $newKey = base64_encode($new_user_id . $data['created_at']);
                $this->CI->db->insert('client_keys', array('id_client' => $new_user_id,'key' => $newKey, 'updated' => $data['created_at']));

                // Return the new user id
                return $new_user_id;
            }
        } else {
            // Email already exists
            return false;
        }
    }

    //Tries to activate user
    function activate($hashCode, $user) {
        $verifiedCode = md5($user);

        if ($verifiedCode != $hashCode)
            return false;

        $this->CI->db->where(array('id_usuario' => $user, 'status' => 0));
        $this->CI->db->update('tb_usuario', array('status' => 1));

        if ($this->CI->db->affected_rows() == 1)
            return true;

        return false;
    }

    // Delete the user
    function delete_user($user_id) {
        return $this->CI->db->delete('users', array('id' => $user_id));
    }

    // Check if there is already a login with that name
    function email_exists($email) {
        $exists = $this->CI->db->get_where('clients', array('email' => $email))->row();
        return sizeof($exists) != 0;
    }

    // Checks if user already has the permission on database
    function user_permission($user_id, $permission_id = 0) {
        $this->CI->db->select('nivel');
        $this->CI->db->from('tb_usuario');
        $this->CI->db->where(array('id_usuario' => $user_id));
        $query = $this->CI->db->get();
        $result = $query->result;
        $r = $result[0];
        return ($r->nivel >= $permission_id) ? true : false;
    }

    // Links a permission with a user
    function add_permission($user_id, $permissions) {
        // If array received we must call this recursively
        if (is_array($permissions)) {
            if (sizeof($permissions) == 0) {
                return FALSE;
            }
            // Foreach permission in the array call this function recursively
            foreach ($permissions as $permission) {
                $this->add_permission($user_id, $permission);
            }
        } else {
            // Check if user already has this permission
            if (!$this->user_has_permission($user_id, $permissions)) {
                return $this->CI->db->insert('users_permissions', array('user_id' => $user_id, 'permission_id' => $permissions));
            } else {
                // User already has this permission
                return TRUE;
            }
        }
    }

    // Creates a new permission
    function save_permission($permission_name, $permission_description) {
        $exists = $this->CI->db->get_where('permissions', array('name' => $permission_name));
        if ($exists->num_rows() >= 1) {
            return $exists->row()->id;
        } else {
            $insert = $this->CI->db->insert('permissions', array('name' => $permission_name, 'description' => $permission_description));
            if ($insert) {
                return $this->CI->db->insert_id();
            } else {
                return FALSE;
            }
        }
    }

    // Gets all users with a selected permission
    function get_users_with_permission($permission_name) {
        $permission = $this->CI->db->get_where('permissions', array('name' => $permission_name))->row();
        if (sizeof($permission) == 0) {
            return FALSE;
        } else {
            return $this->CI->db->get_where('users_permissions', array('permission_id' => $permission->id))->result();
        }
    }

    // Add (and saves to database) a custom user information
    function set_custom_field($user_id, $name, $value) {
        $field = $this->CI->db->get_where('users_meta', array('user_id' => $user_id, 'name' => $name));
        if ($field->num_rows() == 0) {
            return $this->db->insert('users_meta', array('user_id' => $user_id, 'name' => $name, 'value' => $value));
        } else {
            return $this->db->update('users_meta', array('user_id' => $user_id, 'name' => $name, 'value' => $value), array('user_id' => $user_id));
        }
    }

    // Add (and saves to database) a custom user information
    function get_custom_field($user_id, $name, $value) {
        $field = $this->CI->db->get_where('users_meta', array('user_id' => $user_id, 'name' => $name));
        if ($field->num_rows() == 0) {
            return FALSE;
        } else {
            return $field->row()->value;
        }
    }

}