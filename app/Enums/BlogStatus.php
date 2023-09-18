<?php

namespace App\Enums;

class BlogStatus
{
    const PENDING = 1;
    const PUBLISHED = 2;
    const REJECTED = 3;
    const DRAFT = 4;

    public static function getStatusName($status)
    {
        switch ($status) {
            case self::PENDING:
                return 'PENDING';
            case self::PUBLISHED:
                return 'PUBLISHED';
            case self::REJECTED:
                return 'REJECTED';
            case self::DRAFT:
                return 'DRAFT';
            default:
                return 'UNKNOWN';
        }
    }
}
