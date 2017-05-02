<?php

namespace sirgalas\menu;
use Yii;

/**
 * transliter module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public static function t($message, $params = [], $language = null)
    {
        return Yii::t('sergalas/i18n', $message, $params, $language);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
