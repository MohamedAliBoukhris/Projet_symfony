<?php
namespace AppBundle\Form\Type;
/**
 * Created by PhpStorm.
 * User: daly
 * Date: 08/05/2017
 * Time: 16:12
 */
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
class BlogType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',\Symfony\Component\Form\Extension\Core\Type\TextType::class)
            ->add('content',\Symfony\Component\Form\Extension\Core\Type\TextType::class)
            ->add('send',SubmitType::class);
        //parent::buildForm($builder, $options);
    }
}