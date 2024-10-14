<?php

namespace App\Http\Controllers\admin\transport;

use App\Http\Controllers\Controller;
use App\Http\Repository\admin\transport\TransportRepository;
use App\Http\Requests\Admin\transport\TransportRequest;



class TransportController extends Controller
{
    protected $transportRepository;

    function __construct(TransportRepository $transportRepository)
    {
        $this->transportRepository = $transportRepository;
    }

    
    public function createTransport(TransportRequest $request)
    {
        return $this->transportRepository->createShippingOrder($request);
    }
}
