<?php
namespace App\Application\Schema\CursoBundle\Admin;

use App\Application\Schema\CursoBundle\Entity\Curso;

use App\Application\Project\ContentBundle\Admin\Base\BaseAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/** Components Form */
use Sonata\DoctrineORMAdminBundle\Filter\ModelFilter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

final class CursoAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof Curso ? $object->getCodigo()
        
        : '';
    }



    protected function configureFormFields(FormMapper $form): void
    {
        $form->tab('Geral');
            $form->with('Informações Gerais');

                $form->add('codigo', TextType::class, [
                    'label' => 'Codigo',
                    'required' => true,
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

            $form->end();
        $form->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('codigo', null, [
            'label' => 'Codigo',
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

    }

    protected function configureListFields(ListMapper $list): void
    {

        $list->addIdentifier('codigo', null, [
            'label' => 'Codigo',
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

                $show->add('codigo', null, [
                    'label' => 'Codigo',
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


            $show->end();
        $show->end();
    }


}