<?php
namespace App\Controller;

use Core\Controller;

class SupportController extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($error = null){
       $this->url->redirect("discord.gg/BA2s5jY", true);
       exit();
    }

}