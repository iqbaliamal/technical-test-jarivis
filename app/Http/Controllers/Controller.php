<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="Technical Test JARIVIS - IQBAL IKHLASUL AMAL",
 *      version="1.0.0",
 *      @OA\Contact(
 *          email="iqbaliamal@gmail.com",
 *          name="Iqbal Ikhlasul Amal"
 *      ),
 *      @OA\License(
 *      name="MIT License",
 *          url="https://opensource.org/licenses/MIT"
 *      )
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     securityScheme="bearerAuth",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
