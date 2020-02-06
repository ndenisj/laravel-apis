<?php

namespace App\Http\Controllers\Api\v1;

use App\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonResourceCollection;

class PersonController extends Controller
{
    /**
     * @return PersonResourceCollection
     */
    public function index(): PersonResourceCollection
    {
        return new PersonResourceCollection(Person::paginate(5));
    }

    /**
     * @param Person $person
     * @return PersonResource
     */
    public function show(Person $person): PersonResource // for PHP 7, the function is going to return a PersonResource
    {
        return new PersonResource($person);
    }

    /**
     * Create new entry
     * 
     * @param Request $request
     * @return PersonResource
     */
    public function store(Request $request): PersonResource
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'city' => 'required',
        ]);

        $person = Person::create($request->all());

        return new PersonResource($person);
    }

    /**
     * Update 
     */
    public function update(Request $request, Person $person): PersonResource
    {
        // $request->validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'phone' => 'required',
        //     'email' => 'required',
        //     'city' => 'required',
        // ]);

        $person->update($request->all());
        return new PersonResource($person);
    }

    /**
     * Delete
     */
    public function destroy(Person $person)
    {
        $person->delete();

        return response()->json();
    }
}
