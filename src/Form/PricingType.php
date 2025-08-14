<?php

namespace App\Form;

use App\Entity\Pricing;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PricingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $b, array $o): void
    {
        $b->add('serviceName', TextType::class, ['label' => 'Usługa'])
          ->add('price', MoneyType::class, ['label' => 'Cena', 'currency' => false, 'divisor' => 1])
          ->add('unit', TextType::class, ['label' => 'Jednostka']);
    }
    public function configureOptions(OptionsResolver $r): void
    {
        $r->setDefaults(['data_class' => Pricing::class]);
    }
}
