<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comm
 *
 * @author bqlde
 */
class Application_Form_Comm extends Zend_Form {

Public function init() {
$this->setName('comm');

$num = new Zend_Form_Element_Hidden('num');
        $num->addFilter('Int');

$num_table = new Zend_Form_Element_Text('num_table');
        $num_table->setLabel('num_table')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

$suggestion = new Zend_Form_Element_Text('suggestion');
        $suggestion->setLabel('suggestion')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
    
}
}

?>
