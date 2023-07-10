<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("_username", EmailType::class,
                ["label" => "Adresse E-mail",
                    "required" => true,
                    "block_name" => "_email",
                    "constraints" => [
                        new Length (["min" => 2, "max" => 180, "minMessage" => "L'adresse mail doit comporter au moins 2 caractères", "maxMessage" =>
                            "L'adresse mail ne doit pas faire plus de 180 caractères"]),
                        new NotBlank(["message" => "Veuillez renseigner une adresse mail"]),
                        new Email(['message' => 'Veuillez renseigner une adresse mail valide'])
                    ]])
            ->add("password", PasswordType::class,
                ["label" => "Mot de passe",
                    "required" => true,
                    "constraints" => [
                        new NotBlank(["message" => "Veuillez renseigner un mot de passe"])
                    ]])
            ->add('submit', SubmitType::class, [
                'label' => 'Connexion',
                'attr' => ['class' => 'btn btn-danger']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => User::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'user_item',
        ]);
    }
}