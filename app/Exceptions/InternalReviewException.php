<?php

namespace App\Exceptions;

use Exception;

/**
 * Исключение для разных "внутренних" ошибок
 * Class InternalReviewException
 * @package App\Exceptions
 */
class InternalReviewException extends Exception
{
    protected $message = "Внутренняя ошибка сервера.";
}