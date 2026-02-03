<?php

namespace App\Enums;

enum StatusEnum: string
{
    case PENDING = 'pending';
    case SUCCESS = 'success';
    case FAILED = 'failed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'В ожидании',
            self::SUCCESS => 'Успешно',
            self::FAILED => 'Ошибка',
        };
    }
}
