<?php

namespace App\Controller\Admin;

use App\Entity\Review;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class ReviewCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Review::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('note')
                ->setChoices(fn () => [0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5])
                ->renderAsNativeWidget(),
            'comment',
            'studentEmail',
            AssociationField::new('professor'),
        ];
    }
}
