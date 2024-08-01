<?php

namespace App\Enums;

enum OrderStatus: int
{
    case ACCEPTED = 1;
    case PREPARED = 2;
    case SENT = 3;
    case DELIVERED = 4;
    case REJECTED = 5;

    public function label(): string
    {
        return match ($this) {
            self::ACCEPTED => 'Yeni sfariş',
            self::PREPARED => 'Hazırlanır',
            self::SENT => 'Göndərildi',
            self::DELIVERED => 'Təhvil verildi',
            self::REJECTED => 'Ləğv edildi',
        };
    }


    public static function fromValue(int $value): self
    {
        return self::from($value);
    }

}

