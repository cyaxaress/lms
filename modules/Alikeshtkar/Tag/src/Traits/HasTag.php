<?php

namespace Alikeshtkar\Tag\Traits;

use Illuminate\Support\Fluent;

trait HasTag
{
    protected function prepareForValidation()
    {
        $this->getValidatorInstance()->sometimes(config('tag.key'), ['nullable', 'array'], function (Fluent $fluent) {
            return $this->filled(config('tag.key'));
        });
        $this->getValidatorInstance()->sometimes(config('tag.key') . '.*', ['bail','string',], function (Fluent $fluent) {
            return $this->filled(config('tag.key'));
        });
    }
}
