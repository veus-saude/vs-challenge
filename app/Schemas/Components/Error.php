<?php

/**
 * @OA\Schema(
 *  schema="Error",
 *  title="Error",
 *  @OA\Property(
 *     property="error",
 *     type="object",
 *     @OA\Property(
 *        property="code",
 *        type="integer",
 *        format="int32",
 *        description="Error code",
 *        example=000
 *     ),
 *     @OA\Property(
 *        property="message",
 *        type="string",
 *        description="Error message"
 *     )
 *  )
 * )
 */