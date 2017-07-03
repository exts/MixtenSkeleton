<?php

// setup translations
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Translator;

$vendor_dir = root('vendor');
$vendor_form_dir = $vendor_dir . '/symfony/form';
$vendor_validator_dir = $vendor_dir . '/symfony/validator';

$translator = new Translator('en_US');
$translator->addLoader('xlf', new XliffFileLoader());
$translator->addLoader('yaml', new YamlFileLoader());

//setup translation resources
$trans_resources = $container['trans'] ?? [];
foreach($trans_resources as $trans_resource) {
    if(!isset($trans_resource['dir'])) continue;
    $translator->addResource('yaml', $trans_resource['dir'], $trans_resource['lc_cc']);
}

// there are built-in translations for the core error messages
$translator->addResource(
    'xlf',
    $vendor_form_dir.'/Resources/translations/validators.en.xlf',
    'en',
    'validators'
);
$translator->addResource(
    'xlf',
    $vendor_validator_dir.'/Resources/translations/validators.en.xlf',
    'en',
    'validators'
);

//share instance
$container->instance($translator);