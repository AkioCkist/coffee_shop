<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;

class Handler extends ExceptionHandler
{
    /**
     * Đăng ký các callback để xử lý exception trong toàn ứng dụng
     */
    public function register(): void
    {
        // 1️⃣ Ghi log tất cả lỗi phát sinh trong hệ thống trong 60s
        $this->reportable(function (Throwable $e) {
            $throttleKey = 'exception:' . md5(get_class($e) . '|' . $e->getMessage() . '|' . $e->getFile() . '|' . $e->getLine());
            $throttleSeconds = 60;

            if (!Cache::has($throttleKey)) {
                Log::error('🔥 Global Exception Caught', [
                    'type' => get_class($e),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                ]);
                Cache::put($throttleKey, true, $throttleSeconds);
            }
        });

        // 2️⃣ Render lỗi trả về cho Client
        $this->renderable(function (Throwable $e, Request $request) {
            $trackingId = uniqid('ERR_');

            // 🔸 Xử lý riêng lỗi Validation (422)
            if ($e instanceof ValidationException) {
                $errors = $e->errors();

                if ($request->expectsJson()) {
                    return new JsonResponse([
                        'success' => false,
                        'error' => [
                            'tracking_id' => $trackingId,
                            'type' => 'ValidationError',
                            'message' => 'The given data was invalid.',
                            'details' => $errors,
                        ]
                    ], 422);
                }

                return response()->view('errors.validation', [
                    'tracking_id' => $trackingId,
                    'errors' => $errors,
                ], 422);
            }

            // 🔸 Xử lý riêng lỗi 404 (Not Found)
            if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
                if ($request->expectsJson()) {
                    return new JsonResponse([
                        'success' => false,
                        'error' => [
                            'tracking_id' => $trackingId,
                            'type' => 'NotFound',
                            'message' => 'The requested resource was not found.',
                        ]
                    ], 404);
                }

                return response()->view('errors.404', [
                    'tracking_id' => $trackingId,
                ], 404);
            }

            // 🔸 Xử lý mặc định các lỗi khác
            if ($request->expectsJson()) {
                return new JsonResponse([
                    'success' => false,
                    'error' => [
                        'tracking_id' => $trackingId,
                        'type' => class_basename($e),
                        'message' => $e->getMessage(),
                    ],
                ], 500);
            }

            return response()->view('errors.general', [
                'tracking_id' => $trackingId,
                'errorMessage' => $e->getMessage(),
            ], 500);
        });
    }


    /**
     * Xác định log level tương ứng cho từng Exception
     */
    public function level($type, $level)
    {
        if ($type instanceof ValidationException) {
            return 'warning';
        }
        if ($type instanceof AuthenticationException) {
            return 'notice';
        }
        if ($type instanceof NotFoundHttpException) {
            return 'info';
        }
        if ($type instanceof QueryException) {
            return 'critical';
        }
        return $level ?? 'error';
    }
    /**
     * Cung cấp Global Context cho tất cả log trong ứng dụng.
     *
     * Laravel sẽ tự động thêm các dữ liệu này vào mỗi log message.
     */
    protected function context(): array
    {
        try {
            return array_filter([
                'user_id' => Auth::id(),
                'ip' => Request::ip(),
                'url' => Request::fullUrl(),
                'method' => Request::method(),
                'env' => app()->environment(),
                'timestamp' => now()->toDateTimeString(),
            ]);
        } catch (Throwable $e) {
            // Nếu xảy ra lỗi khi lấy context (ví dụ trong CLI)
            return [];
        }
    }
}
