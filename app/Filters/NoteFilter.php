<?php

namespace App\Filters;

class NoteFilter extends ApiFilter
{

    protected $safeParms = [
        'user_id' => ['eq'],
        'title' => ['search'],
        'content' => ['search'],
        'category' => ['eq'],
        'created_at' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'updated_at' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];
    protected $columnMap = [];
}