<?php
// src/Form/SecretariatType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AccountingType
 * @package App\Form
 */
class AccountingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        switch ($options['form'])
        {
            case 'searchMembers':
                $this->searchMembers($builder);
                break;
            case 'paymentLicenceValidation':
                $this->paymentLicenceValidation($builder);
                break;
            case 'paymentLicenceValidationUpdate':
                $this->paymentLicenceValidationUpdate($builder);
                break;
            default:
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => '', 'form' => ''));
    }

    /**
     * @param FormBuilderInterface $builder
     */
    private function searchMembers(FormBuilderInterface $builder)
    {
        $builder
            ->add('Search', TextType::class, array('label' => 'N° licence, Nom', 'mapped' => false))
            ->add('Submit', SubmitType::class, array('label' => 'Rechercher'))
        ;
    }

    /**
     * @param FormBuilderInterface $builder
     */
    private function paymentLicenceValidation(FormBuilderInterface $builder)
    {
        $builder
            ->add('LicenceNumber', TextType::class, array('label' => 'Liste n° licence (séparé par une virgule)', 'mapped' => false, 'required' => false))
            ->add('NewMember', IntegerType::class, array('label' => 'Nouveau membre', 'mapped' => false, 'required' => false))
            ->add('Club', IntegerType::class, array('label' => 'Numéro Club', 'mapped' => false))
            ->add('MemberLicencePaymentDate', DateType::class, array('label' => 'Date du Paiement', 'widget' => 'single_text'))
            ->add('MemberLicencePaymentValue', MoneyType::class, array('label' => 'Paiement/licence', 'divisor' => 100))
            ->add('Submit', SubmitType::class, array('label' => 'Valider'))
        ;
    }

    /**
     * @param FormBuilderInterface $builder
     */
    private function paymentLicenceValidationUpdate(FormBuilderInterface $builder)
    {
        $builder
            ->add('LicenceNumber', TextType::class, array('label' => 'N° de licence', 'mapped' => false))
            ->add('Club', IntegerType::class, array('label' => 'Numéro Club', 'mapped' => false))
            ->add('MemberLicencePaymentDate', DateType::class, array('label' => 'Date du Paiement', 'widget' => 'single_text'))
            ->add('MemberLicencePaymentValue', MoneyType::class, array('label' => 'Paiement/licence', 'divisor' => 100))
            ->add('Submit', SubmitType::class, array('label' => 'Valider'))
        ;
    }
}
