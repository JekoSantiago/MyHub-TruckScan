<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class UserDetails extends Model
{
    /**
     * Get User Details
     */
    public static function getUserDetails($id)
    {
        $result = DB::select('UserMgt.dbo.sp_User_Get ?', [$id]);

        return $result;
    }
}




