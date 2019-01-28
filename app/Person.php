<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Person extends Model
{
    protected $table = 'person';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'avatar',
        'organization_id'
    ];

    private function defaultQuery($hideDeleted = true) {
        $query = DB::table('person');
        if ($hideDeleted) {
            $query->whereNull('person.deleted_at');
        }
        return $query;
    }

    public function getByID($id) {
        $p = self::defaultQuery(false)
            ->where('person.id', $id)
            ->first();
        return ($p) ? $p : (object)[];
    }

    public function getAll($page = 0, $numberofItems = 10) {
        $rs = self::defaultQuery();

        if ($page > 0){
            $page = ($page <= 0) ? 0 : $page - 1;
            $offset = $page * $numberofItems;
            $rs->take($numberofItems)->skip($offset);
        }

        $rs = $rs->get();
        $persons = [];
        $i = 0;
        if (count($rs) > 0) {
            foreach ($rs as $item) {
                array_push($persons, [
                    'number' => ++$i,
                    'id' => $item->id,
                    'name' => $item->name,
                    'phone' => $item->phone,
                    'email' => $item->email,
                    'avatar' => $item->avatar
                ]);
            }
        }

        return $persons;
    }

    public function getAllByOrganizationID($organizationID, $page = 0, $numberofItems = 10) {
        $rs = self::defaultQuery()
            ->leftJoin('organization', function ($query){
                $query->on('organization.id', '=', 'person.organization_id')
                    ->whereNull('organization.deleted_at');
            })
            ->where('person.organization_id', $organizationID);

        if ($page > 0){
            $page = ($page <= 0) ? 0 : $page - 1;
            $offset = $page * $numberofItems;
            $rs->take($numberofItems)->skip($offset);
        }

        $rs = $rs->get();
        $persons = [];
        if (count($rs) > 0) {
            foreach ($rs as $item) {
                array_push($persons, [
                    'name' => $item->name,
                    'phone' => $item->phone,
                    'email' => $item->email,
                    'avatar' => $item->avatar
                ]);
            }
        }

        return $persons;
    }

    public function createPerson($name, $phone, $email, $avatar, $organization_id){
        $item = self::create([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'avatar' => $avatar,
            'organization_id' => $organization_id
        ]);
        return ($item) ? $item->id : false;
    }

    public function deletePerson($id) {
        $update_item = self::defaultQuery()
            ->where('id', $id)
            ->update([
                'deleted_at' => Carbon::now()->toDateTimeString()
            ]);

        return ($update_item > 0) ? true : false;
    }

}


