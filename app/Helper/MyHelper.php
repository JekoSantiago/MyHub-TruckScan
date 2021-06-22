<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
class MyHelper
{
    public static function errorMessages($return)
    {
        $error = array(

            -1 => 'Error adding new log',
            -2 => '',
            -3 => '',
            -4 => 'Employee do not exists',
            -5 => '',
            -6 => '',
            -7 => '',
            -8 => '',
            -9 => '',
            -10 => '',

        );

        //$result = 'Database or Server error. (Error Code: ' . $num . ')';

        if(!empty($error[$return])) :
            $result = $error[$return] . ' (Error Code: ' . $return . ')';
        else :
            $result = 'Database Error. (Error Code: ' . $return . ')';
        endif;

        return $result;
    }
    public static function decryptMyHUB($data)
    {
        $password = 'atp_dev';

        $method = 'aes-256-cbc';
        // Must be exact 32 chars (256 bit)
        $$password = substr(hash('sha256', $password, true), 0, 32);
        // IV must be exact 16 chars (128 bit)
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
                  chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
                  chr(0x0) .chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
                  chr(0x0);

          // av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
          $decrypted = openssl_decrypt(base64_decode($data), $method, $password, OPENSSL_RAW_DATA, $iv);

        return $decrypted;
    }

    public static function decrypt($data)
    {
      $hashKey = 'atp_dev';

      $METHOD = 'aes-256-cbc';
      $IV = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
      $key = substr(hash('sha256', $hashKey, true), 0, 32);
      $decrypted = openssl_decrypt(base64_decode($data),$METHOD, $key, OPENSSL_RAW_DATA, $IV);

      return $decrypted;
    }


    public static function buildJsonTable($count, $encode)
    {
        $draw = request()->input('draw');
        $start = request()->input('start');
        $length = request()->input('length');
        $pageSize = ($length != null ? $length :0);
        $skip = ($start != null ? $start : 0);
        $recordsTotal = $count;
        $data = array_slice($encode, $skip, $pageSize);

        return '{"draw":"'.$draw.'","recordsFiltered":'.$recordsTotal.',"recordsTotal":'.$recordsTotal.',"data":'.json_encode($data).'}';
    }


    public static function encrypt($data)
    {
      $hashKey = 'atp_dev';

      $METHOD = 'aes-256-cbc';
      $IV = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
      $key = substr(hash('sha256', $hashKey, true), 0, 32);
      $encrypt= base64_encode(openssl_encrypt($data,$METHOD,$key, OPENSSL_RAW_DATA, $IV));

      return $encrypt;
    }


    public static function checkUserAccess($data,$actionIDs)
    {
      if(is_array($actionIDs)):
        foreach($data['userAccess'] as $access):
          if($access['Module_ID'] == $data['moduleID'] && $access['Action_ID'] == 1):
             return true;
          endif;
          if($access['Module_ID'] == $data['moduleID']):
            if(in_array($access['Action_ID'], $actionIDs)):
              return true;
            endif;
          endif;
        endforeach;
      else:
        foreach($data['userAccess'] as $access):
          if($access['Module_ID'] == $data['moduleID'] && $access['Action_ID'] == 1):
            return true;
          endif;
          if($access['Action_ID']  ==  $actionIDs &&
              $access['Module_ID'] == $data['moduleID']):
            return true;
          endif;
        endforeach;
      endif;
      return false;
    }

    public static function getTime()
    {
       $datetime= Carbon::now();
       $time = $datetime->toTimeString();
       return $time;
    }

    public static function check5pm()
    {
        $now = Carbon::now();

        $start = Carbon::createFromTimeString('05:00');
        $end = Carbon::createFromTimeString('17:00');
        if($now->between($start, $end))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}



