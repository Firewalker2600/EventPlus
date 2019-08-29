<?php
use Phalcon\Mvc\Controller;
class UsersController extends ControllerBase
{
  public function indexController()
  {

  }
  public function renewController()
  {
    $this->view->form = new RenewForm;
  }
}