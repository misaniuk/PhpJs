<?php
namespace phpJs;

use Yii;
use yii\base\Exception;
use yii\web\View;


class PhpJs
{
    public function __construct()
    {
        $aliases = Yii::$aliases;
        $json_aliases = json_encode($aliases);
        Yii::$app->view->registerJs("
        phpjs = {aliases:{},data:{}};
        phpjs.aliases = {$json_aliases};
        ",View::POS_BEGIN);
    }


    public function add($params)
    {


        /**
         * for @array value
         */
        if(is_array($params))
        {
            $jsString = "";
            foreach($params as $key=>$value)
            {
                $jsString.="phpjs.data.$key = '$value';";
            }
            Yii::$app->view->registerJs($jsString,View::POS_BEGIN);
        }



        /**
         * for @object value
         */
        else if(is_object($params))
        {
            $jsString = "";
            foreach($params as $key=>$value)
            {
                $jsString.="phpjs.$key = $value;";
            }
            Yii::$app->view->registerJs($jsString,View::POS_BEGIN);
        }



        /**
         * for @string value
         */
        else if(is_string($params))
        {

        }



        else
        {
            throw new Exception("Param must be string, array or class obect");
        }

    }




}


?>