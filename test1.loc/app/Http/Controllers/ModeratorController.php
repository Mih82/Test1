<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apllication;
use Auth;
use App\User;
use Gate;

class ModeratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if( Gate::denies('moderator_view') ){ return abort(403); }
		$this->access_check('moderator_view');
		$apllications = Apllication::all();
		return view( env('THEME').'.moderator_apllication',  ['apllications'=>$apllications] );
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //if( Gate::denies('moderator_view') ){ return abort(403); }
		$this->access_check('moderator_view');
		$apllication = Apllication::find( $id );
		return view( env('THEME').'.apllication_show', ['apllication'=>$apllication ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //if( Gate::denies('moderator_update') ){ return abort(403); }
		$this->access_check('moderator_update');
		!empty($request->input('status')) ? $status = $request->input('status') : $status = 'false' ;
		Apllication::where( 'id', $id )->update( [ 'status'=>$status ] );
		return redirect()->route( 'moderator.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //if( Gate::denies('delete', new Apllication ) ){ return abort(403); }
		$this->access_check('delete' );
		$apllication = Apllication::find($id);
		$apllication->delete();
		return redirect()->route( 'moderator.index' )->with('status','Удалена заявка!');
		
    }
	
	public function access_check( $rules )  // Проверка прав пользователя.
    {
		if( Gate::denies( $rules , new Apllication ) )
		{ return abort(403); }
	}
}
