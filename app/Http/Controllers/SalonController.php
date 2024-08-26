<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\SalonsRepositoryContract;
use App\DTO\ApiSalonModel;
use Illuminate\Http\Request;

class SalonController extends Controller
{
    public function __construct(private readonly SalonsRepositoryContract $salonsRepository)
    {
    }

    public function salons()
    {
        return view('pages.salons', ['salons' => $this->salonsRepository->find()]);
    }
}
