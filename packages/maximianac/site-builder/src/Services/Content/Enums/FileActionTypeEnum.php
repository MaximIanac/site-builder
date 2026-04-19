<?php

namespace Maximianac\SiteBuilder\Services\Content\Enums;

enum FileActionTypeEnum: string
{
    case EXISTING = 'existing';
    case NEW = 'new';
    case DELETED = 'deleted';
}
