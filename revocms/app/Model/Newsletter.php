<?php
namespace App\Model;

use Core\Model;


class Newsletter extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getNewsletters() : array{
        $check = $this->db->select("SELECT * FROM newsletter_log ORDER BY newsletterDate DESC", array());
        return $check;
    }

    public function isRegistered($check, string $field = "newsletterId") : bool {
        $check = $this->db->select("SELECT ".$field." FROM newsletter_log WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );
        return !empty($check);
    }

    public function getDatas($check, string $field = "newsletterId") {
        $check = $this->db->select("SELECT * FROM newsletter_log WHERE " . $field . " = :check",
            array(
                ':check' => $check
            )
        );
        return $check[0];
    }

    public function update(string $field, $value, int $id) : int {
        return $this->db->update('newsletter_log', array(
            $field => $value,
        ), array(
            "newsletterId" => $id
        ));
    }

    public function del(int $id) : int {
        $check = $this->db->delete("newsletter_log", array(
            "newsletterId" => $id
        ));
        return $check;
    }

    public function add($data) : string {
        return $this->db->insert("newsletter_log",
            array(
                "newsletterTitle" => $data["title"],
                "newsletterContent" => $data["content"],
                "newsletterDate" => time(),
                "newsletterTranslate" => $data["translate"],
            )
        );
    }
}