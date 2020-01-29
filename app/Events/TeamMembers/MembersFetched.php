<?php

namespace App\Events\TeamMembers;

use App\Events\DashboardEvent;

class MembersFetched extends DashboardEvent
{
    /** @var array */
    public $teamMembers;

    public function __construct(array $teamMembers)
    {
        $this->teamMembers = $teamMembers;
    }
}
