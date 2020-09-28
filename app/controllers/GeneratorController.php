<?php
class GeneratorController extends ControllerBase
{

  public function indexAction()
  {
   $this->view->form = new GeneratorForm();
   }

  public function objednavkaAction()
  {
//    $objednavka = new Objednavka();

    // Test jestli jsou data zaslaná skrze POST
    if ($this->request->isPost() != true) {
      return $this->dispatcher->forward(
        [
          "controller" => "generator",
          "action"     => "index",
        ]
      );
    }
    // Validace formuláře
    $form = new GeneratorForm();
    $poptavka = new Poptavka();
    $data = $this->request->getPost();
    if(!$form->isValid($data, $poptavka)) {
      foreach($form->getMessages() as $message){
        $this->flash->error($message);
      }

     return $this->dispatcher->forward(
        [
          "controller" => "generator",
          "action" => "index",
        ]
      );
    }

    //kontrola duplicit v Databázi
    $vypis = Poptavka::findFirst(
      [
        'conditions' =>
              'jmeno        = :Jmeno:
           AND prijmeni     = :Prijmeni:
           AND email        = :Email:
           AND spolecnost   = :Spolecnost:
           AND datum_akce   = :DatumAkce:
           AND pocet_osob   = :PocetOsob:
           AND program_akce = :ProgramAkce:
           AND misto_akce   = :MistoAkce:',
        'bind' =>
          [
            'Jmeno'       => $data['jmeno'],
            'Prijmeni'    => $data['prijmeni'],
            'Email'       => $data['email'],
            'Spolecnost'  => $data['spolecnost'],
            'DatumAkce'   => $data['datum_akce'],
            'ProgramAkce' => $data['program_akce'],
            'PocetOsob'   => $data['pocet_osob'],
            'MistoAkce'   => $data['misto_akce'],
          ]
       ]
    );
    if (!empty($vypis)){
      $message = 'Zadaná poptávka je již v systému uložena';
      $this->flash->error($message);

      return $this->dispatcher->forward(
        [
          "controller" => "index",
          "action" => "index",
        ]
      );
    }



    //uložení do databáze - kontrola
    if ($poptavka->save() == false) {
      foreach ($poptavka->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(
        [
          "controller" => "generator",
          "action"     => "index",
        ]
      );
    }
    //Uložení se podařilo
    $this->flash->success(
      'Děkujeme za vaší poptávku. Do 24 hodin vám přijde na email naše nabídka.'
    );

    return $this->dispatcher->forward(
      [
        "controller" => "nabidka",
        "action"     => "calculate",
        "params"     => [$poptavka->id]      ]
    );

  }
}


