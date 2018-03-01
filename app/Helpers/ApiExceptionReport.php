<?php
/**
 * Created by PhpStorm.
 * User: ZZT
 * Date: 2018/2/28
 * Time: 17:33
 */

namespace App\Helpers;
use Exception;
use Illuminate\Http\Request;

class ApiExceptionReport
{
    use ApiResponse;

    public $exception;
    /**
     * @var Request
     */
    public $request;

    /**
     * @var
     */
    protected $report;

    /**
     * ExceptionReport constructor.
     * @param Request $request
     * @param Exception $exception
     */
    function __construct(Request $request, Exception $exception)
    {
        $this->request = $request;
        $this->exception = $exception;
    }


    /**
     * @return bool
     */
    public function shouldReturn(){

        if ($this->request->wantsJson() || $this->request->ajax()){
            return true;
        }
        return false;

    }

    /**
     * @param Exception $e
     * @return static
     */
    public static function make(Exception $e){
        return new static(\request(),$e);
    }

    /**
     * @return mixed
     */
    public function report(){
        return $this->failed($this->exception->getMessage());
    }

}