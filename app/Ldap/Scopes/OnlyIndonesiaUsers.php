<?php

namespace App\Ldap\Scopes;

use LdapRecord\Models\Model;
use LdapRecord\Models\Scope;
use LdapRecord\Query\Model\Builder;

class OnlyIndonesiaUsers implements Scope
{
    /**
     * Apply the scope to the given query.
     */
    public function apply(Builder $query, Model $model): void
    {
        $query->in('ou=Indonesian,DC=archimining,DC=local');
    }
}
