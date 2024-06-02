<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var app\models\LoginForm $model */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Forgot Password ';
$this->params['breadcrumbs'][] = $this->title;
?>

<link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/vendor/css/pages/page-auth.css" />
    
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                <?= Html::img('@web/images/walletplus-icon.png', [
                  'alt' => 'Image',
                  'class' => 'w-px-40 h-auto',
                  'width' => '25'
                ]) ?>
                </span>
                <span class="app-brand-text demo text-body fw-bold">Sneat</span>
            </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Forgot Password? 🔒</h4>
            <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
            <form id="formAuthentication" class="mb-3" action="index.html">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                type="text"
                class="form-control"
                id="email"
                name="email"
                placeholder="Enter your email"
                autofocus />
            </div>
            <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
            </form>
            <div class="text-center">
            <a href="auth-login-basic.html" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Back to login
            </a>
            </div>
        </div>
        </div>
        <!-- /Forgot Password -->
    </div>
    </div>
</div>

