<?php

/**
 * @OA\Get(
 *   path="/api/v1/users",
 *   summary="Buscar Usuarios",
 *   tags={"Users"},
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
 *   path="/api/v1/users/{id}",
 *   summary="Buscar usuario pelo id",
 *   security={{"Token API":{}}},
 *   tags={"Users"},
 *    @OA\Parameter(
 *          name="id",
 *          description="Id do Usuario",
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
 *   path="/api/v1/users",
 *   summary="Criar Ususario",
 *   security={{"Token API":{}}},
 *   tags={"Users"},
 *    @OA\Parameter(
 *          name="name",
 *          description="Nome do Usuario",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string",
 *          ),
 *    ),
 *    @OA\Parameter(
 *          name="last_name",
 *          description="Sobrenome do Usuario",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string",
 *          ),
 *    ),
 *    @OA\Parameter(
 *          name="email",
 *          description="Email do Usuario",
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
 *   path="/api/v1/users/{id}",
 *   summary="Atualizar Usuario",
 *   security={{"Token API":{}}},
 *   tags={"Users"},
 *    @OA\Parameter(
 *          name="id",
 *          description="Id do Usuario",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="string",
 *          ),
 *    ),
 *    @OA\Parameter(
 *          name="name",
 *          description="Nome do Usuario",
 *          in="query",
 *          @OA\Schema(
 *              type="string",
 *          ),
 *    ),
 *    @OA\Parameter(
 *          name="last_name",
 *          description="Sobrenome do Usuario",
 *          in="query",
 *          @OA\Schema(
 *              type="string",
 *          ),
 *    ),
 *    @OA\Parameter(
 *          name="email",
 *          description="Email do Usuario",
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
 *   path="/api/v1/users/{id}",
 *   summary="Deletar Usuario",
 *   security={{"Token API":{}}},
 *   tags={"Users"},
 *    @OA\Parameter(
 *          name="id",
 *          description="Id do Usuario",
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
