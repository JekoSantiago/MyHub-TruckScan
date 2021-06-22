<?php

namespace App\Http\Controllers;

use App\Common;
use Illuminate\Http\Request;
use App\UserDetails;
use Illuminate\Support\Facades\Session;
use App\Helper\MyHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Throwable;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use Laracasts\Utilities\JavaScript;

class AuthController extends Controller
{
    public function index()
    {

        try
        {
            $userEmpID= MyHelper::decryptMYHUB($_COOKIE['Usr_ID']);
        }
        catch (Throwable $e)
        {

            abort(500);

        }


        $userDetails = UserDetails::getUserDetails($userEmpID);


        if(count($userDetails) > 0)
        {
            $data['moduleRoleID'] = 0;
            $data['appID']        = env('APP_ID');
            $data['moduleID']     = 0;
            $data['roleID']       = $userDetails[0]->Role_ID;

            $userAccess = Common::getUserModuleRole($data);
            $sessionAccess =[];
            foreach($userAccess as $access):
                array_push($sessionAccess,array(
                'Module_ID'=>$access->Module_ID,
                'Action_ID'=>$access->Action_ID,
                'ActionName'=>$access->ActionName));
            endforeach;


                Session::put('UserAccess',       $sessionAccess);
                Session::put('Employee_ID',      MyHelper::encrypt($userDetails[0]->Emp_ID));
                Session::put('EmployeeNo',       MyHelper::encrypt($userDetails[0]->EmployeeNo));
                Session::put('FullName',         MyHelper::encrypt($userDetails[0]->empl_name));
                Session::put('Role_ID',          MyHelper::encrypt($userDetails[0]->Role_ID));
                Session::put('Department_ID',    MyHelper::encrypt($userDetails[0]->Department_ID));
                Session::put('Department',       MyHelper::encrypt($userDetails[0]->Department));
                Session::put('Email',            MyHelper::encrypt($userDetails[0]->Email));
                Session::put('Location_ID',      MyHelper::encrypt($userDetails[0]->Location_ID));
                Session::put('Location',         MyHelper::encrypt($userDetails[0]->Location));
                Session::put('SLocation',         MyHelper::encrypt($userDetails[0]->SLocation_ID));
                Session::save();


            return view('pages.index');
            }
            else
            {
            return  redirect('/error/401');
            }


    }
    public function logout()
    {
        Artisan::call('cache:clear');
        return  Redirect::to(env('MYHUB_LOGOUT_URL'));
    }
}
