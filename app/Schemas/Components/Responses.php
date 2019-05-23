<?php

/**
 * @OA\Response(
 *  response=400,
 *  description="Bad Request",
 *  @OA\MediaType(
 *    mediaType="application/json",
 *    @OA\Schema(ref="#/components/schemas/Error")
 *  )
 * ),
 * @OA\Response(
 *  response=401,
 *  description="Unauthorized",
 *  @OA\MediaType(
 *    mediaType="application/json",
 *    @OA\Schema(ref="#/components/schemas/Error")
 *  )
 * ),
 * @OA\Response(
 *   response=404,
 *   description="Not Found",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(ref="#/components/schemas/Error")
 *   )
 * ),
 * @OA\Response(
 *   response=409,
 *   description="Conflict",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(ref="#/components/schemas/Error")
 *   )
 * ),
 * @OA\Response(
 *   response=500,
 *   description="Internal Server Error",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(ref="#/components/schemas/Error")
 *   )
 * ),
 * @OA\Response(
 *   response=503,
 *   description="Service Unavailable",
 *   @OA\MediaType(
 *     mediaType="application/json",
 *     @OA\Schema(ref="#/components/schemas/Error")
 *   )
 * )
 */