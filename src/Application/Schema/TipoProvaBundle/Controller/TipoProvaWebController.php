<?php

namespace App\Application\Schema\TipoProvaBundle\Controller;

use App\Application\Schema\TipoProvaBundle\Entity\TipoProva;
use App\Application\Schema\TipoProvaBundle\Form\TipoProvaType;

use App\Application\Project\ContentBundle\Controller\Base\BaseWebController;
use App\Application\Project\ContentBundle\Attributes\Acl as ACL;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;


#[Route('/web/tipoProva', name: 'web_tipoProva_', methods: ['GET'])]
#[ACL\Web(enable: true, title: 'TipoProva', description: 'Permissões do modulo TipoProva')]
class TipoProvaWebController extends BaseWebController
{
    public function getBaseRouter(): string
    {
        return 'web_tipoProva_';
    }

    public function getRepository(): string
    {
        return TipoProva::class;
    }

    public function getBaseTemplate(): string
    {
        return "@ApplicationSchemaTipoProva/tipoProva/";
    }

    #[Route('', name: 'list', methods: ['GET'])]
    #[ACL\Web(enable: true, title: 'Listar', description: 'Lista TipoProva')]
    public function listAction(ManagerRegistry $doctrine, Request $request): Response
    {
        $this->validateAccess(actionName: 'listAction');

        return $this->render($this->getBaseTemplate() . 'list.html.twig', [
            'title' => 'Listar TipoProva',
        ]);
    }

    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    #[ACL\Web(enable: true, title: 'Criar', description: 'Cria TipoProva')]
    public function createAction(ManagerRegistry $doctrine, Request $request): Response
    {
        $this->validateAccess(actionName: 'createAction');

        return $this->render($this->getBaseTemplate() . 'list.html.twig', [
            'title' => 'Criar TipoProva',
        ]);
    }

    #[Route('/{id}/show', name: 'show', methods: ['GET'])]
    #[ACL\Web(enable: true, title: 'Visualizar', description: 'Visualiza TipoProva')]
    public function showAction(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $this->validateAccess(actionName: 'showAction');


        return $this->render($this->getBaseTemplate() . 'list.html.twig', [
            'title' => 'Visualizar TipoProva',
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    #[ACL\Web(enable: true, title: 'Editar', description: 'Edita TipoProva')]
    public function editAction(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $this->validateAccess(actionName: 'editAction');

        return $this->render($this->getBaseTemplate() . 'list.html.twig', [
            'title' => 'Editar TipoProva',
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['GET'])]
    #[ACL\Web(enable: true, title: 'Deletar', description: 'Deleta TipoProva')]
    public function deleteAction(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $this->validateAccess(actionName: 'deleteAction');

    }

}