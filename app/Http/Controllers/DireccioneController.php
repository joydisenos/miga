<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Direccione;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class DireccioneController.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:42:37pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class DireccioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - direccione';
        $direcciones = Direccione::paginate(6);
        return view('direccione.index',compact('direcciones','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - direccione';
        
        return view('direccione.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $direccione = new Direccione();

        
        $direccione->user_id = $request->user_id;

        
        $direccione->zip = $request->zip;

        
        $direccione->direccion = $request->direccion;

        
        $direccione->referencia = $request->referencia;

        
        
        $direccione->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new direccione has been created !!']);

        return redirect('direccione');
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $title = 'Show - direccione';

        if($request->ajax())
        {
            return URL::to('direccione/'.$id);
        }

        $direccione = Direccione::findOrfail($id);
        return view('direccione.show',compact('title','direccione'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - direccione';
        if($request->ajax())
        {
            return URL::to('direccione/'. $id . '/edit');
        }

        
        $direccione = Direccione::findOrfail($id);
        return view('direccione.edit',compact('title','direccione'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $direccione = Direccione::findOrfail($id);
    	
        $direccione->user_id = $request->user_id;
        
        $direccione->zip = $request->zip;
        
        $direccione->direccion = $request->direccion;
        
        $direccione->referencia = $request->referencia;
        
        
        $direccione->save();

        return redirect('direccione');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/direccione/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$direccione = Direccione::findOrfail($id);
     	$direccione->delete();
        return URL::to('direccione');
    }
}
