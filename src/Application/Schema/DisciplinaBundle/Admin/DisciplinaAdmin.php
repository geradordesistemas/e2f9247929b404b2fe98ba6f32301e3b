<?php
namespace App\Application\Schema\DisciplinaBundle\Admin;

use App\Application\Schema\DisciplinaBundle\Entity\Disciplina;
use App\Application\Schema\GradeCurricularBundle\Entity\GradeCurricular;

use App\Application\Project\ContentBundle\Admin\Base\BaseAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/** Components Form */
use Sonata\DoctrineORMAdminBundle\Filter\ModelFilter;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;

final class DisciplinaAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof Disciplina ? $object->getId()
        
        : '';
    }



    protected function configureFormFields(FormMapper $form): void
    {
        $form->tab('Geral');
            $form->with('Informações Gerais');


                $form->add('codigo',  TextType::class, [
                    'label' => 'Codigo',
                    'required' =>  true ,
                ]);

                $form->add('periodo',  IntegerType::class, [
                    'label' => 'Periodo',
                    'required' =>  true ,
                ]);

                $form->add('nome',  TextType::class, [
                    'label' => 'Nome',
                    'required' =>  true ,
                ]);

                $form->add('descricao',  TextType::class, [
                    'label' => 'Descricao',
                    'required' =>  true ,
                ]);

                $form->add('ativo',  CheckboxType::class, [
                    'label' => 'Ativo',
                    'required' =>  true ,
                ]);

                $form->add('gradeCurricular', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o GradeCurricular',
                    'help' => 'Filtros para pesquisa: [ id, grade, descricao, ativo,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
                    'minimum_input_length' => 0,
                    'items_per_page' => 10,
                    'quiet_millis' => 100,
                    'multiple' =>  false ,
                    'required' =>  false ,
                    'to_string_callback' => function($entity, $property) {
                        return $entity->getId() ;
                    },
                    'callback' => static function (AdminInterface $admin, string $property, string $value): void {
                        $property = strtolower($property);
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $valueParts = explode('=', $value);
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "id","grade","descricao","ativo", ]))
                        [$property, $value] = $valueParts;

                        $datagrid->setValue($datagrid->getFilter($property)->getFormName(), null, $value);
                    },
                ]);

            $form->end();
        $form->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id', null, [
            'label' => 'Id',
        ]);

        $datagrid->add('codigo', null, [
            'label' => 'Codigo',
        ]);

        $datagrid->add('periodo', null, [
            'label' => 'Periodo',
        ]);

        $datagrid->add('nome', null, [
            'label' => 'Nome',
        ]);

        $datagrid->add('descricao', null, [
            'label' => 'Descricao',
        ]);

        $datagrid->add('ativo', null, [
            'label' => 'Ativo',
        ]);

        $datagrid->add('gradeCurricular', ModelFilter::class, [
            'label' => 'GradeCurricular',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (GradeCurricular $gradeCurricular) {
                    return $gradeCurricular->getId()
                    ;
                },
            ],
        ]);

    }

    protected function configureListFields(ListMapper $list): void
    {

        $list->addIdentifier('id', null, [
            'label' => 'Id',
        ]);


        $list->addIdentifier('codigo', null, [
            'label' => 'Codigo',
        ]);


        $list->addIdentifier('periodo', null, [
            'label' => 'Periodo',
        ]);


        $list->addIdentifier('nome', null, [
            'label' => 'Nome',
        ]);


        $list->addIdentifier('descricao', null, [
            'label' => 'Descricao',
        ]);


        $list->addIdentifier('ativo', null, [
            'label' => 'Ativo',
        ]);


        $list->add('gradeCurricular', null, [
            'label' => 'GradeCurricular',
            'associated_property' => function (GradeCurricular $gradeCurricular) {
                return $gradeCurricular->getId()
                ;
            },
        ]);


        $list->add(ListMapper::NAME_ACTIONS, ListMapper::TYPE_ACTIONS, [
            'actions' => [
                'show'   => [],
                'edit'   => [],
                'delete' => [],
            ]
        ]);

    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->tab('Geral');
            $show->with('Informações Gerais', [
                'class'       => 'col-md-12',
                'box_class'   => 'box box-solid box-primary',
                'description' => 'Informações Gerais',
            ]);

                $show->add('id', null, [
                    'label' => 'Id',
                ]);

                $show->add('codigo', null, [
                    'label' => 'Codigo',
                ]);

                $show->add('periodo', null, [
                    'label' => 'Periodo',
                ]);

                $show->add('nome', null, [
                    'label' => 'Nome',
                ]);

                $show->add('descricao', null, [
                    'label' => 'Descricao',
                ]);

                $show->add('ativo', null, [
                    'label' => 'Ativo',
                ]);

                $show->add('gradeCurricular', null, [
                    'label' => 'GradeCurricular',
                    'associated_property' => function (GradeCurricular $gradeCurricular) {
                        return $gradeCurricular->getId()
                        ;
                    },
                ]);


            $show->end();
        $show->end();
    }


}