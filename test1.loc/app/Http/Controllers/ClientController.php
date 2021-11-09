<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Auth;
use App\Apllication;
use App\User;
use Mail;
use App\Jobs\ApllicationSendMessageJob;
use Gate;



class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if(Gate::allows('client_view')){	} return abort( 403 );
		$this->access_check('client_view');
			return redirect()->route('client.show', ['id' => Auth::user('id') ] );
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //if( Gate::denies('client_create') ){ return abort(403); }
		$this->access_check('client_create');
		return view( env('THEME').'.apllication_form' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//if( Gate::denies('client_create') ){ return abort(403); }
		
		$this->access_check('client_create');
		if( true == $this->time_check() )
		{
			$this->validate( $request, [
				'topic' => 'required|max:255',
				'text' => 'required',
			]);
			$data = $request->except('_token', 'file' );
			if( $request->hasFile('file') ){
				$data['path'] = $request->file('file')->store( 'test1/images', 'public' ); 
			}
			$user = Auth::user() ;
			$data['user_id'] = $user['id'];
			$data['email'] = $user['email'];
			$data['name']  = $user['name'] ;
			$apllication = new Apllication($data);
			$apllication ->save();
			!empty($data['path']) ? $data['path'] = asset( 'storage/'.$data['path']) : $data['path'] = ''  ;
			$jobs = ( new ApllicationSendMessageJob( $data ) );
			dispatch($jobs);
			return redirect()->route('client.show', ['id' => $user['id'] ] );
		}
		return redirect()->route('client.show', ['id' => Auth::user('id') ] )
							->with('status','Заявку можно оставлять не больше одного раза в сутки!');	
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {	
		//if( Gate::denies('client_view') ){ return abort(403); }
		$this->access_check('client_view');
		$user = User::find( $id );
		$apllication = $user->apllications->all() ;
		return view( env('THEME').'.apllications',[ 'apllications'=>$apllication ] )
													->with( 'status',' Заявка создана! ' );			
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //;
    }
	
	public function time_check()// Проверяет чтоб не больше одного раза в сутки отправлял заявку пользователь.
    {
	   $tm = time() - (   Auth::user()->apllications->last()->created_at->timestamp );
		 return ( $tm > 86400 ) ? true : false ;
	}
	
	public function access_check( $rules )  // Проверка прав пользователя.
    {
		if( Gate::denies( $rules ) )
		{ return abort(403); }
	}
}
