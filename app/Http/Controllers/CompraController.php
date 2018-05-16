<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Compra;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class CompraController.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:47:15pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - compra';
        $compras = Compra::paginate(6);
        return view('compra.index',compact('compras','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - compra';
        
        return view('compra.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compra = new Compra();

        
        $compra->orden_id = $request->orden_id;

        
        $compra->producto_id = $request->producto_id;

        
        
        $compra->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new compra has been created !!']);

        return redirect('compra');
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
        $title = 'Show - compra';

        if($request->ajax())
        {
            return URL::to('compra/'.$id);
        }

        $compra = Compra::findOrfail($id);
        return view('compra.show',compact('title','compra'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - compra';
        if($request->ajax())
        {
            return URL::to('compra/'. $id . '/edit');
        }

        
        $compra = Compra::findOrfail($id);
        return view('compra.edit',compact('title','compra'  ));
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
        $compra = Compra::findOrfail($id);
    	
        $compra->orden_id = $request->orden_id;
        
        $compra->producto_id = $request->producto_id;
        
        
        $compra->save();

        return redirect('compra');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/compra/'. $id . '/delete');

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
     	$compra = Compra::findOrfail($id);
     	$compra->delete();
        return URL::to('compra');
    }
}
