<?php

function mysub($str,$sta,$end,$t=0){
    /* 0:不包含首尾、1:包含头、2:包含巴、3:包含首尾 */
    $start=stripos($str,$sta);
    if($start!==false){
        if($t==0||$t==2){$start+=strlen($sta);}
        $length=stripos($str,$end,$start);
        if($length){
            $length-=$start;if($t==2||$t==3){$length+=strlen($end);}
            return substr($str,$start,$length);
        }
    }
    return false;
}

function tihuan_1($str)
{
    $encrypt_key = 'ab1cd2ef3gh4ij5kl6mn7op8qr9st0uvwxyz';
    $decrypt_key = 'iefakubzh30jx7g8rm4nqcvd95plw12yost6';
    $enter = '';
    if (strlen($str) == 0) return false;
    for ($i = 0; $i < strlen($str); $i++) {
        for ($j = 0; $j < strlen($decrypt_key); $j++) {
            if ($str[$i] == $decrypt_key[$j]) {
                $enter .= $encrypt_key[$j];
                break;
            }
        }
    }
    return $enter;
}

function tihuan_2($str)
{
    $encrypt_key = 'iefakubzh30jx7g8rm4nqcvd95plw12yost6';
    $decrypt_key = 'ab1cd2ef3gh4ij5kl6mn7op8qr9st0uvwxyz';
    $enter = '';
    if (strlen($str) == 0) return false;
    for ($i = 0; $i < strlen($str); $i++) {
        for ($j = 0; $j < strlen($decrypt_key); $j++) {
            if ($str[$i] == $decrypt_key[$j]) {
                $enter .= $encrypt_key[$j];
                break;
            }
        }
    }
    return $enter;
}

function jiaohuan_1($str, $num)
{
    $arr = str_split($str);
    $len = count($arr);
    $amount = ceil($len / $num);
    $str = array();
    for ($i = 0; $i < $amount; $i++) {
        $str[] = implode('', array_slice($arr, $i * $num, $num));
    }
    return implode('', array_reverse($str));
}

function jiaohuan_2($str, $num)
{
    $arr = array_reverse(str_split($str));
    $amount = ceil(count($arr) / $num);
    $str = '';
    for ($i = 0; $i < $amount; $i++) {
        $str .= implode('', array_reverse(array_slice($arr, $i * $num, $num)));
    }
    return $str;
}
