<?php

namespace culturePnPsu\reserveCar;

/**
 * reserveCar module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'culturePnPsu\reserveCar\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->layout="left-menu";
        parent::init();

        // custom initialization code goes here
    }
}
