<?php

namespace App\Application\Schema\ProfessorBundle\Controller;

use App\Application\Schema\ProfessorBundle\Repository\ProfessorRepository;
use App\Application\Schema\ProfessorBundle\Entity\Professor;

use App\Application\Project\ContentBundle\Controller\Base\BaseApiController;
use App\Application\Project\ContentBundle\Service\FilterDoctrine;
use App\Application\Project\ContentBundle\Attributes\Acl as ACL;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\QueryException;
use OpenApi\Attributes as OA;

#[Route('/api/professor', name: 'api_professor_')]
#[OA\Tag(name: 'Professor')]
#[ACL\Api(enable: true, title: 'Professor', description: 'Permissões do modulo Professor')]
class ProfessorApiController extends BaseApiController
{

    public function getClass(): string
    {
        return Professor::class;
    }

    public function getRepository(): ObjectRepository
    {
        return $this->doctrine->getManager()->getRepository($this->getClass());
    }

    /** ****************************************************************************************** */
    /**
     * Recupera a coleção de recursos — Professor.
     * Recupera a coleção de recursos — Professor.
     * @throws QueryException
     */
    #[OA\Parameter( name: 'pagina', description: 'O número da página da coleção', in: 'query', required: false, allowEmptyValue: true, example: 1)]
    #[OA\Parameter( name: 'paginaTamanho', description: 'O tamanho da página da coleção', in: 'query', required: false, example: 10)]
    #[OA\Response(
        response: 200,
        description: 'Retorna Coleção de recursos Professor',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'sobrenome', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
            ],
            type: 'object'
        )
    )]
    #[Route('', name: 'list', methods: ['GET'])]
    #[ACL\Api(enable: true, title: 'Listar', description: 'Listar Professor')]
    public function listAction(Request $request): Response
    {
        $this->validateAccess(actionName: "listAction");

        $filter = new FilterDoctrine(
            repository:  $this->getRepository(),
            request: $request,
            attributesFilters: [
                'nome', 'sobrenome', 'email', 
            ]
        );

        $response = $this->objectTransformer->ObjectToJson( $filter->getResult()->data, [
            'nome', 'sobrenome', 'email', 
        ]);

        return $this->json([
            '@id' => $request->getPathInfo(),
            'result' => $response,
            'paginator' => $filter->getResult()->paginator,
        ]);
    }

    /** ****************************************************************************************** */
    /**
     * Cria o Recurso — Professor.
     * Cria o Recurso — Professor.
     */
    #[OA\Response(
        response: 201,
        description: 'Retorna novo recurso Professor',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'sobrenome', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 400, description: 'Dados inválidos!')]
    #[OA\RequestBody(
        description: 'Json Payload',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'sobrenome', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
            ],
            type: 'object'
        )
    )]
    #[Route('', name: 'create', methods: ['POST'])]
    #[ACL\Api(enable: true, title: 'Criar', description: 'Criar Professor')]
    public function createAction(Request $request): Response
    {
        $this->validateAccess("createAction");

        if(!$request->getContent())
            return $this->json(['status' => false, 'message' => 'Dados inválidos!'], 400);

        /** Tranforma Corpo da requisação em um objeto da classe. */
        $object = $this->objectTransformer->JsonToObject( $this->getClass(), $request , [
            'nome', 'sobrenome', 'email', 
        ]);

        /** Valida Restrições do objeto */
        $errors = $this->validateConstraintErros($object);
        if($errors)
            return $this->json($errors);

        $em = $this->doctrine->getManager();
        $em->persist($object);
        $em->flush();

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'nome', 'sobrenome', 'email', 
        ]);

        return $this->json($response, 201);
    }

    /** ****************************************************************************************** */
    /**
     * Recupera o recurso — Professor.
     * Recupera o recurso — Professor.
     */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(
        response: 200,
        description: 'Retorna recurso Professor',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'sobrenome', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    #[ACL\Api(enable: true, title: 'Visualizar', description: 'Visualizar Professor')]
    public function showAction(Request $request, mixed $id): Response
    {
        $this->validateAccess("showAction");

        $object = $this->getRepository()->find($id);
        if (!$object)
            return $this->json(['status' => false, 'message' => 'Professor não encontrado!'], 404);

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'nome', 'sobrenome', 'email', 
        ]);

        return $this->json([
            '@id' => $request->getPathInfo(),
            'result' => $response,
        ]);
    }

    /** ****************************************************************************************** */
    /**
     * Substitui o recurso — Professor.
     * Substitui o recurso — Professor.
     */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(
        response: 200,
        description: 'Retorna recurso Professor',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'sobrenome', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 400, description: 'Dados inválidos!')]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[OA\RequestBody(
        description: 'Json Payload',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'sobrenome', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
            ],
            type: 'object'
        )
    )]
    #[Route('/{id}', name: 'edit', methods: ['PUT','PATCH'])]
    #[ACL\Api(enable: true, title: 'Editar', description: 'Editar Professor')]
    public function editAction(Request $request, mixed $id): Response
    {
        $this->validateAccess("editAction");

        $object = $this->getRepository()->find($id);
        if(!$object)
            return $this->json(['status' => false, 'message' => 'Professor não encontrado!'], 404);

        /** Transforma corpo da requisição em um objeto da classe. */
        $object = $this->objectTransformer->JsonToObject($object, $request, [
            'nome', 'sobrenome', 'email', 
        ]);

        /** Valida Restrições do objeto */
        $errors = $this->validateConstraintErros($object);
        if($errors)
            return $this->json($errors);

        /** Persiste o objeto */
        $em = $this->doctrine->getManager();
        $em->persist($object);
        $em->flush();

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'nome', 'sobrenome', 'email', 
        ]);

        return $this->json($response);
    }

    /** ****************************************************************************************** */
    /**
    * Remove o recurso — Professor.
    * Remove o recurso — Professor.
    */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(response: 204, description: 'Recurso excluído')]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    #[ACL\Api(enable: true, title: 'Deletar', description: 'Deletar Professor')]
    public function deleteAction(mixed $id): Response
    {
        $this->validateAccess("deleteAction");

        $object = $this->getRepository()->find($id);
        if (!$object)
            return $this->json(['status' => false, 'message' => 'Professor não encontrado.'], 404);

        $em = $this->doctrine->getManager();
        $em->remove($object);
        $em->flush();

        return $this->json(['status' => true, 'message' => 'Professor removido com sucesso.'], 204);
    }

}