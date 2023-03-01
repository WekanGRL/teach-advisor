<?php

namespace App\Controller\Admin;

use App\Entity\Professor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ProfessorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Professor::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            'name',
            'first_name',
            'email',
            AssociationField::new('subjects')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
        ];
    }
}
