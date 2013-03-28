<?php

class Application_Form_Contact extends Zend_Form 
{
    
    public function init(){
        // de defaults meegeven
        // omdat wij weten dat dit een formulier is kunnen we post gebruiken
        // in plaats van Zend_Form::METHOD_POST
        $this->setMethod(Zend_Form::METHOD_POST);
        // enctype voor afbeeldingen
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        
        // elementen gaan aanmaken
        // voornaam, naam adres, email, tel,...
        
        // element firstName
        $this->addElement(new Zend_Form_Element_Text('firstName', array(
            'label'     => 'Voornaam',
            'required'  => true,
            // filter de invoer, spaties vanvoor vanachter wegfilteren (trim)
            'filters'   => array('StringTrim')
        )));
        
        // element lastName
        $this->addElement(new Zend_Form_Element_Text('lastName', array(
            'label'     => 'Naam',
            'required'  => true,
            // filter de invoer, spaties vanvoor vanachter wegfilteren (trim)
            'filters'   => array('StringTrim')
        )));
        
        // element adress
        $this->addElement(new Zend_Form_Element_Text('adress', array(
            'label'     => 'Adres',
            'required'  => true,
            // filter de invoer, spaties vanvoor vanachter wegfilteren (trim)
            'filters'   => array('StringTrim'),
            // adres max 255 characters
            // meerdere validators of filters dus we steken ze in array
            'validators'=> array(
                array('StringLength', true, array('max' => 255))
                )
                            
        )));
        
        // element email
        $this->addElement(new Zend_Form_Element_Text('email', array(
            'label'     => 'Email',
            'required'  => true,
            // class megeven voor jquery checking
            'class'     => 'testje',
            // filter de invoer, spaties vanvoor vanachter wegfilteren (trim)
            'filters'   => array('StringTrim'),
            'validators'=> array(
                array('StringLength', true, array('max' => 255)),
                array('EmailAddress')
                )
        )));
        
        // element description
        $this->addElement(new Zend_Form_Element_Textarea('description', array(
            'label'     => 'Beschrijving',
            'required'  => true,
            // filter de invoer, spaties vanvoor vanachter wegfilteren (trim)
            'filters'   => array('StringTrim', 'StripTags'),
            'validators'=> array(
            )
        )));
        
        // element button
        $this->addElement(new Zend_Form_Element_Button('Versturen', array(
            'type'      => 'submit',
            'value'     => 'Mailen!',
            'required'  => false, // anders verplicht knop invullen
            'ignore'    => true // mag niet meekomen in overzicht
        )));
        
        // $btn = new Zend_Form_Element_Button();
        // andere manier van werken (ipv arrays)
        // $btn->setLabel('Versturen')->setRequired(false);
    }
    
    
    
}

?>
