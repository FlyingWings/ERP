<?php
class Oauth extends CI_Model{
    public function __construct()
    {
        $this->load->database();
        $this->load->library("session");
    }


    public function is_admin(){
        if(isset($_SESSION['admin_id'])){
            return true;
        }
        return false;
    }

    public function admin_login($admin_name, $password){
        $sql = "SELECT * from admin where admin_name = ?";
        $query = $this->db->query($sql, $admin_name)->row_array();
        if(!$query){
            return false;
        }else{
            list($pass, $salt) =explode(":", $query['admin_password']);
            if(sha1($password.$salt) == $pass){
                $_SESSION['admin_id'] = $query['id'];
                $_SESSION['admin_name'] = $admin_name;
                return true;
            }
            return false;
        }
    }

    /**
     * 返回全局权限
     * @return array
     */
    public function get_roles(){
        if(isset($_SESSION['admin_operations'])){
            return $_SESSION['admin_operations'];
        }else{
            $query = $this->db->query("SELECT role_id FROM admin_role_relation WHERE admin_id = ? ", [$_SESSION['admin_id']])->result_array();
            $role_ids = implode(",", array_map(function($i){return $i['role_id'];}, $query));
            $global_operations =[];
            $operations = $this->db->query("SELECT operation_key, operation_name FROM operation o 
            INNER JOIN role_operation_relation ror ON o.id = ror.operation_id WHERE ror.role_id IN (?)", $role_ids)->result_array();
            foreach($operations as $line){
                $global_operations[$line['operation_key']]= $line['operation_name'];
            }
            $_SESSION['admin_operations'] = $global_operations;
            return $global_operations;
        }
    }
}