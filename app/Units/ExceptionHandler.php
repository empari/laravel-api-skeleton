<?php
namespace Skel\Units;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Http\Response;
use Symfony\Component\Debug\Exception\FlattenException;

class ExceptionHandler extends Handler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Prepare response Json
     *
     * @param string $message
     * @param int $code
     * @return array
     */
    public function prepareResponseJson($message = null, $code = 500)
    {
        return [
            'data' => [
                'error' => [
                    'code' => $code,
                    'message' => $message
                ]
            ]
        ];
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                $modelClass = explode('\\', $exception->getModel());

                return response()->json(
                    $this->prepareResponseJson(
                        trans('databases.not_found', ['modelClass' => end($modelClass)]),
                        Response::HTTP_NOT_FOUND
                    ),
                    Response::HTTP_NOT_FOUND
                );
            }

            // add outhers types of exceptions here
        }

        if ($exception instanceof \Empari\Support\Exceptions\Localization\LanguageNotSupportedException) {
            return response()->json(
                $this->prepareResponseJson(
                    trans('localization.language_not_supported'),
                    Response::HTTP_FORBIDDEN
                ),
                Response::HTTP_FORBIDDEN
            );
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(
            $this->prepareResponseJson(
                trans('auth.unauthenticated'),
                Response::HTTP_UNAUTHORIZED
            ),
            Response::HTTP_UNAUTHORIZED
        );
    }

    /**
     * Create a Symfony response for the given exception.
     *
     * @param  \Exception  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertExceptionToResponse(Exception $e)
    {
        $e = FlattenException::create($e);

        $error_response['code'] = $e->getStatusCode();
        $error_response['message'] = Response::$statusTexts[$e->getStatusCode()];

        if (config('app.debug')) {
            $error_response['exception'] = $e->getMessage();
            $error_response['class'] = $e->getClass();
            $error_response['file'] = $e->getFile();
            $error_response['line'] = $e->getLine();
            $error_response['trace'] = $e->getTrace();
        }

        return response()->json([
            'data' => [
                'error' => $error_response
            ]
        ], $e->getStatusCode());
    }
}
