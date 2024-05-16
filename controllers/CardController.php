<?php

namespace app\controllers;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\AccessControl;
use app\models\Expense;
use app\models\ExpenseCategory;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use DateTime;
use Firebase\JWT\JWT;
use yii\db\Query;
use yii\web\UploadedFile;
use app\models\Customer;
use yii\web\Response;
use Intervention\Image\ImageManagerStatic as Image;
use app\models\Cards;

class CardController extends \yii\web\Controller
{   

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            
            if (!$user) {
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
        }
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['http://localhost:4200', 'https://secure.walletplus.in'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Max-Age' => 86400,
            ],
        ];
        return $behaviors;
    }
 

    public function actionGetList()
    {

        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            
            if ($user) {
                $cards = Cards::find()
                ->where(['id_customer' => $user->id])
                ->all();
                $response['list'] = $cards;
                $response['imagePath'] = 'https://walletplus.in/cards/';
        
                Yii::$app->response->statusCode = 200;
                return \yii\helpers\Json::encode($response);
                
            }else{
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
        }
        
    }


    public function actionGet()
    {
        $id = Yii::$app->request->get('id');
        $query = (new Query())
        ->select('*')
        ->from('bt_cards')
        ->where(['bt_cards.id_card' => $id]);
        $command = $query->createCommand();
        $data = $command->queryOne();
        $response['data'] = $data;
        $response['imagePath'] = 'https://walletplus.in/cards/';
        Yii::$app->response->statusCode = 200;
        return \yii\helpers\Json::encode($response);
    }





    public function actionAdd()
    {   

        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {
                
                    $data = Yii::$app->request->post();
                    $rawBody = Yii::$app->request->rawBody;
                    $data = json_decode($rawBody, true);
                    $newCard = new Cards();
                    $newCard->id_customer = $user->id;
                    $newCard->name =  Yii::$app->request->post('name'); 
                    // Handle the uploaded image
                    $imageFile = UploadedFile::getInstanceByName('image');
                    if ($imageFile) {
                        $uploadPath = Yii::getAlias('@webroot') . '/cards/';
                        $imageName = time() . '_' . $imageFile->baseName . '.' . $imageFile->extension;
                        $imageFile->saveAs($uploadPath . $imageName);

                        $image = Image::make($uploadPath . $imageName);
                        $image->encode('jpg', 70); 
                        $compressedImageName = 'wplus_' . $imageName;
                        $image->save($uploadPath . $compressedImageName);

                        $newCard->image = $compressedImageName;
                    }

                    if ($newCard->save()) {
                        Yii::$app->response->statusCode = 201; // Created status code
                        return \yii\helpers\Json::encode($newCard);
                    } else {
                        Yii::$app->response->statusCode = 422; // Unprocessable Entity status code
                        return \yii\helpers\Json::encode($newCard->getErrors());
                    }
            }else{
                Yii::$app->response->statusCode = 401;
                return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return \yii\helpers\Json::encode(['error' => 'UnAuthorized']);
        }

        
    }

    public function actionUpdate()
    {   
        $headers = Yii::$app->request->headers;
        if ($headers->has('Authorization')) {
            $authorizationHeader = $headers->get('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $user = Customer::find()->where(['authKey' => $token])->one();
            if ($user) {

                $id = Yii::$app->request->post('id');

                $rawBody = Yii::$app->request->rawBody;
                $data = json_decode($rawBody, true);
                $card = Cards::findOne($id);
                $card->name = Yii::$app->request->post('name'); 

               
                // Handle the uploaded image
                $imageFile = UploadedFile::getInstanceByName('image');
                if ($imageFile) {
                    $uploadPath = Yii::getAlias('@webroot') . '/cards/';
                    $imageName = time() . '_' . $imageFile->baseName . '.' . $imageFile->extension;
                    $imageFile->saveAs($uploadPath . $imageName);

                    $image = Image::make($uploadPath . $imageName);
                    $image->encode('jpg', 70); 
                    $compressedImageName = 'wplus_' . $imageName;
                    $image->save($uploadPath . $compressedImageName);

                    $card->image = $compressedImageName;
                }

                if ($card->save()) {
                    Yii::$app->response->statusCode = 201; // Created status code
                    return \yii\helpers\Json::encode($card);
                } else {
                    Yii::$app->response->statusCode = 422; // Unprocessable Entity status code
                    return \yii\helpers\Json::encode($card->getErrors());
                }
            }
        }
        
    }


    public function actionDelete()
    {   

        $rawBody = Yii::$app->request->rawBody;
        $data = json_decode($rawBody, true);

        $expense = Cards::findOne($data['id']);

        if ($expense) {
            // Delete the associated image file if it exists
            if($expense->image){
                $imagePath = Yii::getAlias('@webroot') . '/cards/' . $expense->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }    
            }
    
            if ($expense->delete()) {
                Yii::$app->response->statusCode = 204; // No Content status code
                return \yii\helpers\Json::encode(['message' => 'Card deleted successfully']);
            } else {
                Yii::$app->response->statusCode = 500; // Internal Server Error status code
                return \yii\helpers\Json::encode(['error' => 'Failed to delete card']);
            }
        } else {
            Yii::$app->response->statusCode = 404; // Not Found status code
            return \yii\helpers\Json::encode(['error' => 'Card not found']);
        }
    }



    public function beforeAction($action)
    {
        if (in_array($action->id, ['statistics', 'category-list', 'get', 'update','delete', 'get-list', 'add', 'suggestion'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

}