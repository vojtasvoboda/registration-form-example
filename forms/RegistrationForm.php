<?php

use Nette\Forms\Form;
use Nette\Utils\Html;

/**
 * Class RegistrationForm
 */
class RegistrationForm extends Form {

    public function __construct($name = NULL) {

        parent::__construct($name);

        // select box for choosing date
        $this->addSelect('date', 'Den:',
            array(
                '2014-07-04' => '4.7.',
                '2014-07-05' => '5.7.',
                '2014-07-06' => '6.7.',
                '2014-07-07' => '7.7.',
                '2014-07-08' => '8.7.',
            )
        )->setRequired('Vyberte prosím datum');

        // select box for choosing time
        $this->addSelect('time', 'Čas:',
            array(
                '09:00:00' => '9:00',
                '12:00:00' => '12:00',
                '15:00:00' => '15:00',
            )
        )->setRequired('Vyberte prosím datum');

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
