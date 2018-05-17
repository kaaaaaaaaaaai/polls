<?php

namespace App\Http\Controllers;

use App\Http\Resources\PollResource;
use App\Repositories\PollsRepository;
use Illuminate\Http\Request;

class PollController extends Controller
{
    const LIMIT = 12;
    /**
     * PollController constructor.
     * @param PollsRepository $pollRepository
     */
    public function __construct(PollsRepository $pollRepository)
    {
        $this->pollRepository = $pollRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function recent()
    {
        $data = $this->pollRepository->getRecent(self::LIMIT);
        return PollResource::collection($data);
    }

    /**
     * @param $id
     * @return static
     */
    public function detail($id)
    {
        $detail = $this->pollRepository->find($id);
        return PollResource::make($detail);
    }


    public function popular(){
        $popular = $this->pollRepository->getPopular(self::LIMIT);
        return PollResource::collection($popular);
    }
}
