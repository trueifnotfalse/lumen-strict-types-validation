<?php

declare(strict_types=1);

namespace TrueIfNotFalse\LumenStrictValidation\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use TrueIfNotFalse\LumenStrictValidation\StrictTypesValidator;

class StrictValidationProvider extends ServiceProvider
{
    public function boot(): void
    {
        Validator::extend('type', function ($attribute, $value, $parameters, $validator): bool {
            $validator->addReplacer('type', function ($message, $attribute, $rule, $parameters): string {
                return str_replace(':type', $parameters[0], $message);
            });

            /** @var StrictTypesValidator $validator */
            $customValidator = $this->app->make(StrictTypesValidator::class);

            return $customValidator->validate($attribute, $value, $parameters);
        }, trans(':attribute must be of type :type'));
    }
}
