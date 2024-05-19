<?php
use yii\helpers\Url;
?>
<!-- plugins:js -->
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/vendors/chart.js/Chart.min.js"></script>
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/js/dataTables.select.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/js/off-canvas.js"></script>
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/js/hoverable-collapse.js"></script>
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/js/template.js"></script>
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/js/settings.js"></script>
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/js/dashboard.js"></script>
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/js/Chart.roundedBarCharts.js"></script>
<!-- End custom js for this page-->