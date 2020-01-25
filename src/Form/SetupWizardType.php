<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SetupWizardType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add("username")
            ->add("password", PasswordType::class, [
                'label' => "password",
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 100,
                    ]),
                ],
            ])
            ->add("databaseAuthentication", CheckboxType::class, [
                "required" => false,
            ])
            ->add("ldapAuthentication", CheckboxType::class, [
                "required" => false,
                "attr" => [
                    "onChange" => "var u = document.getElementById('setup-ldap');if(this.checked){u.style.display='block'}else{u.style.display='none'}"
                ],
            ])
            ->add("ldap", SetupWizardLdapType::class)
            ->add("submit", SubmitType::class);
    }

}