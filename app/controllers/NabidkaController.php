<?php
class NabidkaController extends ControllerBase
{
  public function indexAction(){
    $this->view->form = new IdForm();
    }

  public  function forwardAction ()
  {
    $id = $this->request->getPost('id');

    // Validace formuláře
    $form = new IdForm();
    if(!$form->isValid($_POST)) {
      foreach($form->getMessages() as $message){
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(
        [
          "controller" => "nabidka",
          "action" => "index",
        ]
      );
    }

    $poptavka = Poptavka::findFirstById($id);
    // je id poptavky v databázi?
    if(empty($poptavka))
    {
    $this->flash->error('Poptávka s tímto ID není v databázi');
      return $this->dispatcher->forward(
        [
          "controller" => "nabidka",
          "action"     => "index",
        ]
      );
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
    // je $id platne?
    if(empty($id)){
      $this->flash->error('Zadejte platne ID poptavky');
      return $this->response->redirect('nabidka/index');
    }
    // je poptávka v databázi?
    $poptavka = Poptavka::findFirstById($id);
    if(empty($poptavka))
    {
      $this->flash->error('Poptavka s tímto id není v databázi');
      return $this->response->redirect('nabidka/index');
    }
    else {
      $event = Eventy::findFirstById($poptavka->program_akce);
      // vypočítej cenu eventu
      $cena = $event->fixni_cena + $event->variabilni_cena * $poptavka->pocet_osob;
      $poptavka->cena = $cena;
     if ($poptavka->save()) {
        $this->flash->success("Nabidková cena byla vytvořena a uložena.");
      }
      return $this->dispatcher->forward(
        [
          "controller" => 'nabidka',
          "action"    => 'render',
          'params'    => [$id]
        ]
      );
    }
  }
  public function renderAction($id)
  {
    $poptavka = Poptavka::findFirstById($id);
    //kontrola, že nabídka s daným id existuje
    if(empty($poptavka))
    {
      $this->flash->error('Nabidku nelze zobrazit.<br>Nabidka s id '.$id.' není v databázi');
      return $this->dispatcher->forward(
        [
          "controller" => "nabidka",
          "action"     => "index",
        ]
      );
    }
    else
    {
      $this->view->form = new IdForm();
      $this->view->poptavka = $poptavka;
     }
  }
}