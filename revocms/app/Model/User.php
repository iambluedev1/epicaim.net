<?php
namespace App\Model;

use Core\Model;
use Security\Password;


class User extends Model
{
    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Count Users
     *
     * @param bool $today
     * @return int
     */
    public function countUsers(bool $today = false) : int {
        if(!$today){
            $check = $this->db->select("SELECT COUNT(userId) as count FROM users", array());
        }else{
            $check = $this->db->select("SELECT COUNT(userId) as count FROM users WHERE registeredAt > :check",
                array(
                    ':check' => (time() - 86400)
                )
            );
        }
        return $check[0]->count;
    }

    /**
     * Is Registered
     *
     * @param string|int $check
     * @param string $field
     * @return bool
     */
    public function isRegistered($check, string $field = "userName") : bool {
        $check = $this->db->select("SELECT ".$field." FROM users WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );
        return !empty($check);
    }

    /**
     * Get User Password
     *
     * @param string|int $check
     * @param string $field
     * @return string
     */
    public function getPassword($check, string $field = "userName") : string {
        $check = $this->db->select("SELECT userPass FROM users WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );
        return $check[0]->userPass;
    }

    /**
     * Update User Password
     *
     * @param string $user_password
     * @param int $user_id
     * @return int
     */
    public function changePassword(string $user_password, int $user_id) : int {
        return $this->db->update('users', array(
            "userPass" => Password::make($user_password),
        ), array(
            "userId" => $user_id
        ));
    }

    /**
     * Get User Token
     *
     * @param string|int $check
     * @param string $field
     * @return string
     */
    public function getToken($check, string $field = "userName") : string{
        $check = $this->db->select("SELECT userToken FROM users WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );
        return $check[0]->userToken;
    }

    /**
     * Get User ID
     *
     * @param string $check
     * @return int
     */
    public function getId(string $check) : int {
        $check = $this->db->select("SELECT userId FROM users WHERE userName = :check",
            array(
                ':check' => $check
            )
        );
        return $check[0]->userId;
    }

    /**
     * Get User ID By Token
     *
     * @param string $check
     * @return int
     */
    public function getIdByToken(string $check) : int {
        $check = $this->db->select("SELECT userId FROM users WHERE userToken = :check",
            array(
                ':check' => $check
            )
        );
        return $check[0]->userId;
    }

    /**
     * Get User Email
     *
     * @param string $check
     * @return string
     */
    public function getEmail(string $check) : string {
        $check = $this->db->select("SELECT userEmail FROM users WHERE userName = :check",
            array(
                ':check' => $check
            )
        );
        return $check[0]->userEmail;
    }

    /**
     * Get User Login
     *
     * @param string $check
     * @param string $field
     * @return string
     */
    public function getLogin(string $check, string $field = "userToken") : string{
        $check = $this->db->select("SELECT userName FROM users WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );
        return $check[0]->userName;
    }

    /**
     * Get User Datas
     *
     * @param string|int $check
     * @param string $field
     * @return object
     */
    public function getDatas($check, string $field = "userToken") {
        $check = $this->db->select("SELECT * FROM users WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );
        return $check[0];
    }

    public function getUsers() {
        $check = $this->db->select("SELECT * FROM users", array());
        return $check;
    }

    

    /**
     * Set User Confirmed
     *
     * @param int $user_id
     * @return int
     */
    public function setConfirmed(int $user_id) : int {
        return $this->db->update('users', array(
            "userState" => 1,
        ), array(
            "userId" => $user_id
        ));
    }

    /**
     * Get User State
     *
     * @param $check
     * @param string $field
     * @return string
     */
    public function getState($check, string $field = "userName") : string {
        $check = $this->db->select("SELECT userState FROM users WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );

        return $check[0]->userState;
    }

    public function isNewsletterActivated($check, string $field = "userName") : string {
        $check = $this->db->select("SELECT newsletter FROM users WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );

        return ($check[0]->newsletter == 1) ? true : false;
    }

    /**
     * Update User
     *
     * @param string $field
     * @param string|int $value
     * @param int $id
     * @return int
     */
    public function update(string $field, $value, int $id) : int {
        return $this->db->update('users', array(
            $field => $value,
        ), array(
            "userId" => $id
        ));
    }

    /**
     * Is Admin
     *
     * @param $check
     * @param string $field
     * @return string
     */
    public function isAdmin($check, string $field = "userName") : string {
        $check = $this->db->select("SELECT is_admin FROM users WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );

        return ($check[0]->is_admin == 1) ? true : false;
    }

    /**
     * New User
     *
     * @param array $data
     * @return string
     */
    public function newMember(array $data) : string{
        return $this->db->insert("users",
            array(
                "userName" => $data["input_login"],
                "userPass" => Password::make($data["input_password"]),
                "userEmail" => $data["input_email"],
                "userToken" => $data["token"],
                "registeredAt" => $data["register"],
                "ip" => $data["ip"]
            )
        );
    }

    public function getInjectionsLogs($id){
        $check = $this->db->select("SELECT * FROM cheat_inject WHERE mail = :email", array(
            ":email" => $id
        ));
        return $check;
    }

    public function getFreeInjectionsLogs($id){
        $check = $this->db->select("SELECT * FROM free_inject WHERE mail = :email", array(
            ":email" => $id
        ));
        return $check;
    }

    public function del(int $id) : int {
        $check = $this->db->delete("users", array(
            "userId" => $id
        ));
        return $check;
    }

    public function getVips() {
        return $this->db->select("SELECT 
            userId, 
            userName, 
            userPass, 
            userEmail, 
            userToken, 
            registeredAt, 
            date_active,
            token,
            active_log.ip
            FROM users NATURAL JOIN active_log ORDER BY date_active DESC", 
        array());
    }

    public function getNonVips() {
        return $this->db->select("SELECT 
            userId, 
            userName, 
            userPass, 
            userEmail, 
            userToken, 
            registeredAt
            FROM users WHERE is_vip = 0", 
        array());
    }
}