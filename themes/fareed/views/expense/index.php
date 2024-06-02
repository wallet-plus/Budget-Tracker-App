<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Expenses');
$this->params['breadcrumbs'][] = $this->title;
?>
 

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light"><?= Html::encode($this->title) ?>/</span> <?= Html::encode($this->title) ?></h4>

  <!-- Basic Layout & Basic with Icons -->
  <div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
      <div class="card mb-4">

      <?php if (Yii::$app->session->hasFlash('success') || Yii::$app->session->hasFlash('error') ) { ?> 
        <div class="card-body">
          <?php if (Yii::$app->session->hasFlash('success')): ?>
              <div class="alert alert-success alert-dismissible" role="alert">
                  <?= Yii::$app->session->getFlash('success') ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          <?php endif; ?>

          <?php if (Yii::$app->session->hasFlash('error')): ?>
              <div class="alert alert-danger alert-dismissible" role="alert">
                  <?= Yii::$app->session->getFlash('error') ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          <?php endif; ?>
        </div>
        <?php } ?>

        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
          <small class="text-muted float-end">
          <?= Html::a(Yii::t('app', ' <button type="button" class="btn btn-primary">
              <span class="tf-icons bx bx-pie-chart-alt me-1"></span>Add Expense
            </button>'), ['create'], ['class' => 'btn']) ?>           
          </small>
        </div>


        <div class="card-body">
          <div class="table-responsive text-nowrap">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'expense_name',
                    'amount',
                    'date_of_transaction',
                    [
                        'class' => ActionColumn::className(),
                        'template' => '{update} {delete}',
                        'urlCreator' => function ($action, \app\models\Expense $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id_expense' => $model->id_expense]);
                        }
                    ],
                ],
                'tableOptions' => ['class' => 'table table-hover'],
            ]); ?>

            <!-- <table class="table table-hover">
              <thead>
                <tr>
                  <th>Project</th>
                  <th>Client</th>
                  <th>Users</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                <tr>
                  <td>
                    <i class="bx bxl-angular bx-sm text-danger me-3"></i>
                    <span class="fw-medium">Angular Project</span>
                  </td>
                  <td>Albert Cook</td>
                  <td>
                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up" title="Lilian Fuller">
                        <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/img/avatars/5.png" alt="Avatar"
                          class="rounded-circle" />
                      </li>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                        <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/img/avatars/6.png" alt="Avatar"
                          class="rounded-circle" />
                      </li>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up" title="Christina Parker">
                        <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/img/avatars/7.png" alt="Avatar"
                          class="rounded-circle" />
                      </li>
                    </ul>
                  </td>
                  <td><span class="badge bg-label-primary me-1">Active</span></td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <i class="bx bxl-react bx-sm text-info me-3"></i> <span class="fw-medium">React Project</span>
                  </td>
                  <td>Barry Hunter</td>
                  <td>
                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up" title="Lilian Fuller">
                        <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/img/avatars/5.png" alt="Avatar"
                          class="rounded-circle" />
                      </li>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                        <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/img/avatars/6.png" alt="Avatar"
                          class="rounded-circle" />
                      </li>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up" title="Christina Parker">
                        <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/img/avatars/7.png" alt="Avatar"
                          class="rounded-circle" />
                      </li>
                    </ul>
                  </td>
                  <td><span class="badge bg-label-success me-1">Completed</span></td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <i class="bx bxl-vuejs bx-sm text-success me-3"></i>
                    <span class="fw-medium">VueJs Project</span>
                  </td>
                  <td>Trevor Baker</td>
                  <td>
                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up" title="Lilian Fuller">
                        <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/img/avatars/5.png" alt="Avatar"
                          class="rounded-circle" />
                      </li>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                        <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/img/avatars/6.png" alt="Avatar"
                          class="rounded-circle" />
                      </li>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up" title="Christina Parker">
                        <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/img/avatars/7.png" alt="Avatar"
                          class="rounded-circle" />
                      </li>
                    </ul>
                  </td>
                  <td><span class="badge bg-label-info me-1">Scheduled</span></td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <i class="bx bxl-bootstrap bx-sm text-primary me-3"></i>
                    <span class="fw-medium">Bootstrap Project</span>
                  </td>
                  <td>Jerry Milton</td>
                  <td>
                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up" title="Lilian Fuller">
                        <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/img/avatars/5.png" alt="Avatar"
                          class="rounded-circle" />
                      </li>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                        <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/img/avatars/6.png" alt="Avatar"
                          class="rounded-circle" />
                      </li>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up" title="Christina Parker">
                        <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/img/avatars/7.png" alt="Avatar"
                          class="rounded-circle" />
                      </li>
                    </ul>
                  </td>
                  <td><span class="badge bg-label-warning me-1">Pending</span></td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table> -->
          </div>
        </div>

      </div>
    </div>

  </div>
</div>


