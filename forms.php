<?php

use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;

//validator
$validator = Validation::createValidator();

//make sure form factory is a new instance every request
$form_factory = Forms::createFormFactoryBuilder()
    ->addExtension(new HttpFoundationExtension())
    ->addExtension(new ValidatorExtension($validator))
    ->getFormFactory();

$container->instance($form_factory);