<?php
namespace App\User\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'required' => true,
                'label' => 'Username',
                'empty_data' => 'Username',
                'error_bubbling' => true,
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => "Password fields must match",
                'first_name' => 'password',
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Password (again)'],
                'required' => true,
                'error_bubbling' => true,
            ])
            ->add('email', TextType::class, [
                'label' => 'Email Address',
                'required' => true,
                'error_bubbling' => true,
                'constraints' => [
                    new Email(['message' => 'You must provide a valid email address.', 'checkMX' => true]),
                ]
            ])
            ->add('register', SubmitType::class, ['label' => 'Register'])
        ;
    }
}