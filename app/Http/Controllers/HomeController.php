<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\atendimentos as objeto;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $objetos = objeto::orderBy('id','desc');

        if (isset($request['filtro'])) {
            $objetos->where('nome','LIKE','%'.$request['filtro'].'%')->orwhere('CPF','LIKE','%'.$request['filtro'].'%')->orwhere('RG','LIKE','%'.$request['filtro'].'%');
        }

        $objetos = $objetos->paginate(10);

        return view('home',compact('objetos'));

    }
}
