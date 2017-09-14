<?php

namespace App\Http\Controllers;

use App\Eloquent\Region;
use Illuminate\Http\Request;
use App\UserService;

class RegionController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Eloquent\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Eloquent\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Eloquent\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$user_id)
    {
        $this->validate($request,['region' => 'required|max:255']);
        $user = $this->userService->getUser($user_id);
        $region = $this->userService->editOtherProfsSingle($request,$user,'region');
        return ['region',$region];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Eloquent\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        //
    }
}
