<?php
class NabidkaController extends ControllerBase
{
  public function indexAction() {
    $this->view->form = new IdForm();
  }

  public  function listAction () {
    $id = $this->request->getPost('id');

    // Validace formuláře
    $form = new IdForm();
    if(!$form->isValid($_POST)) {
      foreach($form->getMessages() as $message) {
        $this->flashSession->error($message);
      }
      return
        $this->response->redirect('nabidka/index');
    }
    // je $id platne?
    if(empty($id)) {
      $this->flashSession->error('Zadejte platne ID poptavky');
      return
        $this->response->redirect('nabidka/index');
    }
    // je poptávka v databázi
    if(empty($poptavka = Poptavka::findFirstById($id))) {
      $this->flashSession->error('Poptavka s tímto id není v databázi');
      return
        $this->response->redirect('nabidka/index');
    } elseif(!empty($poptavka->cena)) {   // je u poptávky vyplněna cena?

      return
        $this->dispatcher->forward(
        [
          'controller' => 'nabidka'
        , 'action'    => 'render'
        , 'params'    => [$id]
        ]
      );
    } else {
      return
        $this->dispatcher->forward(
        [
          'controller' => 'nabidka'
        , 'action'     => 'calculate'
        , 'params'     => [$id]
        ]
      );
    }
  }

  public function calculateAction($id) {
    $poptavka = Poptavka::findFirstById($id);
    $poptavka->cena
      = $poptavka->eventy->variabilni_cena * $poptavka->pocet_osob
      + $poptavka->eventy->fixni_cena;

    if (!$poptavka->save()) {
      $this->flashSession->error('Nepodařio se uložit cenu nabídky');
      return
        $this->response->redirect('nabidka/index');
    } else {
      return
        $this->dispatcher->forward(
        [
          'controller' => 'nabidka'
        , 'action'     => 'render'
        , 'params'     => [$id]
        ]
      );
    }
  }

  public function renderAction($id) {
    $poptavka = Poptavka::findFirstById($id);
    //kontrola, že nabídka s daným id existuje
    if(empty($poptavka)) {
      $this->flashSession->error('Nabidka s id '.$id.' není v databázi');
      return
        $this->response->redirect('nabidka/index');
    } else {
      $this->assets->addCss('css/nabidka.css');
      $this->view->form = new IdForm();
      $this->view->poptavka = $poptavka;
    }
  }
}