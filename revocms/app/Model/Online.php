<?php
namespace App\Model;

use Core\Model;

class Online extends Model
{
    
    protected $maxtime = (60 * 5);

    public function __construct()
    {
        parent::__construct();
    }

    public function getOnline(int $check = -1) : array{
        $tmp = [];
        if($check == -1){
            $tmp["visitors"] = $this->getVisitors();
            $tmp["connected"] = $this->getConnected();
        } else if($check == 1) {
            $tmp = $this->getConnected();
        } else if($check == 0){
            $tmp = $this->getVisitors();
        }
        return $tmp;
    }

    private function getVisitors(){
        $check = $this->db->select("SELECT onlineId, onlineTime, userId, onlineIp, onlineState, pageName, pageUrl FROM onlines WHERE onlineState = 0 AND onlineTime > ".(time() - $this->maxtime)." ORDER BY onlineTime DESC", array());
        return $check;
    }

    private function getConnected(){
        $check = $this->db->select("SELECT onlineId, onlineTime, userId, userName, onlineIp, onlineState, pageName, pageUrl FROM onlines NATURAL JOIN users WHERE onlineState = 1 AND onlineTime > ".(time() - $this->maxtime)." ORDER BY onlineTime DESC", array());
        return $check;
    }

    public function isConnected($check, $field = "userId") {
        $check = $this->db->select("SELECT onlineId FROM onlines WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );
        return (!empty($check)) ? $check[0]->onlineId : false;
    }

    public function logout(int $id) : int {
        $check = $this->db->delete("onlines", array(
            "userId" => $id
        ));
        return $check;
    }

    public function refresh() : int {
        $check = $this->db->delete("onlines", array(
            "onlineTime" => (time() - $this->maxtime)
        ), null, "<");
        return $check;
    }

    public function update($datas, int $id){
        return $this->db->update('onlines', $datas, array(
            "onlineId" => $id
        ));
    }

    public function insert($datas){
        return $this->db->insert("onlines", $datas);
    }
}