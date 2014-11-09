<?php

/**
 * @copyright Copyright &copy; Pavels Radajevs <pavlinter@gmail.com>, 2014
 * @package yii2-adm
 */

namespace pavlinter\adm\filters;

use pavlinter\adm\Adm;
use Yii;
use yii\di\Instance;
use yii\web\User;


class AccessControl extends \yii\filters\AccessControl
{
    /**
     * Initializes the [[rules]] array by instantiating rule objects from configurations.
     */
    public function init()
    {
        if ($this->user === null) {
            $this->user = Adm::getInstance()->user;
        }
        $this->user = Instance::ensure($this->user, User::className());
        foreach ($this->rules as $i => $rule) {
            if (is_array($rule)) {
                $this->rules[$i] = Yii::createObject(array_merge($this->ruleConfig, $rule));
            }
        }
    }
}