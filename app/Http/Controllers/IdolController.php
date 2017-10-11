<?php

namespace App\Http\Controllers;

use App\Eloquent\Idol;
use Illuminate\Http\Request;
use Peeech\Application\Services\Idol\IdolService;
use App\Http\Requests\IdolRequest;

class IdolController extends Controller
{


    protected $idolService;

    public function __construct(IdolService $idolService)
    {
        $this->idolService = $idolService;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IdolRequest $request,$user_id)
    {
        $idol = $this->idolService->store($request->idol);
        return ['idol' => $idol];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Eloquent\Idol  $idol
     * @return \Illuminate\Http\Response
     */
    public function show(Idol $idol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Eloquent\Idol  $idol
     * @return \Illuminate\Http\Response
     */
    public function edit(Idol $idol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Eloquent\Idol  $idol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idol $idol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Eloquent\Idol  $idol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idol $idol)
    {
        //
    }
}
