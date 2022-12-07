<?php

namespace App\Application\Schema\DisciplinaBundle\Controller;

use App\Application\Schema\DisciplinaBundle\Repository\DisciplinaRepository;
use App\Application\Schema\DisciplinaBundle\Entity\Disciplina;

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

#[Route('/api/disciplina', name: 'api_disciplina_')]
#[OA\Tag(name: 'Disciplina')]
#[ACL\Api(enable: true, title: 'Disciplina', description: 'Permissões do modulo Disciplina')]
class DisciplinaApiController extends BaseApiController
{

    public function getClass(): string
    {
        return Disciplina::class;
    }

    public function getRepository(): ObjectRepository
    {
        return $this->doctrine->getManager()->getRepository($this->getClass());
    }

    /** ****************************************************************************************** */
    /**
     * Recupera a coleção de recursos — Disciplina.
     * Recupera a coleção de recursos — Disciplina.
     * @throws QueryException
     */
    #[OA\Parameter( name: 'pagina', description: 'O número da página da coleção', in: 'query', required: false, allowEmptyValue: true, example: 1)]
    #[OA\Parameter( name: 'paginaTamanho', description: 'O tamanho da página da coleção', in: 'query', required: false, example: 10)]
    #[OA\Response(
        response: 200,
        description: 'Retorna Coleção de recursos Disciplina',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'codigo', type: 'string'),
                new OA\Property(property: 'periodo', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'descricao', type: 'string'),
                new OA\Property(property: 'ativo', type: 'boolean'),
                new OA\Property(property: 'gradeCurricular', type: 'integer' ),
            ],
            type: 'object'
        )
    )]
    #[Route('', name: 'list', methods: ['GET'])]
    #[ACL\Api(enable: true, title: 'Listar', description: 'Listar Disciplina')]
    public function listAction(Request $request): Response
    {
        $this->validateAccess(actionName: "listAction");

        $filter = new FilterDoctrine(
            repository:  $this->getRepository(),
            request: $request,
            attributesFilters: [
                'codigo', 'periodo', 'nome', 'descricao', 'ativo', 'gradeCurricular', 
            ]
        );

        $response = $this->objectTransformer->ObjectToJson( $filter->getResult()->data, [
            'codigo', 'periodo', 'nome', 'descricao', 'ativo', 'gradeCurricular', 
        ]);

        return $this->json([
            '@id' => $request->getPathInfo(),
            'result' => $response,
            'paginator' => $filter->getResult()->paginator,
        ]);
    }

    /** ****************************************************************************************** */
    /**
     * Cria o Recurso — Disciplina.
     * Cria o Recurso — Disciplina.
     */
    #[OA\Response(
        response: 201,
        description: 'Retorna novo recurso Disciplina',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'codigo', type: 'string'),
                new OA\Property(property: 'periodo', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'descricao', type: 'string'),
                new OA\Property(property: 'ativo', type: 'boolean'),
                new OA\Property(property: 'gradeCurricular', type: 'integer' ),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 400, description: 'Dados inválidos!')]
    #[OA\RequestBody(
        description: 'Json Payload',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'codigo', type: 'string'),
                new OA\Property(property: 'periodo', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'descricao', type: 'string'),
                new OA\Property(property: 'ativo', type: 'boolean'),
                new OA\Property(property: 'gradeCurricular', type: 'integer' ),
            ],
            type: 'object'
        )
    )]
    #[Route('', name: 'create', methods: ['POST'])]
    #[ACL\Api(enable: true, title: 'Criar', description: 'Criar Disciplina')]
    public function createAction(Request $request): Response
    {
        $this->validateAccess("createAction");

        if(!$request->getContent())
            return $this->json(['status' => false, 'message' => 'Dados inválidos!'], 400);

        /** Tranforma Corpo da requisação em um objeto da classe. */
        $object = $this->objectTransformer->JsonToObject( $this->getClass(), $request , [
            'codigo', 'periodo', 'nome', 'descricao', 'ativo', 'gradeCurricular', 
        ]);

        /** Valida Restrições do objeto */
        $errors = $this->validateConstraintErros($object);
        if($errors)
            return $this->json($errors);

        $em = $this->doctrine->getManager();
        $em->persist($object);
        $em->flush();

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'codigo', 'periodo', 'nome', 'descricao', 'ativo', 'gradeCurricular', 
        ]);

        return $this->json($response, 201);
    }

    /** ****************************************************************************************** */
    /**
     * Recupera o recurso — Disciplina.
     * Recupera o recurso — Disciplina.
     */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(
        response: 200,
        description: 'Retorna recurso Disciplina',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'codigo', type: 'string'),
                new OA\Property(property: 'periodo', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'descricao', type: 'string'),
                new OA\Property(property: 'ativo', type: 'boolean'),
                new OA\Property(property: 'gradeCurricular', type: 'integer' ),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    #[ACL\Api(enable: true, title: 'Visualizar', description: 'Visualizar Disciplina')]
    public function showAction(Request $request, mixed $id): Response
    {
        $this->validateAccess("showAction");

        $object = $this->getRepository()->find($id);
        if (!$object)
            return $this->json(['status' => false, 'message' => 'Disciplina não encontrado!'], 404);

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'codigo', 'periodo', 'nome', 'descricao', 'ativo', 'gradeCurricular', 
        ]);

        return $this->json([
            '@id' => $request->getPathInfo(),
            'result' => $response,
        ]);
    }

    /** ****************************************************************************************** */
    /**
     * Substitui o recurso — Disciplina.
     * Substitui o recurso — Disciplina.
     */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(
        response: 200,
        description: 'Retorna recurso Disciplina',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'codigo', type: 'string'),
                new OA\Property(property: 'periodo', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'descricao', type: 'string'),
                new OA\Property(property: 'ativo', type: 'boolean'),
                new OA\Property(property: 'gradeCurricular', type: 'integer' ),
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
                new OA\Property(property: 'codigo', type: 'string'),
                new OA\Property(property: 'periodo', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'descricao', type: 'string'),
                new OA\Property(property: 'ativo', type: 'boolean'),
                new OA\Property(property: 'gradeCurricular', type: 'integer' ),
            ],
            type: 'object'
        )
    )]
    #[Route('/{id}', name: 'edit', methods: ['PUT','PATCH'])]
    #[ACL\Api(enable: true, title: 'Editar', description: 'Editar Disciplina')]
    public function editAction(Request $request, mixed $id): Response
    {
        $this->validateAccess("editAction");

        $object = $this->getRepository()->find($id);
        if(!$object)
            return $this->json(['status' => false, 'message' => 'Disciplina não encontrado!'], 404);

        /** Transforma corpo da requisição em um objeto da classe. */
        $object = $this->objectTransformer->JsonToObject($object, $request, [
            'codigo', 'periodo', 'nome', 'descricao', 'ativo', 'gradeCurricular', 
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
            'codigo', 'periodo', 'nome', 'descricao', 'ativo', 'gradeCurricular', 
        ]);

        return $this->json($response);
    }

    /** ****************************************************************************************** */
    /**
    * Remove o recurso — Disciplina.
    * Remove o recurso — Disciplina.
    */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(response: 204, description: 'Recurso excluído')]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    #[ACL\Api(enable: true, title: 'Deletar', description: 'Deletar Disciplina')]
    public function deleteAction(mixed $id): Response
    {
        $this->validateAccess("deleteAction");

        $object = $this->getRepository()->find($id);
        if (!$object)
            return $this->json(['status' => false, 'message' => 'Disciplina não encontrado.'], 404);

        $em = $this->doctrine->getManager();
        $em->remove($object);
        $em->flush();

        return $this->json(['status' => true, 'message' => 'Disciplina removido com sucesso.'], 204);
    }

}