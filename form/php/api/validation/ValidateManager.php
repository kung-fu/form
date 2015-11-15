<?php

include_once "Validator.php";

/**
 * Created by IntelliJ IDEA.
 * User: sugurusasaki
 * Date: 15/11/05
 * Time: 10:45
 */
class ValidateManager
{
    ///////////////////////////////////////////////////
    // PROPERTY
    ///////////////////////////////////////////////////
    private $_isSuccess = true;    // Validationフラグ
    private $_errors = array(
        "name" => "",
        "company_name" => "",
        "name_kana" => "",
        "mail" => "",
        //"contact_type" => "",
        "message" => ""
    );

    ///////////////////////////////////////////////////
    // METHOD
    ///////////////////////////////////////////////////
    /**
     * フラグを返す
     * @return bool
     */
    public function isSuccess(){
        return $this->_isSuccess;
    }

    /**
     * 電話番号判定
     * @param $data
     */
    public function isTel(&$data){
        if(!Validator::is_tel($data, "tel")){
            $this->_errors['tel'] = "お電話番号を入力してください。";
            $this->_isSuccess = false;
        }
        else {
            $this->_errors['tel'] = "";
        }
    }

    /**
     * エラー文言を返す
     * @return array
     */
    public function getErrors(){
        return $this->_errors;
    }

    /**
     * 名前の判定
     * @param $data
     */
    public function isName(&$data){
        if(!Validator::is_name($data, "name")){
            $this->_errors['name'] = "名前を入力してください。";
            $this->_isSuccess = false;
        }
    }

    /**
     * カナ判定
     * @param $data
     */
    public function isNameKana(&$data){
        if(!Validator::is_nameKana($data, "name_kana")) {
            $this->_errors['name_kana'] = "カタカナで入力してください。";
            $this->_isSuccess = false;
        }
    }

    /**
     * 企業名判定
     * @param $data
     */
    public function isCompany(&$data){
        if(!Validator::is_companyName($data, "company_name")){
            $this->_errors['company_name'] = "企業名を入力してください。";
            $this->_isSuccess = false;
        }
    }

    /**
     * メールアドレス判定
     * @param $data
     */
    public function isMail(&$data){
        if(!Validator::is_email($data, "mail")){
            $this->_errors['mail'] = "入力内容を確認してください。";
            $this->_isSuccess = false;
        }
    }

    /**
     * チェックボックス判定
     * @param $data
     */
    public function isType(&$data){
        if(!Validator::is_type($data, 'contact_type')){
            $this->_errors = array_merge($this->_errors, array('contact_type'=>'選択してください。'));
            $this->_isSuccess = false;
        }
        else {
            $this->_errors = array_merge($this->_errors, array('contact_type'=>''));
        }
    }

    /**
     * メッセージ判定
     * @param $data
     */
    public function isMessage(&$data){
        if(!Validator::is_comment($data, "message")){
            $this->_errors['message'] = "メッセージを入力してください。";
            $this->_isSuccess = false;
        }
    }

    /**
     * 応募種別を判定
     * @param $data
     */
    public function isCategory(&$data){
        if(!Validator::is_category($data, 'category')){
            $this->_errors = array_merge($this->_errors, array('category'=>'選択してください。'));
            $this->_isSuccess = false;
        }
        else {
            $this->_errors = array_merge($this->_errors, array('category'=>''));
        }
    }

    /**
     * 性別判定
     * @param $data
     */
    public function isSex(&$data){
        if(!Validator::is_sex($data, 'sex')){
            $this->_errors = array_merge($this->_errors, array('sex'=>'選択してください。'));
            $this->_isSuccess = false;
        }
        else {
            $this->_errors = array_merge($this->_errors, array('sex'=>''));
        }
    }

    /**
     * 年齢を入力してください。
     * @param $age
     */
    public function isAge(&$data){
        if(!Validator::is_age($data, 'age')){
            $this->_errors = array_merge($this->_errors, array('age'=>'年齢を入力してください。'));
            $this->_isSuccess = false;
        }
        else {
            $this->_errors = array_merge($this->_errors, array('age'=>''));
        }
    }



}
