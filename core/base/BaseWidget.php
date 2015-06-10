<?php


namespace app\core\base;


use app\core\widgets\UEditor\UEditorAsset;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;

class BaseWidget extends Widget{

    //���հٶȱ༭�� umeditor.config.js�����ò���
    public $editorConfig = [];

    public function init() {
        //����UEditor��Ҫ�ľ�̬�ű�
        $this->registerClickScript();
        //��ʼ��js�ű�
        $this->registerScript();
    }

    //����UEditor��Ҫ�ľ�̬�ű�
    public function registerClickScript() {
        $view = $this->getView();
        //ʹ��ͬnamespace �µ�UEditorAsset AssetBundle������ ����UEditor�ͻ��˽ű�
        UEditorAsset::register($view);
    }

    //��ʼ���ű�
    public function registerScript() {
        $id = $this->getId();//��ȡ�Ҽ�id
        $options = [
            'id' => $id,
            'type' => 'text/plain'
        ];
        $js = '';
        //��ʼ���ٶȱ༭�����ò���
        if (count($this->editorConfig) > 0) {
            foreach ($this->editorConfig as $k => $v) {
                $k = trim($k);
                $js.="window.UMEDITOR_CONFIG.{$key}='{$value}';";
            }
        }
        //�ٶȱ༭����ʼ���ű�
        $js .= "var um = UM.getEditor('{$id}')";
        //��ҳ����������ʼ���ű�
        $this->getView()->registerJs($js, View::POS_END);
        echo Html::tag('script', null, $options);
    }
}