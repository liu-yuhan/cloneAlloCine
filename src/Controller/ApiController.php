<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ApiController extends AbstractController
{

      static private $key = NULL;
      private $currentUserId;

      static public function getkey() {
          if(is_null(self::$key)) {
              self::$key = "3977eef8d945cc2f6346cc5b7e6d582e";
            }
          return self::$key;
      }

      public function currentUser(UserInterface $user = null)
      {
          $userId = null !== $user ? $user->getId() : null;
          return $this->$currentUserId=$userId;
      }


}
