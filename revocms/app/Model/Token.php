<?php
namespace App\Model;

use Core\Model;

class Token extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function countTokens() : int {
        $check = $this->db->select("SELECT COUNT(id) as count FROM tokens", array());
        return $check[0]->count;
    }

    public function tokenExist($check, string $field = "token") : bool {
        $check = $this->db->select("SELECT ".$field." FROM tokens WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );
        return !empty($check);
    }

    public function getToken($check, string $field = "token") {
        $check = $this->db->select("SELECT * FROM tokens WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );
        return $check[0];
    }

    public function isActivated($check, string $field = "token") : string {
        $check = $this->db->select("SELECT active FROM tokens WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );

        return ($check[0]->active == "yes") ? true : false;
    }

    public function desactivate(int $id) : int {
        return $this->db->update('tokens', array(
            "active" => "no",
        ), array(
            "id" => $id
        ));
    }

    public function activate(int $id) : int {
        return $this->db->update('tokens', array(
            "active" => "yes",
        ), array(
            "id" => $id
        ));
    }

    public function addToken(array $data){
        return $this->db->insert("tokens",
            array(
                "token" => $data["token"],
                "day" => $data["day"]
            )
        );
    }

    public function getTokens() {
        $check = $this->db->select("SELECT * FROM tokens", array());
        return $check;
    }

    public function del(int $id) : int {
        $check = $this->db->delete("tokens", array(
            "id" => $id
        ));
        return $check;
    }

    public function log(array $data){
        return $this->db->insert("active_log",
            array(
                "userName" => $data["username"],
                "userEmail" => $data["email"],
                "token" => $data["token"],
                "ip" => $data["ip"],
                "date" => time()
            )
        );
    }

    public function getActiveLogs($id){
        $check = $this->db->select("SELECT * FROM active_log WHERE userEmail = :email", array(
            ":email" => $id
        ));
        return $check;
    }
}