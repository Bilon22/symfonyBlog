<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\Column(type="text")
     */
    private $login;

     /**
     * @ORM\Column(type="text")
     */
    private $password;

     /**
     * @ORM\Column(type="text")
     */
    private $email;

    public function getLogin(){
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}
