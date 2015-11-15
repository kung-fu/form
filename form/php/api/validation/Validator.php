<?php

/**
 * Created by IntelliJ IDEA.
 * User: sugurusasaki
 * Date: 15/11/04
 * Time: 21:22
 */
class Validator
{

    /**
     * コメント判定
     *
     * @param $data
     * @param $id
     * @return bool
     */
    public static function is_comment(&$data, $id) {
        if(!isset($data[$id])) return false;
        return ( mb_strlen($data[$id]) > 0 ) ? true : false;
    }


    /**
     * 問い合わせ種別判定
     *
     * @param $type
     * @return bool
     */
    public static function is_type(&$data, $id) {
        if(!isset($data[$id])) return false;
        return ($data[$id] == "") ? false : true;
    }

    /**
     * メールアドレスの判定
     *
     * @param $data
     * @param $id
     * @param bool|true $strict
     * @return bool
     */
    public static  function is_email(&$data, $id, $strict = true) {
        if(!isset($data[$id])) return false;

        $email = $data[$id];

        $dot_string = $strict ?
            '(?:[A-Za-z0-9!#$%&*+=?^_`{|}~\'\\/-]|(?<!\\.|\\A)\\.(?!\\.|@))' :
            '(?:[A-Za-z0-9!#$%&*+=?^_`{|}~\'\\/.-])'
        ;
        $quoted_string = '(?:\\\\\\\\|\\\\"|\\\\?[A-Za-z0-9!#$%&*+=?^_`{|}~()<>[\\]:;@,. \'\\/-])';
        $ipv4_part = '(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])';
        $ipv6_part = '(?:[A-fa-f0-9]{1,4})';
        $fqdn_part = '(?:[A-Za-z](?:[A-Za-z0-9-]{0,61}?[A-Za-z0-9])?)';
        $ipv4 = "(?:(?:{$ipv4_part}\\.){3}{$ipv4_part})";
        $ipv6 = '(?:' .
            "(?:(?:{$ipv6_part}:){7}(?:{$ipv6_part}|:))" . '|' .
            "(?:(?:{$ipv6_part}:){6}(?::{$ipv6_part}|:{$ipv4}|:))" . '|' .
            "(?:(?:{$ipv6_part}:){5}(?:(?::{$ipv6_part}){1,2}|:{$ipv4}|:))" . '|' .
            "(?:(?:{$ipv6_part}:){4}(?:(?::{$ipv6_part}){1,3}|(?::{$ipv6_part})?:{$ipv4}|:))" . '|' .
            "(?:(?:{$ipv6_part}:){3}(?:(?::{$ipv6_part}){1,4}|(?::{$ipv6_part}){0,2}:{$ipv4}|:))" . '|' .
            "(?:(?:{$ipv6_part}:){2}(?:(?::{$ipv6_part}){1,5}|(?::{$ipv6_part}){0,3}:{$ipv4}|:))" . '|' .
            "(?:(?:{$ipv6_part}:){1}(?:(?::{$ipv6_part}){1,6}|(?::{$ipv6_part}){0,4}:{$ipv4}|:))" . '|' .
            "(?::(?:(?::{$ipv6_part}){1,7}|(?::{$ipv6_part}){0,5}:{$ipv4}|:))" .
            ')';
        $fqdn = "(?:(?:{$fqdn_part}\\.)+?{$fqdn_part})";
        $local = "({$dot_string}++|(\"){$quoted_string}++\")";
        $domain = "({$fqdn}|\\[{$ipv4}]|\\[{$ipv6}]|\\[{$fqdn}])";
        $pattern = "/\\A{$local}@{$domain}\\z/";
        return preg_match($pattern, $email, $matches) &&
        (
            !empty($matches[2]) && !isset($matches[1][66]) && !isset($matches[0][256]) ||
            !isset($matches[1][64]) && !isset($matches[0][254])
        );
    }

    /**
     * 企業名を判定
     * @param $text
     * @return bool
     */
    public static function is_companyName(&$data, $id){
        return isset($data[$id]) ? true : false;
    }

    /**
     * 名前を判定
     *
     * @param $text
     * @return bool
     */
    public static function is_name(&$data, $id){
        return isset($data[$id]) ? true : false;
    }


    /**
     * 名前のカナ判定
     *
     * @param $data
     * @param $id
     * @return bool
     */
    public static function is_nameKana(&$data, $id) {
        if(!isset($data[$id])) return false;

        if (preg_match("/^[ァ-ヶー]+$/u", $data[$id])) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 電話番号チェック
     *
     * @param $str
     * @return bool
     */
    public static function is_tel($data, $id) {
        if(!isset($data[$id])) return false;

        $str = $data[$id];

        //全角を半角に
        $str = mb_convert_kana($str,"a", "euc-jp");
        //半角または全角のハイフンは取り除く
        $str = mb_ereg_replace("-", "", $str);
        $str = mb_ereg_replace("ー", "", $str);
        $str = mb_ereg_replace("－", "", $str);

        //数字であり、かつ10桁もしくは9桁かチェック
        if(ctype_digit($str) AND (strlen($str) == 10 OR strlen($str)== 11)){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * カテゴリー判定(職種別)
     * @param $str
     * @return bool
     */
    public static function is_category(&$data, $id){
        return isset($data[$id]) ? true : false;
    }

    /**
     * 性別判定
     * @param $type
     * @return bool
     */
    public static function is_sex(&$data, $id){
        return isset($data[$id]) ? true : false;
    }

    /**
     * 年齢判定
     * @param $age
     * @return bool
     */
    public static function is_age(&$data, $id ) {
        if(!isset($data[$id])) return false;
        $age = mb_convert_kana($data[$id], "KVa");
        return ctype_digit ( $age );
    }


}