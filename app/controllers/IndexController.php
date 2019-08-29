<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
    $this->view->form = new LoginForm();
    }

}

