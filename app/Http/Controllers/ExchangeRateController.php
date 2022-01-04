<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeRateRequest;
use App\Services\ExchangeRateService;

class ExchangeRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExchangeRateRequest $request, ExchangeRateService $svc)
    {
        $validated = $request->validated();

        return $svc->convert(
            $validated['from'],
            $validated['to'],
            $validated['price'],
        );
    }
}
