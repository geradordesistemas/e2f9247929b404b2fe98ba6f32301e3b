<?php

namespace App\Application\Schema\CursoBundle\Controller;

use App\Application\Schema\CursoBundle\Repository\CursoRepository;
use App\Application\Schema\CursoBundle\Entity\Curso;

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

#[Route('/api/curso', name: 'api_curso_')]
#[OA\Tag(name: 'Curso')]
#[ACL\Api(enable: true, title: 'Curso', description: 'Permissões do modulo Curso')]
class CursoApiController extends BaseApiController
{

    public function getClass(): string
    {
        return Curso::class;
    }

    public function getRepository(): ObjectRepository
    {
        return $this->doctrine->getManager()->getRepository($this->getClass());
    }

    /** ****************************************************************************************** */
    /**
     * Recupera a coleção de recursos — Curso.
     * Recupera a coleção de recursos — Curso.
     * @throws QueryException
     */
    #[OA\Parameter( name: 'pagina', description: 'O número da página da coleção', in: 'query', required: false, allowEmptyValue: true, example: 1)]
    #[OA\Parameter( name: 'paginaTamanho', description: 'O tamanho da página da coleção', in: 'query', required: false, example: 10)]
    #[OA\Response(
        response: 200,
        description: 'Retorna Coleção de recursos Curso',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'codigo', type: 'string'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'descricao', type: 'string'),
                new OA\Property(property: 'ativo', type: 'boolean'),
            ],
            type: 'object'
        )
    )]
    #[Route('', name: 'list', methods: ['GET'])]
    #[ACL\Api(enable: true, title: 'Listar', description: 'Listar Curso')]
    public function listAction(Request $request): Response
    {
        $this->validateAccess(actionName: "listAction");

        $filter = new FilterDoctrine(
            repository:  $this->getRepository(),
            request: $request,
            attributesFilters: [
                'codigo', 'nome', 'descricao', 'ativo', 
            ]
        );

        $response = $this->objectTransformer->ObjectToJson( $filter->getResult()->data, [
            'codigo', 'nome', 'descricao', 'ativo', 
        ]);

        return $this->json([
            '@id' => $request->getPathInfo(),
            'result' => $response,
            'paginator' => $filter->getResult()->paginator,
        ]);
    }

    /** ****************************************************************************************** */
    /**
     * Cria o Recurso — Curso.
     * Cria o Recurso — Curso.
     */
    #[OA\Response(
        response: 201,
        description: 'Retorna novo recurso Curso',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'codigo', type: 'string'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'descricao', type: 'string'),
                new OA\Property(property: 'ativo', type: 'boolean'),
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
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'descricao', type: 'string'),
                new OA\Property(property: 'ativo', type: 'boolean'),
            ],
            type: 'object'
        )
    )]
    #[Route('', name: 'create', methods: ['POST'])]
    #[ACL\Api(enable: true, title: 'Criar', description: 'Criar Curso')]
    public function createAction(Request $request): Response
    {
        $this->validateAccess("createAction");

        if(!$request->getContent())
            return $this->json(['status' => false, 'message' => 'Dados inválidos!'], 400);

        /** Tranforma Corpo da requisação em um objeto da classe. */
        $object = $this->objectTransformer->JsonToObject( $this->getClass(), $request , [
            'codigo', 'nome', 'descricao', 'ativo', 
        ]);

        /** Valida Restrições do objeto */
        $errors = $this->validateConstraintErros($object);
        if($errors)
            return $this->json($errors);

        $em = $this->doctrine->getManager();
        $em->persist($object);
        $em->flush();

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'codigo', 'nome', 'descricao', 'ativo', 
        ]);

        return $this->json($response, 201);
    }

    /** ****************************************************************************************** */
    /**
     * Recupera o recurso — Curso.
     * Recupera o recurso — Curso.
     */
    #[OA\Parameter( name: 'codigo', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(
        response: 200,
        description: 'Retorna recurso Curso',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'codigo', type: 'string'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'descricao', type: 'string'),
                new OA\Property(property: 'ativo', type: 'boolean'),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[Route('/{codigo}', name: 'show', methods: ['GET'])]
    #[ACL\Api(enable: true, title: 'Visualizar', description: 'Visualizar Curso')]
    public function showAction(Request $request, mixed $codigo): Response
    {
        $this->validateAccess("showAction");

        $object = $this->getRepository()->find($codigo);
        if (!$object)
            return $this->json(['status' => false, 'message' => 'Curso não encontrado!'], 404);

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'codigo', 'nome', 'descricao', 'ativo', 
        ]);

        return $this->json([
            '@id' => $request->getPathInfo(),
            'result' => $response,
        ]);
    }

    /** ****************************************************************************************** */
    /**
     * Substitui o recurso — Curso.
     * Substitui o recurso — Curso.
     */
    #[OA\Parameter( name: 'codigo', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(
        response: 200,
        description: 'Retorna recurso Curso',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'codigo', type: 'string'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'descricao', type: 'string'),
                new OA\Property(property: 'ativo', type: 'boolean'),
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
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'descricao', type: 'string'),
                new OA\Property(property: 'ativo', type: 'boolean'),
            ],
            type: 'object'
        )
    )]
    #[Route('/{codigo}', name: 'edit', methods: ['PUT','PATCH'])]
    #[ACL\Api(enable: true, title: 'Editar', description: 'Editar Curso')]
    public function editAction(Request $request, mixed $codigo): Response
    {
        $this->validateAccess("editAction");

        $object = $this->getRepository()->find($codigo);
        if(!$object)
            return $this->json(['status' => false, 'message' => 'Curso não encontrado!'], 404);

        /** Transforma corpo da requisição em um objeto da classe. */
        $object = $this->objectTransformer->JsonToObject($object, $request, [
            'codigo', 'nome', 'descricao', 'ativo', 
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
            'codigo', 'nome', 'descricao', 'ativo', 
        ]);

        return $this->json($response);
    }

    /** ****************************************************************************************** */
    /**
    * Remove o recurso — Curso.
    * Remove o recurso — Curso.
    */
    #[OA\Parameter( name: 'codigo', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(response: 204, description: 'Recurso excluído')]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[Route('/{codigo}', name: 'delete', methods: ['DELETE'])]
    #[ACL\Api(enable: true, title: 'Deletar', description: 'Deletar Curso')]
    public function deleteAction(mixed $codigo): Response
    {
        $this->validateAccess("deleteAction");

        $object = $this->getRepository()->find($codigo);
        if (!$object)
            return $this->json(['status' => false, 'message' => 'Curso não encontrado.'], 404);

        $em = $this->doctrine->getManager();
        $em->remove($object);
        $em->flush();

        return $this->json(['status' => true, 'message' => 'Curso removido com sucesso.'], 204);
    }

}