<?php

class NewsController extends Zend_Controller_Action
{

    public function init()
    {
        // connectie met database openen (aangemaakt in bootstrap)
        $this->db = Zend_Registry::get('db');
    }

    public function indexAction()
    {
      
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
            // is er op de knop gedrukt, en welke methode
            $postParams = $this->getRequest()->getPost();
            
            // controle, als alles correct is
            if ($this->view->form->isValid($postParams)){
                
                $db = Zend_Registry::get('db');
                
                
                // SQL Query opbouwen en in variabele zetten
                $sql    = "INSERT INTO `nieuws` (titel, omschrijving) 
                    VALUES ('".$postParams['titel']."','". $postParams['omschrijving']."')";

                // Query in db uitvoeren
                $db->query($sql);
            
                $this->_redirect('/news/overzicht');
                
            }
            
        }
        
    }

    public function wijzigenAction()
    {
        $id     = $this->_getParam('id'); // $_GET['id'];
        $sql    = "select * from nieuws where id = " .$id;
        $result = $this->db->query($sql);
        $nieuws = $result->fetch(); // haal alles altijd op
        
        $form   = new Application_Form_News();
        
        // populate form
        
        $form->getElement('titel')->setValue($nieuws['titel']);
        $form->getElement('omschrijving')->setValue($nieuws['omschrijving']);
        
        $this->view->form = $form;
        
        // zorgen dat nieuws in de database raakt
        if ($this->getRequest()->isPost()){
            $postParams = $this->getRequest()->getPost();
            
            // controle, als alles correct is
            if ($this->view->form->isValid($postParams)){
                // casten naar integer voor beveiliging
                $id     = (int) $this->_getParam('id');
                
                $db = Zend_Registry::get('db');  
                // SQL Query opbouwen en in variabele zetten
                $sql    = "UPDATE `nieuws` set titel = '".$postParams['titel']."',
                            omschrijving = '". $postParams['omschrijving']."'
                            WHERE id = " .$id;

                // Query in db uitvoeren
                $db->query($sql);
            
                $this->_redirect('/news/overzicht');
                
            }
            
        }
        
    }

    public function overzichtAction()
    {
        $sql    = "select * from nieuws";
        $result = $this->db->query($sql);
        $nieuws = $result->fetchAll(); // haal alles altijd op
        $this->view->news = $nieuws;
    }


}













