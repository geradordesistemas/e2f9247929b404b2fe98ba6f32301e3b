<?php
namespace App\Application\Schema\GradeCurricularBundle\Admin;

use App\Application\Schema\GradeCurricularBundle\Entity\GradeCurricular;
use App\Application\Schema\CursoBundle\Entity\Curso;

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

final class GradeCurricularAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof GradeCurricular ? $object->getId()
        
        : '';
    }



    protected function configureFormFields(FormMapper $form): void
    {
        $form->tab('Geral');
            $form->with('Informações Gerais');


                $form->add('grade',  TextType::class, [
                    'label' => 'Grade',
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

                $form->add('curso', ModelAutocompleteType::class, [
                    'property' => 'codigo',
                    'placeholder' => 'Escolha o Curso',
                    'help' => 'Filtros para pesquisa: [ codigo, nome, descricao, ativo,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
                    'minimum_input_length' => 0,
                    'items_per_page' => 10,
                    'quiet_millis' => 100,
                    'multiple' =>  false ,
                    'required' =>  false ,
                    'to_string_callback' => function($entity, $property) {
                        return $entity->getCodigo() ;
                    },
                    'callback' => static function (AdminInterface $admin, string $property, string $value): void {
                        $property = strtolower($property);
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $valueParts = explode('=', $value);
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "codigo","nome","descricao","ativo", ]))
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

        $datagrid->add('grade', null, [
            'label' => 'Grade',
        ]);

        $datagrid->add('descricao', null, [
            'label' => 'Descricao',
        ]);

        $datagrid->add('ativo', null, [
            'label' => 'Ativo',
        ]);

        $datagrid->add('curso', ModelFilter::class, [
            'label' => 'Curso',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (Curso $curso) {
                    return $curso->getCodigo()
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


        $list->addIdentifier('grade', null, [
            'label' => 'Grade',
        ]);


        $list->addIdentifier('descricao', null, [
            'label' => 'Descricao',
        ]);


        $list->addIdentifier('ativo', null, [
            'label' => 'Ativo',
        ]);


        $list->add('curso', null, [
            'label' => 'Curso',
            'associated_property' => function (Curso $curso) {
                return $curso->getCodigo()
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

                $show->add('grade', null, [
                    'label' => 'Grade',
                ]);

                $show->add('descricao', null, [
                    'label' => 'Descricao',
                ]);

                $show->add('ativo', null, [
                    'label' => 'Ativo',
                ]);

                $show->add('curso', null, [
                    'label' => 'Curso',
                    'associated_property' => function (Curso $curso) {
                        return $curso->getCodigo()
                        ;
                    },
                ]);


            $show->end();
        $show->end();
    }


}