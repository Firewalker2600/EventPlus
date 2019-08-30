<?php
use Phalcon\Mvc\Controller;
class UsersController extends ControllerBase
{
  public function indexAction()
  {

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
        $this->flash->error($message);
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
      $this->flash->error($message);

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
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(
        [
          "controller" => "users ",
          "action"     => "form",
        ]
      );
    }
    //Uložení se podařilo
    $this->flash->success(
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