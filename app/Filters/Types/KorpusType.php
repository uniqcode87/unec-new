<?php

namespace App\Filters\Types;

class KorpusType
{
    public function filter($builder, $value)
    {
        return $builder->where('tedris', 'like' , '%'.$value.'%');
    }
}