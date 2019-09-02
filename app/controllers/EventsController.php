<?php

class EventsController extends ControllerBase
{
  public function initialize()
  {
    parent::initialize();
    $this->view->form = new EventForm();
    $this->view->setTemplateBefore('tab');
  }

  public function indexAction($id = NULL)
  {
    $events = Eventy::find()->toArray();
    foreach ($events as $row => $program) {
      $events[$program['id']] = $program['nazev'];
    }
    unset($events[0]);
    $this->view->events = $events;
    $this->view->id = $id;

    if (!isset($id)) {
      $this->tag->setDefault('nazev', '');
      $this->tag->setDefault('fixni_cena', '');
      $this->tag->setDefault('variabilni_cena', '');
      $this->tag->setDefault('doprava', '');
    }
    else {
      $event = Eventy::findFirstById($id);
      $this->tag->setDefault('nazev', $event->nazev);
      $this->tag->setDefault('fixni_cena', $event->fixni_cena);
      $this->tag->setDefault('variabilni_cena', $event->variabilni_cena);
      $this->tag->setDefault('doprava', $event->doprava);
    }
  }

  /*public function saveAction()
  {
      $event = new Eventy();
      $event->nazev = $this->request->getPost('nazev', ['string', 'striptags']);
      $event->fixni_cena = $this->request->getPost('fixni_cena', 'absint');
      $event->variabilni_cena = $this->request->getPost(
        'vyriabilni_cena',
        'absint'
      );
      $event->doprava = $this->request->getPost('doprava', 'absint');

      if ($event->save() == false) {
        foreach ($event->getMessages() as $message) {
          $this->flashSession->error($message);
        }
      }
      else {
        $this->flashSession->success('Váš event byl úspěšně aktualizován');
      }
    }*/
}



// poznámka - > myšlenka je mít napravo seznam eventů a po kliknutí se vyplní editační pole dle eventu,
// kliknutí odešle do indexu id eventu a podle něj se vyplní políčka ve fromuláři -- možná lepší to rozdělit na save tlačítko