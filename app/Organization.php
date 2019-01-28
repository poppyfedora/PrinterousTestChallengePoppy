<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Organization extends Model
{
    protected $table = 'organization';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'website',
        'logo'
    ];

    private function defaultQuery($hideDeleted = true) {
        $query = DB::table('organization');
        if ($hideDeleted) {
            $query->whereNull('organization.deleted_at');
        }
        return $query;
    }

    public function getByID($id) {
        $item = self::defaultQuery(false)
            ->where('organization.id', $id)
            ->first();
        return ($item) ? $item : (object)[];
    }

    public function getAll($page = 0, $numberofItems = 10) {
        $rs = self::defaultQuery();

        if ($page > 0){
            $page = ($page <= 0) ? 0 : $page - 1;
            $offset = $page * $numberofItems;
            $rs->take($numberofItems)->skip($offset);
        }

        $rs = $rs->get();
        $orgs = [];
        $i = 0;
        if (count($rs) > 0) {
            foreach ($rs as $item) {
                array_push($orgs, [
                    'number' => ++$i,
                    'id' => $item->id,
                    'name' => $item->name,
                    'phone' => $item->phone,
                    'email' => $item->email,
                    'website' => $item->website,
                    'logo' => $item->logo
                ]);
            }
        }

        return $orgs;
    }

    public function createOrg($name, $phone, $email, $website, $logo){
        $item = self::create([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'website' => $website,
            'logo' => $logo
        ]);
        return ($item) ? $item->id : false;
    }

    public function deleteOrg($id) {
        $update_item = self::defaultQuery()
            ->where('id', $id)
            ->update([
                'deleted_at' => Carbon::now()->toDateTimeString()
            ]);

        return ($update_item > 0) ? true : false;
    }
}
