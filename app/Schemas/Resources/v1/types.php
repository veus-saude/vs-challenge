<?php

/**
 * @OA\Get(
 *   path="/api/v1/types",
 *   summary="Buscar Tipos",
 *   security={{"Token API":{}}},
 *   tags={"Types"},
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
 *   path="/api/v1/types/{id}",
 *   summary="Buscar um tipo pelo id",
 *   security={{"Token API":{}}},
 *   tags={"Types"},
 *    @OA\Parameter(
 *          name="id",
 *          description="Id do Tipo",
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
 *   path="/api/v1/types",
 *   summary="Criar Tipo",
 *   security={{"Token API":{}}},
 *   tags={"Types"},
 *    @OA\Parameter(
 *          name="name",
 *          description="Nome do Tipo",
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
 *   path="/api/v1/types/{id}",
 *   summary="Atualizar Tipo",
 *   security={{"Token API":{}}},
 *   tags={"Types"},
 *    @OA\Parameter(
 *          name="id",
 *          description="Id do Tipo",
 *          in="path",
 *          @OA\Schema(
 *              type="string",
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
 * @OA\Delete(
 *   path="/api/v1/types/{id}",
 *   summary="Deletar Tipo",
 *   security={{"Token API":{}}},
 *   tags={"Types"},
 *    @OA\Parameter(
 *          name="id",
 *          description="Id do Tipo",
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
