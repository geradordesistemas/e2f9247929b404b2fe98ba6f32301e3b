<?php

namespace App\Application\Schema\GradeCurricularBundle\Controller;

use App\Application\Schema\GradeCurricularBundle\Entity\GradeCurricular;
use App\Application\Schema\GradeCurricularBundle\Form\GradeCurricularType;

use App\Application\Project\ContentBundle\Controller\Base\BaseWebController;
use App\Application\Project\ContentBundle\Attributes\Acl as ACL;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;


#[Route('/web/gradeCurricular', name: 'web_gradeCurricular_', methods: ['GET'])]
#[ACL\Web(enable: true, title: 'GradeCurricular', description: 'Permissões do modulo GradeCurricular')]
class GradeCurricularWebController extends BaseWebController
{
    public function getBaseRouter(): string
    {
        return 'web_gradeCurricular_';
    }

    public function getRepository(): string
    {
        return GradeCurricular::class;
    }

    public function getBaseTemplate(): string
    {
        return "@ApplicationSchemaGradeCurricular/gradeCurricular/";
    }

    #[Route('', name: 'list', methods: ['GET'])]
    #[ACL\Web(enable: true, title: 'Listar', description: 'Lista GradeCurricular')]
    public function listAction(ManagerRegistry $doctrine, Request $request): Response
    {
        $this->validateAccess(actionName: 'listAction');

        return $this->render($this->getBaseTemplate() . 'list.html.twig', [
            'title' => 'Listar GradeCurricular',
        ]);
    }

    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    #[ACL\Web(enable: true, title: 'Criar', description: 'Cria GradeCurricular')]
    public function createAction(ManagerRegistry $doctrine, Request $request): Response
    {
        $this->validateAccess(actionName: 'createAction');

        return $this->render($this->getBaseTemplate() . 'list.html.twig', [
            'title' => 'Criar GradeCurricular',
        ]);
    }

    #[Route('/{id}/show', name: 'show', methods: ['GET'])]
    #[ACL\Web(enable: true, title: 'Visualizar', description: 'Visualiza GradeCurricular')]
    public function showAction(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $this->validateAccess(actionName: 'showAction');


        return $this->render($this->getBaseTemplate() . 'list.html.twig', [
            'title' => 'Visualizar GradeCurricular',
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    #[ACL\Web(enable: true, title: 'Editar', description: 'Edita GradeCurricular')]
    public function editAction(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $this->validateAccess(actionName: 'editAction');

        return $this->render($this->getBaseTemplate() . 'list.html.twig', [
            'title' => 'Editar GradeCurricular',
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['GET'])]
    #[ACL\Web(enable: true, title: 'Deletar', description: 'Deleta GradeCurricular')]
    public function deleteAction(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $this->validateAccess(actionName: 'deleteAction');

    }

}