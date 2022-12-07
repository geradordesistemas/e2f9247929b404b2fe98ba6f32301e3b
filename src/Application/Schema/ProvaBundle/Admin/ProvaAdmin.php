<?php
namespace App\Application\Schema\ProvaBundle\Admin;

use App\Application\Schema\ProvaBundle\Entity\Prova;
use App\Application\Schema\ProfessorBundle\Entity\Professor;
use App\Application\Schema\DisciplinaBundle\Entity\Disciplina;
use App\Application\Schema\TipoProvaBundle\Entity\TipoProva;

use App\Application\Project\ContentBundle\Admin\Base\BaseAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/** Components Form */
use Sonata\DoctrineORMAdminBundle\Filter\ModelFilter;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;

final class ProvaAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof Prova ? $object->getId()
        
        : '';
    }



    protected function configureFormFields(FormMapper $form): void
    {
        $form->tab('Geral');
            $form->with('Informações Gerais');


                $form->add('professor', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o Professor',
                    'help' => 'Filtros para pesquisa: [ id, nome, sobrenome, email,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
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
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "id","nome","sobrenome","email", ]))
                        [$property, $value] = $valueParts;

                        $datagrid->setValue($datagrid->getFilter($property)->getFormName(), null, $value);
                    },
                ]);

                $form->add('disciplina', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o Disciplina',
                    'help' => 'Filtros para pesquisa: [ id, codigo, periodo, nome, descricao, ativo,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
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
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "id","codigo","periodo","nome","descricao","ativo", ]))
                        [$property, $value] = $valueParts;

                        $datagrid->setValue($datagrid->getFilter($property)->getFormName(), null, $value);
                    },
                ]);

                $form->add('tipoProva', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o TipoProva',
                    'help' => 'Filtros para pesquisa: [ id, tipo, descricao,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
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
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "id","tipo","descricao", ]))
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

        $datagrid->add('professor', ModelFilter::class, [
            'label' => 'Professor',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (Professor $professor) {
                    return $professor->getId()
                    ;
                },
            ],
        ]);

        $datagrid->add('disciplina', ModelFilter::class, [
            'label' => 'Disciplina',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (Disciplina $disciplina) {
                    return $disciplina->getId()
                    ;
                },
            ],
        ]);

        $datagrid->add('tipoProva', ModelFilter::class, [
            'label' => 'TipoProva',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (TipoProva $tipoProva) {
                    return $tipoProva->getId()
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


        $list->add('professor', null, [
            'label' => 'Professor',
            'associated_property' => function (Professor $professor) {
                return $professor->getId()
                ;
            },
        ]);


        $list->add('disciplina', null, [
            'label' => 'Disciplina',
            'associated_property' => function (Disciplina $disciplina) {
                return $disciplina->getId()
                ;
            },
        ]);


        $list->add('tipoProva', null, [
            'label' => 'TipoProva',
            'associated_property' => function (TipoProva $tipoProva) {
                return $tipoProva->getId()
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

                $show->add('professor', null, [
                    'label' => 'Professor',
                    'associated_property' => function (Professor $professor) {
                        return $professor->getId()
                        ;
                    },
                ]);

                $show->add('disciplina', null, [
                    'label' => 'Disciplina',
                    'associated_property' => function (Disciplina $disciplina) {
                        return $disciplina->getId()
                        ;
                    },
                ]);

                $show->add('tipoProva', null, [
                    'label' => 'TipoProva',
                    'associated_property' => function (TipoProva $tipoProva) {
                        return $tipoProva->getId()
                        ;
                    },
                ]);


            $show->end();
        $show->end();
    }


}