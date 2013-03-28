<?php

class Nieuws1Controller extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function wijzigenAction()
    {
        $id     = $this->_getParam('id'); 
        // $_GET['id'];
        /*$sql    = "select * from nieuws where id = " .$id;
        $result = $this->db->query($sql);
        $nieuws = $result->fetch(); // haal alles altijd op
        */
        
        $nieuwsModel = new Application_Model_Nieuws1();
        // current, je hebt er maar 1 nodig, al de rest van code weg
        // anders moet je een foreach doen
        $nieuws      = $nieuwsModel->find($id)->current(); // SELECT * FROM nieuws WHERE id = $id
        
        $form        = new Application_Form_News();
        // populate, juiste veldjes opvullen met data die je wilt
        $form->populate($nieuws->toArray()); // omzetten in array om het formulier op te vullen
        
        // populate form
        
        /*$form->getElement('titel')->setValue($nieuws['titel']);
        $form->getElement('omschrijving')->setValue($nieuws['omschrijving']);*/
        
        $this->view->form = $form;
        
        // zorgen dat nieuws in de database raakt
        if ($this->getRequest()->isPost()){
            $postParams = $this->getRequest()->getPost();
            
            // controle, als alles correct is
            if ($this->view->form->isValid($postParams)){
                
                unset($postParams['versturen']);
                
                $nieuwsModel->wijzigenNieuws($postParams, $id);
                $this->_redirect('/news/overzicht');
                
            }
            
        }
    }

    public function verwijderenAction()
    {
        // action body
    }

    public function toevoegenAction()
    {
        $form = new Application_Form_News();
        $this->view->form = $form;
        
        // zorgen dat nieuws in de database raakt
        if ($this->getRequest()->isPost()){
            $postParams = $this->getRequest()->getPost();
            
            // controle, als alles correct is
            if ($this->view->form->isValid($postParams)){
                
                /*$db = Zend_Registry::get('db');
                
                
                // SQL Query opbouwen en in variabele zetten
                $sql    = "INSERT INTO `nieuws` (titel, omschrijving) 
                    VALUES ('".$postParams['titel']."','". $postParams['omschrijving']."')";

                // Query in db uitvoeren
                $db->query($sql);
            
                $this->_redirect('/news/overzicht');*/
                
                
                // ipv heel de reutemeteut hierboven
                unset($postParams['versturen']); // we schrijven de knop niet weg....
                $nieuwsModel = new Application_Model_Nieuws1();
                $nieuwsModel->toevoegenNieuws($postParams);
                
                // $this->_redirect('/nieuws1/overzicht');
                // vervangen door functies van Zend dus ->
                $this->_redirect($this->view->url(array('controller' => 'Nieuws1', 'action' => 'overzicht')));
                
            }
            
        }
    }

    public function overzichtAction()
    {
        // action body
    }


}









