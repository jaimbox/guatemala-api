<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Guatemala API",
     *      description="Implementation of Guatemala API with Laravel",
     *      @OA\Contact(
     *          email="jasiel_izaguirre@hotmail.com",
     *          name="Jasiel Izaguirre"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url="http://localhost:8000",
     *      description="Guatemala API"
     * )

     *
     *
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
