<?php

namespace App\Http\Controllers;

use App\Organization;
use App\Person;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $org = new Organization();
        $orgs = $org->getAll(0);

        return view('organization.index', compact('orgs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organization.create');
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
            'org_name'=>'required|string',
            'org_phone'=> 'required|string|numeric',
            'org_email' => 'required|string',
            'org_website' => 'required|string',
            'org_logo' => 'required|string'
        ]);

        $name = $request->org_name;
        $phone = $request->org_phone;
        $email = $request->org_email;
        $website = $request->org_website;
        $logo = $request->org_logo;

        $org = new Organization();
        $org->createOrg($name, $phone, $email, $website, $logo);
        return redirect('/organization')->with('success', 'Organization has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $org = new Organization();
        $org = $org->getByID($id);

        $persons = new Person();
        $persons = $persons->getAllByOrganizationID($id);

        $datas = [
          'org' => $org,
            'persons' => $persons
        ];

        return view('organization.view', compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $org = new Organization();
        $org = $org->getByID($id);

        return view('organization.edit', compact('org'));
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
        $org = new Organization();
        $org = $org->deleteOrg($id);

        return redirect('/organization')->with('success', 'Organization has been deleted');
    }

}
