<?php

namespace app\core\widgets\UEditor;
use app\core\base\BaseWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\InputWidget;
use yii\web\View;

class UEditor extends InputWidget{
    public $editorConfig = [];//����umeditor.config.js�����ò���
    public $_options;
    public function init() {
        $this->_options = [
            'initialFrameWidth' => '100%',
            'initialFrameHeight' => '400',
            'lang' => (strtolower(\Yii::$app->language) == 'en-us') ? 'en' : 'zh-cn',
        ];
        $this->editorConfig = count($this->editorConfig)>0 ? ArrayHelper::merge($this->_options, $this->_options) : $this->_options;
        //����UEditor��Ҫ�ľ�̬�ű�
        $this->registerClickScript();
        //UEditor��ʼ��js�ű�
        //$this->registerScript();
    }

    /**
     * ����UEditor��Ҫ�ľ�̬�ű�
     */
    public function registerClickScript()
    {
        $view = $this->getView();
        //ʹ��ͬnamespace �µ�UEditorAsset AssetBundle������ ����UEditor�ͻ��˽ű�
        UEditorAsset::register($view);

    }

    /**
     * ��ʼ��js�ű�
     */
    public function registerScript(){
        $id = $this->getId(); //��ȡ�Ҽ�id
        $options = [
            'id'=>$id,
            'type'=>'text/plain',
        ];
        $js = '';
        //��ʼ���ٶȱ༭�����ò���
        foreach($this->editorConfig as $key=>$value){
            $key = trim($key);
            $js .= "window.UMEDITOR_CONFIG.{$key}='{$value}';";
        }
        //�ٶȱ༭����ʼ���ű�
        $js .= "var um = UM.getEditor('{$id}');";
        //��ҳ����������ʼ���ű�
        $this->getView()->registerJs($js,View::POS_END);
        //echo Html::tag('script',null,$options);//������run�����滻��
    }

    public function run() {
        $this->registerScript();
        if ($this->hasModel()) {
            return Html::activeTextarea($this->model, $this->attribute, ['id' => $this->id]);
        } else {
            return Html::textarea($this->id, $this->value, ['id' => $this->id]);
        }
    }

} 