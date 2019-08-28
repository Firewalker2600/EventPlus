<?php
class NabidkaController extends ControllerBase
{
  public function indexAction(){
    $this->view->form = new IdForm();
    }

  public  function listAction ()
  {
    $id = $this->request->getPost('id');

    // Validace formuláře
    $form = new IdForm();
    if(!$form->isValid($_POST)) {
      foreach($form->getMessages() as $message){
        $this->flashSession->error($message);
      }
      return $this->response->redirect('nabidka/index');
    }
    // je $id platne?
    if(empty($id)){
      $this->flashSession->error('Zadejte platne ID poptavky');
      return $this->response->redirect('nabidka/index');
    }
    // je poptávka v databázi?
    $poptavka = Poptavka::findFirstById($id);
    if(empty($poptavka))
    {
      $this->flashSession->error('Poptavka s tímto id není v databázi');
      return $this->response->redirect('nabidka/index');
    }

   // je u poptávky vyplněna cena?
     elseif(!empty($poptavka->cena))
    {
      return $this->dispatcher->forward(
        [
          "controller" => 'nabidka',
          "action"    => 'render',
          'params'    => [$id]
        ]
      );
      }

    else
    {
      return $this->dispatcher->forward(
        [
          "controller" => "nabidka",
          "action"     => "calculate",
          "params"     => [$id],
        ]
      );
    }
  }

  public function calculateAction($id)
  {
      $event = Eventy::findFirstById($poptavka->program_akce);
      // vypočítej cenu eventu
      $cena = $event->fixni_cena + $event->variabilni_cena * $poptavka->pocet_osob;
      $poptavka->cena = $cena;
     if ($poptavka->save()) {
      }
      return $this->dispatcher->forward(
        [
          "controller" => 'nabidka',
          "action"    => 'render',
          'params'    => [$id]
        ]
      );
    }

  public function renderAction($id)
  {
    $poptavka = Poptavka::findFirstById($id);
    //kontrola, že nabídka s daným id existuje
    if(empty($poptavka))
    {
      $this->flashSession->error('Nabidka s id '.$id.' není v databázi');
      return $this->response->redirect('nabidka/index');

    }
    else
    {
      $this->view->form = new IdForm();
      $this->view->poptavka = $poptavka;
     }
  }
}