<?php

namespace App\Http\Controllers;

use App\Http\Resources\PollResource;
use App\Repositories\PollsRepository;
use Illuminate\Http\Request;

class PollController extends Controller
{

    public function __construct(PollsRepository $pollRepository)
    {
        $this->pollRepository = $pollRepository;
    }

    public function recent()
    {
        return PollResource::collection($this->pollRepository->getRecent(12));

    }
}
