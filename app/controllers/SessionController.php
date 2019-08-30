<?php

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase
{
  public function initialize()
  {
    parent::initialize();
  }

  public function indexAction()
  {

  }

  /**
   * Register an authenticated user into session data
   *
   * @param Users $user
   */
  private function _registerSession(Users $user)
  {
    $this->session->set(
      'auth',
      [
        'id'   => $user->id,
        'jmeno' => $user->jmeno,
      ]
    );
  }

  /**
   * This action authenticate and logs an user into the application
   */
  public function loginAction()
  {
    if ($this->request->isPost()) {
      $email = $this->request->getPost('email');
      $heslo = $this->request->getPost('heslo');
      $user = Users::findFirstByEmail($email);

      // ověření že uživatel existuje
      if ($user == false) {
        $this->flash->error('Chybný email nebo heslo');

        return $this->dispatcher->forward(
          [
            'controller' => 'index',
            'action' => 'index'
          ]
        );
      }
      // shoda hesel?
      if (!$this->security->checkHash($heslo, $user->heslo)) {
        $this->flash->error('Chybný email nebo heslo');
        return $this->dispatcher->forward(
          [
            'controller' => 'index',
            'action' => 'index'
          ]
        );
      }
      $this->_registerSession($user);
      $this->flash->success('Uživatel ' . $user->jmeno . ' přihlášen');
      return $this->dispatcher->forward(
        [
          'controller' => 'users',
          'action' => 'index',
        ]
      );

    }
  }

  /*
   * Finishes the active session redirecting to the index
   *
   * @return unknown
   */
  public function logoutAction()
  {
    $this->session->remove('auth');

    $this->flash->success('Uživatel odhlášen!');

    return $this->dispatcher->forward(
      [
        "controller" => "index",
        "action"     => "index",
      ]
    );
  }
}