<?php
use Phalcon\Mvc\Controller;
class UsersController extends ControllerBase
{
  public function indexAction()
  {
    $this->view->setTemplateBefore('tab');

    $this->view->form = new RegisterForm();
    //Get session info
    $auth = $this->session->get('auth');

    //Query the active user
    $user = Users::findFirst($auth['id']);
    if ($user == false) {
      return $this->dispatcher->forward(
        [
          "controller" => "index",
          "action"     => "index",
        ]
      );
    }

    if (!$this->request->isPost()) {
      $this->tag->setDefault('jmeno', $user->jmeno);
      $this->tag->setDefault('prijmeni', $user->prijmeni);
      $this->tag->setDefault('email', $user->email);
      $this->tag->setDefault('spolecnost', $user->spolecnost);

    } else {
      $user->jmeno = $this->request->getPost('jmeno', ['string', 'striptags']);
      $user->prijmeni = $this->request->getPost('prijmeni', ['string', 'striptags']);
      $user->spolecnost = $this->request->getPost('spolecnost', ['string', 'striptags']);
      $user->email = $this->request->getPost('email', 'email');

      if ($user->save() == false) {
        foreach ($user->getMessages() as $message) {
          $this->flashSession->error($message);
        }
      } else {
        $this->flashSession->success('Váš profil byl úspěšně aktualizován');
      }
    }
  }
  public function renewAction()
  {
    $this->view->form = new RenewForm;
  }

  public function formAction()
  {
    $this->view->form = new RegisterForm;
  }

  public function registerAction ()
  {
    // Test jestli jsou data zaslaná skrze POST
    if ($this->request->isPost() != true) {
      return $this->dispatcher->forward(
        [
          "controller" => "users",
          "action"     => "form",
        ]
      );
    }
    // Validace formuláře
    $form = new RegisterForm();
    $user= new Users();
    $data = $this->request->getPost();
    if(!$form->isValid($data, $user)) {
      foreach($form->getMessages() as $message){
        $this->flashSession->error($message);
      }

      return $this->dispatcher->forward(
        [
          "controller" => "users",
          "action" => "form",
        ]
      );
    }

    // kontrola duplicit v Databázi
    $vypis = Users::findFirstByEmail($data['email']);
    if (!empty($vypis)){
      $message = 'Uživatel s tímto emailem již je v systému uložena';
      $this->flashSession->error($message);

      return $this->dispatcher->forward(
        [
          "controller" => "users",
          "action" => "form",
        ]
      );
    }
    // hash hesla do databáze
    $user->heslo = $this->security->hash($user->heslo);

    //uložení do databáze - kontrola
    if ($user->save() == false) {
      foreach ($user->getMessages() as $message) {
        $this->flashSession->error($message);
      }

      return $this->dispatcher->forward(
        [
          "controller" => "users ",
          "action"     => "form",
        ]
      );
    }
    //Uložení se podařilo
    $this->flashSession->success(
      'Děkujeme za vaší registraci.'
    );

    return $this->dispatcher->forward(
      [
        "controller" => "users",
        "action"     => "index",
      ]
    );

  }
}