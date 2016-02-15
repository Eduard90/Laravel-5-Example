<?php

namespace App\Exceptions;

use Exception;

/**
 * Исключение если к товару уже написан отзыв
 * Class AlreadyReviewException
 * @package App\Exceptions
 */
class AlreadyReviewException extends Exception
{
    protected $message = "Вы уже писали отзыв для данного товара..";
}