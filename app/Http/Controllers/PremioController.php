<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Premio;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class PremioController.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:49:56pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class PremioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - premio';
        $premios = Premio::paginate(6);
        return view('premio.index',compact('premios','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - premio';
        
        return view('premio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $premio = new Premio();

        
        $premio->foto = $request->foto;

        
        $premio->nombre = $request->nombre;

        
        $premio->descripcion = $request->descripcion;

        
        $premio->puntos = $request->puntos;

        
        $premio->estatus = $request->estatus;

        
        
        $premio->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new premio has been created !!']);

        return redirect('premio');
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
        $title = 'Show - premio';

        if($request->ajax())
        {
            return URL::to('premio/'.$id);
        }

        $premio = Premio::findOrfail($id);
        return view('premio.show',compact('title','premio'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - premio';
        if($request->ajax())
        {
            return URL::to('premio/'. $id . '/edit');
        }

        
        $premio = Premio::findOrfail($id);
        return view('premio.edit',compact('title','premio'  ));
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
        $premio = Premio::findOrfail($id);
    	
        $premio->foto = $request->foto;
        
        $premio->nombre = $request->nombre;
        
        $premio->descripcion = $request->descripcion;
        
        $premio->puntos = $request->puntos;
        
        $premio->estatus = $request->estatus;
        
        
        $premio->save();

        return redirect('premio');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/premio/'. $id . '/delete');

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
     	$premio = Premio::findOrfail($id);
     	$premio->delete();
        return URL::to('premio');
    }
}
