<?php

    namespace App\Response;

    use Illuminate\Http\Request;

    class Error
    {
        /**
         * @param $data
         * @param array $codeInternal
         * @param Request|null $request
         * @return bool|\Illuminate\Http\RedirectResponse|void
         */
        public function returnType($data, array $codeInternal, $routeType="web", $redirectNameRoute=null)
        {
            if($routeType=="web")
            {
                if($codeInternal["code"]==4000 && $data->fails())
                {
                    return back()
                        ->withInput()
                        ->withErrors($data)
                        ->with("error", $codeInternal["message"])
                        ->throwResponse();
                }
                elseif($redirectNameRoute==null)
                {
                    return back()
                        ->withInput()
                        ->withErrors($data)
                        ->with("error", $codeInternal["message"]);
                }
                else
                {
                    return redirect()->route($redirectNameRoute)
                        ->withInput()
                        ->withErrors($data)
                        ->with("error", $codeInternal["message"]);
                }
            }
            elseif($routeType=="api")
            {
                return response()->json([
                    'code'       => $codeInternal["code"],
                    'status'     => "error",
                    'message'    => $codeInternal["message"],
                    'data'       => $data,
                ])->throwResponse();
            }
            else
            {
                return true;
            }
        }

        /**
         * @param $data
         * @param array $codeInternal
         * @param Request|null $request
         * @return bool|\Illuminate\Http\RedirectResponse|void
         */
        public static function generic($data, array $codeInternal, $routeType="web", $redirectNameRoute=null)
        {
            return (new Error)->returnType($data, $codeInternal, $routeType, $redirectNameRoute);
        }

    }
