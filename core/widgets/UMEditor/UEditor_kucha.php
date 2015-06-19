<?php

namespace app\core\widgets\UEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\InputWidget;

class UEditor extends InputWidget{

    public $clientOptions = [];//����ѡ�����Ueditor�����ĵ�(���Ʋ˵���)

    //Ĭ������
    protected $_options;

    public function init() {
        $this->id = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->id;
        $this->_options = [
            'serverUrl' => Url::to(['upload']),
            'initialFrameWidth' => '100%',
            'initialFrameHeight' => '400',
            'lang' => (strtolower(\Yii::$app->language) == 'en-us') ? 'en' : 'zh-cn',
        ];
        $this->clientOptions = ArrayHelper::merge($this->_options, $this->clientOptions);
        parent::init();
    }

    public function run() {
        $this->registerClientScript();
        if ($this->hasModel()) {
            return Html::activeTextarea($this->model, $this->attribute, ['id' => $this->id]);
        } else {
            return Html::textarea($this->id, $this->value, ['id' => $this->id]);
        }
    }

    //ע��ͻ��˽ű�
    protected function registerClientScript() {
        UEditorAsset::register($this->view);
        $clientOptions  = Json::encode($this->clientOptions);
        print_r($clientOptions);
        $script = "var ue = UE.getEditor('" . $this->id . "', " . $clientOptions . ")";
        print_r($script);
        $this->view->registerJs($script, View::POS_READY);
    }
} 