<?php
namespace culturePnPsu\reserveCar\models;

use Yii;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class FormSearch extends \yii\base\Model
{
    public $year;

    public function rules()
    {
        return [
           
            // define validation rules here
        ];
    }
    
    public function attributeLabels() {
        return [
            'year'=>'ประจำปี',
            // define validation rules here
        ];
    }
    public static function getYear() {
        $current_year = date('Y');
        $to_year =date('Y', strtotime('-5 years'));
        $current_year_th = $current_year+543;
        $to_year_th =$to_year+543;
        return array_combine(range($to_year,$current_year),range($to_year_th,$current_year_th));
    }
    
    
}
