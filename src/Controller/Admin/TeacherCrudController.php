<?php

namespace App\Controller\Admin;

use App\Entity\Teacher;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class TeacherCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Teacher::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            'name',
            'surname',
            'email',
            AssociationField::new('subjects')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
        ];
    }
}
