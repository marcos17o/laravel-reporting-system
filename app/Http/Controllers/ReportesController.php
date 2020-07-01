<?php

namespace App\Http\Controllers;

use App\Permission\Models\Factura;
use Illuminate\Http\Request;
use App\User;
use App\Permission\Models\Role;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::with('users')->where('id',3)->get();
        return view('reports.index', compact('role'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {

    }






}
