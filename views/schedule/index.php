<?php

use app\models\Schedule;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ScheduleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Schedules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Schedule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php 
        $events = array();
    //Testing
    $Event = new \yii2fullcalendar\models\Event();
    $Event->id = 1;
    $Event->title = 'Testing';
    $Event->start = date('Y-m-d\TH:i:s\Z');
    $Event->nonstandard = [
        'field1' => 'Something I want to be included in object #1',
        'field2' => 'Something I want to be included in object #2',
    ];
    $events[] = $Event;

    $Event = new \yii2fullcalendar\models\Event();
    $Event->id = 2;
    $Event->title = 'Testing';
    $Event->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 6am'));
    $events[] = $Event;

    ?>

    <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
        'events'=> $events,
    )); 
  ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'lesson_id',
            'group_id',
            'dateStart',
            'dateEnd',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Schedule $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
