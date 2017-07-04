<?php
namespace App\User\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class LoginType
 *
 * @package App\User\Form
 */
class LoginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'required' => true,
                'label' => 'Username',
                'error_bubbling' => true,
            ])
            ->add('password', PasswordType::class, [
                'required' => true,
                'label' => 'Password',
                'error_bubbling' => true,
            ])
            ->add('login', SubmitType::class, ['label' => 'Login'])
        ;
    }
}