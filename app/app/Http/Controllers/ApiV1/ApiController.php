<?php

namespace App\Http\Controllers\ApiV1;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class ApiController extends Controller
{
    protected $select = "*";
    protected $query = NULL;
    protected $filter = [];
    protected $perPage = 10;

    protected $model;
    protected $transformer;
    protected $request;
    protected $input;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->input = collect($this->request->input());
    }

    protected function needsModel()
    {
        if (!$this->model) {
            $class = get_class($this);
            throw new Exception("$class não possui campo model.");
        }
    }

    protected function needsTransformer()
    {
        if (!$this->transformer) {
            $class = get_class($this);
            throw new Exception("$class não possui campo transformer.");
        }
    }

    protected function index() {
        $this->needsModel();
        $model = $this->model;

        $query = $this->model::select($this->select);

        if ($this->input->has('q')) {
            $q = $this->input->pull('q');

            $query = $query->where(function($query) use ($model, $q) {
                foreach ($this->model::$searchables as $attribute) {
                    $query = $query->orWhere($attribute, 'LIKE', "%". $q ."%");
                }
            });
        }

        if ($this->input->has('filter')) {
            $filters = explode(';', $this->input->pull('filter'));

            $query = $query->where(function($query) use ($model, $filters) {
                foreach ($filters as $filter) {
                    list($rel, $value) = explode(":", $filter);

                    if (isset($this->model::$filters[$rel])) {
                        $query->whereHas($rel, function($q) use ($rel, $value) {
                            $q->where($this->model::$filters[$rel], '=', $value);
                        });
                    }
                }
            });
        }

        if ($this->input->has('sort')) {
            $sorts = explode(';', $this->input->pull('sort'));

            foreach ($sorts as $sort) {
                list($sort_key, $order) = explode(":", $sort);

                if (in_array($sort_key, $this->model::$sortables)) {
                    $query->orderBy($sort_key, $order);
                }
            }
        }

        $object = $query->latest()->paginate($this->perPage);

        return $this->responseSucess($object);
    }

    protected function show($id) {
        $this->needsModel();

        $object = $this->model::find($id);

        return $object
            ? $this->responseSucess($object)
            : $this->responseNotFound();
    }

    protected function store() {
        $this->needsModel();

        $object = $this->model::create($this->request->input());

        return $object
            ? $this->responseSucess($object, NULL, 201)
            : $this->responseBad("Fail to create!");
    }

    protected function update($id) {
        $this->needsModel();

        $object = $this->model::find($id);

        if (!$object):
            return $this->responseNotFound();
        endif;

        $updated = $object->update($this->request->input());

        return $updated
            ? $this->responseSucess($object, "Updated!")
            : $this->responseBad("Fail to update!");
    }

    // OK
    protected function destroy($id) {
        $this->needsModel();

        $deleted_rows = $this->model::destroy($id);

        return $deleted_rows > 0
            ? $this->responseSucess([], "Deleted!")
            : $this->responseNotFound();
    }

    protected function responseSucess($data = [], $message = NULL, $code = 200) {
        $response = ['sucess' => true];

        if ($data) {
            $response['data'] = $data;
        }

        if ($message) {
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }

    protected function responseNotFound() {
        return $this->responseBad("Not Found!", 404);
    }

    protected function responseBad($message, $code = 400) {
        return response()->json(['sucess' => false, 'message' => $message], $code);
    }
}
