<?php

namespace App;

use App\Helper\MyHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Common extends Model
{
    public static function getUserModuleRole($data)
    {
        $moduleRoleID     = $data['moduleRoleID'];
        $appID            = $data['appID'];
        $moduleID         = $data['moduleID'];
        $roleID           = $data['roleID'];

        $result = DB::select('UserMgt.dbo.sp_User_ModuleRole_Get ?,?,?,?', [$moduleRoleID,$appID,$moduleID,$roleID]);
        return $result;
    }

    public static function getDC()
    {
        $user = MyHelper::decrypt(Session::get('Employee_ID'));
        return DB::select('sp_DC_get ?',[$user]);

    }
    public static function getProvince($data)
    {

        $user = MyHelper::decrypt(Session::get('Employee_ID'));
        return DB::select('sp_DC_Province_get ?,?',[$data,$user]);

    }

    public static function getStore($data)
    {

        return DB::select('sp_DC_Store_get ?,?,?',$data);

    }
}
