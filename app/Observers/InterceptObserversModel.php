<?php

    namespace App\Observers;

    use App\Response\Error;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    /**
     * Class InterceptObserversModel
     * @package App\Observers
     */
    class InterceptObserversModel
    {

        /**
         * @var Request
         */
        protected $request;

        /**
         * InterceptObserversModel constructor.
         * @param Request|null $request
         */
        public function __construct(Request $request=null)
        {
            $this->request = $request;
        }

        /**
         * @param $validator
         * @param Request $request
         * @return bool|\Illuminate\Http\RedirectResponse|void
         */
        public function returnType($validator)
        {
            if($this->request->routeType=="api")
            {
                return response()->json([
                    'code'       => 301,
                    'status'     => "error",
                    'message'    => "Validação de Campos não passou!!",
                    'data'       => $validator->errors(),
                ], 301)->throwResponse();
            }
            if($this->request->routeType=="web")
            {
                return Error::generic(
                    $validator,
                    messageErrors(4000, "Validação"),
                    "web"
                );
            }
            return true;
        }

        /**
         * @param $model
         * @param $method
         * @return bool|\Illuminate\Http\RedirectResponse|void
         */
        public function validationFields($model, $method)
        {
            if(isset($model::$rules[$method]) &&  isset($this->request) && $this->request!=[])
            {
                $rules = [];
                $validator = Validator::make($this->request->all(), $model::$rules[$method]);
                if($validator->fails())
                {
                    return $this->returnType($validator);
                }
            }
            return true;
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function creating(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function created(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function saving(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function saved(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function updating(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function updated(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function retrieved(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function deleting(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function deleted(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function restoring(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function restored(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

    }
