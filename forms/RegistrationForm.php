<?php

use Nette\Forms\Form;
use Nette\Utils\Html;

/**
 * Class RegistrationForm
 */
class RegistrationForm extends Form {

    public function __construct($dates, $times) {

        parent::__construct();

        // select box for choosing date
        $this->addSelect('date', 'Den:', $dates)->setRequired('Vyberte prosím datum');

        // select box for choosing time
        $this->addSelect('time', 'Čas:', $times)->setRequired('Vyberte prosím datum');

        // inputs for name and e-mail
        $this->addText('name', 'Jméno:')->setRequired('Zadejte prosím jméno');
        $this->addText('email', 'E-mail:')
            ->setRequired('Zadejte prosím e-mail')
            ->addRule(Form::EMAIL, 'E-mail musí být ve formátu jmeno@domena.cz');

        // checkbox for contest terms
        $checkboxLabel = Html::el();
        $checkboxLabel->add('Souhlasím s ');
        $checkboxLabel->add(Html::el('a')->href('/podminky/')->target('_blank')->setText('podmínkami'));
        $this->addCheckbox('terms', $checkboxLabel)->setRequired('Musíte souhlasit s podmínkami.');

        // submit button
        $this->addSubmit('send', 'Odeslat rezervaci');

    }

}
