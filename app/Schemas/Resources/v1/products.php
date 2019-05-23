<?php

/**
 * @OA\Get(
 *   path="/api/v1/products",
 *   summary="Buscar Produtos",
 *   security={{"Token API":{}}},
 *   tags={"Produtos"},
 *   @OA\Parameter(
 *          name="q",
 *          description="Tipo do produto",
 *          required=true,
 *          in="query",
 *          example="seringa",
 *          @OA\Schema(
 *              type="string",
 *          ),
 *    ),
 *     @OA\Parameter(
 *          name="filter[]",
 *          description="Filtros do Produto",
 *          in="query",
 *          @OA\Schema(
 *              type="array",
 *              @OA\Items(
 *                  type="string",
 *                  example="brand:BUNZL",
 *              ),
 *          ),
 *    ),
 *     @OA\Parameter(
 *          name="page",
 *          description="Numero da Pagina",
 *          in="query",
 *          @OA\Schema(
 *              type="integer",
 *          ),
 *    ),
 *   @OA\Response(response=500, ref="#/components/responses/500"),
 *   @OA\Response(response=401, ref="#/components/responses/401"),
 *   @OA\Response(response=409, description="Usuário já cadastrado no sistema", ref="#/components/responses/409"),
 *   @OA\Response(
 *       response="default",
 *       description="An ""unexpected"" error"
 *   )
 * )
 */


/**
 * @OA\Get(
 *   path="/api/v1/products/{id}",
 *   summary="Buscar um produto pelo id",
 *   security={{"Token API":{}}},
 *   tags={"Produtos"},
 *    @OA\Parameter(
 *          name="id",
 *          description="Id do Produto",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="string",
 *          ),
 *    ),
 *   @OA\Response(response=500, ref="#/components/responses/500"),
 *   @OA\Response(response=401, ref="#/components/responses/401"),
 *   @OA\Response(response=409, description="Usuário já cadastrado no sistema", ref="#/components/responses/409"),
 *   @OA\Response(
 *       response="default",
 *       description="An ""unexpected"" error"
 *   )
 * )
 */



/**
 * @OA\Post(
 *   path="/api/v1/products",
 *   summary="Criar Produtos",
 *   security={{"Token API":{}}},
 *   tags={"Produtos"},
 *    @OA\Parameter(
 *          name="id_brand",
 *          description="Id da Marca",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="integer",
 *          ),
 *    ),
 *    @OA\Parameter(
 *          name="id_type",
 *          description="Id do Tipo",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="integer",
 *          ),
 *    ),
 *    @OA\Parameter(
 *          name="name",
 *          description="Nome do Produto",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string",
 *          ),
 *    ),
 *   @OA\Response(response=500, ref="#/components/responses/500"),
 *   @OA\Response(response=401, ref="#/components/responses/401"),
 *   @OA\Response(response=409, description="Usuário já cadastrado no sistema", ref="#/components/responses/409"),
 *   @OA\Response(
 *       response="default",
 *       description="An ""unexpected"" error"
 *   )
 * )
 */


/**
 * @OA\Put(
 *   path="/api/v1/products/{id}",
 *   summary="Atualizar Produtos",
 *   security={{"Token API":{}}},
 *   tags={"Produtos"},
 *    @OA\Parameter(
 *          name="id",
 *          description="Id do Produto",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="string",
 *          ),
 *    ),
 *    @OA\Parameter(
 *          name="id_brand",
 *          description="Id da Marca",
 *          in="query",
 *          @OA\Schema(
 *              type="integer",
 *          ),
 *    ),
 *    @OA\Parameter(
 *          name="id_type",
 *          description="Id do Tipo",
 *          in="query",
 *          @OA\Schema(
 *              type="integer",
 *          ),
 *    ),
 *    @OA\Parameter(
 *          name="name",
 *          description="Nome do Produto",
 *          in="query",
 *          @OA\Schema(
 *              type="string",
 *          ),
 *    ),
 *   @OA\Response(response=500, ref="#/components/responses/500"),
 *   @OA\Response(response=401, ref="#/components/responses/401"),
 *   @OA\Response(response=409, description="Usuário já cadastrado no sistema", ref="#/components/responses/409"),
 *   @OA\Response(
 *       response="default",
 *       description="An ""unexpected"" error"
 *   )
 * )
 */


/**
 * @OA\Delete(
 *   path="/api/v1/products/{id}",
 *   summary="Deletar Produtos",
 *   security={{"Token API":{}}},
 *   tags={"Produtos"},
 *    @OA\Parameter(
 *          name="id",
 *          description="Id do Produto",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="string",
 *          ),
 *    ),
 *   @OA\Response(response=500, ref="#/components/responses/500"),
 *   @OA\Response(response=401, ref="#/components/responses/401"),
 *   @OA\Response(response=409, description="Usuário já cadastrado no sistema", ref="#/components/responses/409"),
 *   @OA\Response(
 *       response="default",
 *       description="An ""unexpected"" error"
 *   )
 * )
 */
