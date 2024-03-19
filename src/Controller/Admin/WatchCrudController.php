<?php

namespace App\Controller\Admin;

use App\Entity\Watch;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class WatchCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Watch::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IntegerField::new('id');
        yield TextField::new('name');
        yield TextareaField::new('description');
        yield IntegerField::new('price');
        yield AssociationField::new('section');
        yield AssociationField::new('subsection');
        yield AssociationField::new('properties');
    }
}
