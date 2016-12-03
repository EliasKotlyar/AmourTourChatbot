<?php
namespace App\BusinessLogic;



class UserProcessor
{

    public function getUser($username){
        return new User();
    }

}