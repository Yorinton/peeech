<?php

namespace App\Http\Controllers;

use App\Eloquent\Statue;
use Illuminate\Http\Request;
use App\Services\UserService;


class StatueController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
    public function store(Request $request,$user_id)
    {
        $this->validate($request,['statue_id' => 'required|max:255']);
        $user = $this->userService->getUser($user_id);
        $statue = $this->userService->addOtherProfsSingle($request,$user,'statue_id');
        return ['statue' => $statue];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Eloquent\Statue  $statue
     * @return \Illuminate\Http\Response
     */
    public function show(Statue $statue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Eloquent\Statue  $statue
     * @return \Illuminate\Http\Response
     */
    public function edit(Statue $statue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Eloquent\Statue  $statue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statue $statue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Eloquent\Statue  $statue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statue $statue)
    {
        //
    }
}
