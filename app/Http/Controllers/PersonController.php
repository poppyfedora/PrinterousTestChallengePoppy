<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = new Person();
        $persons = $persons->getAll(0);

        return view('person.index', compact('persons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('person.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'p_name'=>'required|string',
            'p_phone'=> 'required|string|numeric',
            'p_email' => 'required|string',
            'p_avatar' => 'required|string',
            'p_org_id' => 'required|integer'
        ]);

        $name = $request->p_name;
        $phone = $request->p_phone;
        $email = $request->p_email;
        $avatar = $request->p_avatar;
        $org_id = $request->p_org_id;

        $p = new Person();
        $p->createPerson($name, $phone, $email, $avatar, $org_id);
        return redirect('/person')->with('success', 'Organization has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = new Person();
        $p = $p->getByID($id);

        return view('person.view', compact('p'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $p = new Person();
        $p = $p->getByID($id);

        return view('person.edit', compact('p'));
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
//        dd('a');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = new Person();
        $p = $p->deletePerson($id);

        return redirect('/person')->with('success', 'Person has been deleted');
    }
}
