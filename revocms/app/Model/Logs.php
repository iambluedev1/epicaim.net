<?php
namespace App\Model;

use Core\Model;

/**
 * Class Logs
 * @package App\Model
 * @author iambluedev
 * @copyright RevoCMS.fr | 2017
 */

class Logs extends Model
{
    /**
     * Logs constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get User Logs
     *
     * @param int $check
     * @return array
     */
    public function getLogs(int $check) : array{
        $check = $this->db->select("SELECT user_id, ip, city, region, country_code, country_name, continent_code, browser, date FROM history WHERE user_id = :check ORDER BY date DESC",
            array(
                ':check' => $check
            )
        );
        return $check;
    }

    public function getLastLog(int $check) : object {
        $check = $this->db->select("SELECT user_id, ip, city, region, country_code, country_name, continent_code, browser, date FROM history WHERE user_id = :check ORDER BY date DESC LIMIT 1",
            array(
                ':check' => $check
            )
        );
        return $check[0];
    }

    /**
     * Is User Already Connected Before
     *
     * @param int $check
     * @return bool
     */
    public function alreadyConnected(int $check) : bool {
        $check = $this->db->select("SELECT COUNT(id) AS count FROM history WHERE user_id = :check",
            array(
                ':check' => $check
            )
        );
        return ($check[0]->count > 0 ) ? true : false;
    }

    /**
     * Has Already Used This Ip Before
     *
     * @param int $id
     * @param string $ip
     * @return bool
     */
    public function hasAlreadyUsedThisIp(int $id, string $ip) : bool {
        $check = $this->db->select("SELECT COUNT(id) AS count FROM history WHERE user_id = :id AND ip = :ip",
            array(
                ':id' => $id,
                ':ip' => $ip,
            )
        );
        return ($check[0]->count > 0 ) ? true : false;
    }

    /**
     * Add New User Log
     *
     * @param array $data
     * @return string
     */
    public function newLog($data) : string {
        return $this->db->insert("history",
            array(
                "user_id" => $data["user_id"],
                "mail" => $data["mail"],
                "ip" => $data["ip"],
                "city" => $data["city"],
                "region" => $data["region"],
                "country_code" => $data["country_code"],
                "country_name" => $data["country_name"],
                "continent_code" => $data["continent_code"],
                "browser" => $data["browser"]
            )
        );
    }
}