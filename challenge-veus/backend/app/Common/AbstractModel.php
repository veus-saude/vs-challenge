<?php

namespace App\Common;

use App\Config\Configuration as cfg;
use App\Common\AdapterResults as result;
use App\Common\Json;

class AbstractModel
{

    private $data;
    private $rawData;
    private static $that;

    /**
     * Validate the inpute of request
     *
     * @since 1.0
     * @param \stdClass|array $data
     * @param string $jsonShemaFile
     * @return bool
     */
    public static function inputValidate($data, $jsonShemaFile)
    {
        $fullPath = base_path() . cfg::JSON_SCHEMA . cfg::DS;

        $jsonSchema = $fullPath . $jsonShemaFile;

        if (Json::validate($data, $jsonSchema)) {
            return true;
        }

        return false;
    }

    /**
     * Return the Response Object configured with common error
     *
     * @since 1.0
     * @param Response $response
     * @param \Exception $ex
     * @return Response
     */
    protected static function commonError(Response $response, \Exception $ex)
    {
        $data = [
            "message" => "Somethings are wrong",
            "status" => "error",
            "dev_error" => $ex->getMessage()
        ];

        return $response->withJson($data, 500);
    }

    /**
     * Verfify if one attribute exists into result set
     *
     * @since 1.0
     * @param mixed $name
     * @return bool
     */
    protected function attributeExists($name)
    {
        return isset($this->data, $name);
    }

    /**
     * Set the results
     *
     * @since 1.0
     * @param mixed $data
     */
    private function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Set the results
     *
     * @since 1.0
     * @param mixed $rawData
     */
    private function setRawData($rawData)
    {
        $this->rawData = $rawData;
    }

    /**
     * Adding new attributes into results for response
     *
     * @since 1.0
     * @param \stdClass $obj
     * @param array $elements
     * @param int $dataKey
     * @return \stdClass
     * @throws \Exception
     */
    private function addingAttribute(\stdClass $obj, array $elements, $dataKey)
    {
        foreach ($elements as $name => $value) {
            try {
                $obj->$name = is_callable($value) ? $value($this->rawData[$dataKey]) : $value;
            } catch (\Exception $ex) {
                throw new \Exception("Could not process attribute {$name}");
            }
        }
        return $obj;
    }

    /**
     * Initialize one new instance of AbstractModel
     * and configure it with the results of query
     *
     * @since 1.0
     * @param mixed $data
     * @return \App\System\AbstractModel
     */
    public static function outputValidate($data)
    {
        if (!self::$that) {
            self::$that = new AbstractModel;
        }

        self::$that->setData(result::adapter($data));
        self::$that->setRawData($data);

        return self::$that;
    }

    /**
     * Interface to adding new attributes into results
     *
     * @since 1.0
     * @param mixed $name
     * @param mixed $value
     * @param bool $inAllElements
     * @return \self
     * @throws \Exception
     */
    final public function withAttribute($name, $value = null, $inAllElements = false)
    {
        // insert or update one or more attributes into all elements
        if (is_array($this->data) && $inAllElements === true) {
            foreach ($this->data as $dataKey => $element) {
                if (is_array($name)) {
                    $element = $this->addingAttribute($element, $name, $dataKey);
                    continue;
                }
                if (!is_array($name) && is_callable($value)) {
                    $element->$name = $value($this->rawData[$dataKey]);
                    continue;
                }
                $element->$name = $value;
            }

            return $this;
        } else {
            if ($inAllElements === true) {
                throw new \Exception("The results is not an array");
            }
        }

        if (is_array($name)) {
            foreach ($name as $attributeKey => $attributeValue) {
                if (is_array($this->data)) {
                    $this->data[$attributeKey] = is_callable($attributeValue) ? $attributeValue($this->rawData) : $attributeValue;
                } else {
                    $this->data->$attributeKey = is_callable($attributeValue) ? $attributeValue($this->rawData) : $attributeValue;
                }
            }
            return $this;
        }

        if (is_array($this->data)) {
            $this->data[$name] = is_callable($value) ? $value($this->rawData) : $value;
        } else {
            $this->data->$name = is_callable($value) ? $value($this->rawData) : $value;
        }

        return $this;
    }

    /**
     * Remove one attribute of result
     *
     * @since 1.0
     * @param mixed $name
     * @return \self
     */
    final public function withoutAttribute($name)
    {

        // remove attributes when $name is a list (array) of attributes to be removed
        // remove attributes from root data value
        if (is_array($name)) {
            foreach ($name as $attribute) {
                if ($this->attributeExists($attribute)) {
                    unset($this->data->$attribute);
                }
            }
        }
        // remove attribute from root data value
        if (is_string($name) && $this->attributeExists($name)) {
            unset($this->data->$name);
        }
        // remove attributes from elements of data value
        if (is_array($this->data)) {
            foreach ($this->data as $value) {
                // remove just one attribute
                if (is_string($name) && isset($value->$name)) {
                    unset($value->$name);
                }
                // remove one or more attributes from elements of data value
                if (is_array($name)) {
                    foreach ($name as $attribute) {
                        if (is_string($attribute) && isset($value->$attribute)) {
                            unset($value->$attribute);
                        }
                    }
                }
            }
        }
        return $this;
    }

    /**
     * Return the configured results
     *
     * @since 1.0
     * @return mixed
     */
    final public function run()
    {
        return $this->data;
    }
}