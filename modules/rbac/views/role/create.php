<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\modules\rbac\models\Permission */
$this->title = 'Create Role';
$this->params['breadcrumbs'][] = ['label' => 'Role', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-create">

    <?= $this->render('_form', [
        'model' => $model,
        'permissions'=>$permissions
    ]) ?>

</div>