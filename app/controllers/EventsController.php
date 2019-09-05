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
    $events = array_column($events,'nazev', 'id');
    ksort($events);

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

  public function saveAction($id = NULL)
  {
      if ( isset($id))
      {
        $event = Eventy::findFirstById($id);
      }
      else {
        $event = new Eventy();
      }
      $event->nazev = $this->request->getPost('nazev', ['string', 'striptags']);
      $event->fixni_cena = $this->request->getPost('fixni_cena', 'absint');
      $event->variabilni_cena = $this->request->getPost('variabilni_cena', 'absint');
      $event->doprava = $this->request->getPost('doprava', 'absint');

      if ($event->save() == false) {
        foreach ($event->getMessages() as $message) {
          $this->flashSession->error($message);
        }
      }
      else {
        $this->flashSession->success('Váš event byl úspěšně aktualizován');
        }
      $this->response->redirect('events/index/' . $event->id);
  }

  public function deleteAction($id = null)
  {
    if(!isset($id))
    {
      $this->flashSession->error('Nebylo zadán žádný event k vymazání');
      return $this->response->redirect ("events/index");
    }
    else
    {
      $event = Eventy::findFirst($id);

      if(!$event->delete())
      {
        $this->flashSession->error('Event se nepodařilo vymazat z databáze');
        return $this->response->redirect ("events/index/$id");
      }

      else
      {
        $this->flashSession->success('Event vymazán z databáze');
        return $this->response->redirect("events/index");
      }
    }
  }

}