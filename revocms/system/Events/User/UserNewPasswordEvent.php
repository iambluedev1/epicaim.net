<?php
namespace Events\User;

use Event\Event;

/**
 * Class UserNewPasswordEvent
 * @package Events\User
 * @author iambluedev
 * @copyright RevoCMS.fr | 2017
 */

class UserNewPasswordEvent extends Event {

    /**
     * User Name
     * @var string
     */
    private $name;

    /**
     * User ID
     * @var string
     */
    private $id;

    /**
     * User Token
     * @var string
     */
    private $token;

    /**
     * User Old Email
     * @var string
     */
    private $old_email;

    /**
     * User New Email
     * @var string
     */
    private $new_email;

    /**
     * UserChangeEmailEvent constructor.
     * @param string $name
     * @param string $id
     * @param string $token
     * @param string $old_email
     * @param string $new_email
     */

    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Get User Name
     *
     * @return string
     */

    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Get User ID
     *
     * @return string
     */

    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * Get USer Token
     *
     * @return string
     */

    public function getPassword() : string
    {
        return $this->password;
    }
}