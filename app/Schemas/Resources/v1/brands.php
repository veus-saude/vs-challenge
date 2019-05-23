<?php

/**
 * @OA\Get(
 *   path="/api/v1/brands",
 *   summary="Buscar Brands",
 *   security={{"Token API":{}}},
 *   tags={"Brands"},
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
 *   path="/api/v1/brands/{id}",
 *   summary="Buscar Brand pelo id",
 *   security={{"Token API":{}}},
 *   tags={"Brands"},
 *    @OA\Parameter(
 *          name="id",
 *          description="Id da Brand",
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
 *   path="/api/v1/brands",
 *   summary="Criar Brand",
 *   security={{"Token API":{}}},
 *   tags={"Brands"},
 *    @OA\Parameter(
 *          name="name",
 *          description="Nome da Brand",
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
 *   path="/api/v1/brands/{id}",
 *   summary="Atualizar Brand",
 *   security={{"Token API":{}}},
 *   tags={"Brands"},
 *    @OA\Parameter(
 *          name="id",
 *          description="Id da Brand",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="string",
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
 *   path="/api/v1/brands/{id}",
 *   summary="Deletar Brand",
 *   security={{"Token API":{}}},
 *   tags={"Brands"},
 *    @OA\Parameter(
 *          name="id",
 *          description="Id da Brand",
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
