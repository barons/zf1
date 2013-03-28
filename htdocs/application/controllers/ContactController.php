<?php

class ContactController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new Application_Form_Contact();
        $this->view->form = $form;
        
        // controleren of we een post hebben ontvangen
        // vroeger was $_SERVER['REQUEST_METHOD'] == 'post'
        if($this->getRequest()->isPost()){
            $postParams = $this->getRequest()->getPost(); // alle $_POST params opvragen
            // controle of alle velden correct zijn volgens de validators
            if ($this->view->form->isValid($postParams)){
                
                // verstuur de mail
                $params     = $this->view->form->getValues();
                
                $body        = "Hallo, dit is een mail.";
                $body       .= "voornaam " . $params['firstName'] . "<br/>";
                $body       .= "E-mail " . $params['email'] . "<br/>";
                $body       .= "Adres " . $params['adress'] . "<br/>";
                $body       .= "Omschrijving " . $params['description'] . "<br/>";
                // $body       = nl2br($body); -> proper omzetten naar nette tekst
                // mail.site.smtp
                /*
                $configSMTP = array(
                    'port'      => 587,
                    'auth'      => 'login',
                    'username'  => '***',
                    'login'     => '***'
                );*/
                
                $transport  = new Zend_Mail_Transport_Smtp('smtp.telenet.be');
                
                // Zend Mail opstarten
                $mail = new Zend_Mail();
                $mail->addTo('samuel@baronsdesign.be');
                $mail->addCc('batmanfanman@hotmail.com');
                $mail->addBcc('batmanfanman@hotmail.com');
                $mail->setSubject('Dit is een testmail...');
                $mail->setBodyHtml($body);
                // wanneer je een mail niet kan lezen... (html)
                $mail->setBodyText('Kan je deze mail niet lezen ? Lees hem online ... dus hier http://');
                $mail->setFrom($params['email']);
                
                $mail->send($transport);
                
                echo "Uw mail werd verzonden !";
            }
        }
    }


}

