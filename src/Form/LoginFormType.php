<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;




use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\MatchPassword;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

  
   
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control bg-trasparent block border-secondary border-b-2 w-full h-20 text-6xl ouline-none',
                ],
                'label' => 'Address E-mail',
                
            ])
          
            ->add('password', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control bg-trasparent block border-secondary border-b-2 w-full h-20 text-6xl ouline-none',
                ],
                
                'label' => 'Mot de passe',
                'required' => false
            ])
                
        
            ->add('LogIn', SubmitType::class, [
                
                'label' => 'Log In',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
