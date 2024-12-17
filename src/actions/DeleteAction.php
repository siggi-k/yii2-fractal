<?php

/**
 * @copyright Copyright (c) 2020 Insolita <webmaster100500@ya.ru> and contributors
 * @license https://github.com/insolita/yii2-fractal/blob/master/LICENSE
 */

namespace insolita\fractal\actions;

use Closure;
use Yii;
use yii\base\Model;
use yii\web\ForbiddenHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Handler for routes DELETE /resource/{id}
 *  With defined parentIdParam and parentIdAttribute Handler for  DELETE /resource/{parentId}/relation/{id} modelClass
 * should be defined for related model for this case
 **/
class DeleteAction extends JsonApiAction
{
    use HasParentAttributes;

    /**
     * @var string|callable
     * string - the scenario to be assigned to the model before it is validated and saved.
     * callable - a PHP callable that will be executed during the action.
     * It must return a string representing the scenario to be assigned to the model before it is validated and saved.
     *  The signature of the callable should be as follows,
     *  ```php
     *  function ($action, $model) {
     *      // $model is the requested model instance.
     *  }
     *  ```
     */
    public $scenario = Model::SCENARIO_DEFAULT;

    /**
     * @var callable|Closure Callback after save model with all relations
     * @example
     *   'afterDelete' => function ($model) {
     *           doSomething();
     * }
     */
    public $afterDelete = null;

    public function init():void
    {
        parent::init();
        $this->validateParentAttributes();
    }

    /**
     * @param int|string $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     * @throws \yii\web\ServerErrorHttpException
     */
    public function run($id):void
    {
        if ($this->hasResourceRelationships()) {
            /** @see https://jsonapi.org/format/#crud-updating-resource-relationships * */
            throw new ForbiddenHttpException('Update with relationships not supported yet');
        }
        $model = $this->isParentRestrictionRequired() ? $this->findModelForParent($id) : $this->findModel($id);
        $model->setScenario(is_callable($this->scenario) ?
            call_user_func($this->scenario, $this->id, $model) : $this->scenario
        );
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }
        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }
        if ($this->afterDelete !== null) {
            call_user_func($this->afterDelete, $model);
        }
        Yii::$app->getResponse()->setStatusCode(204);
    }
}
