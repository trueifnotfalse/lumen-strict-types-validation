<?php

declare(strict_types=1);

namespace TrueIfNotFalse\LumenStrictValidation\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use TrueIfNotFalse\LumenStrictValidation\StrictTypesValidator;

class StrictValidationProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        /** @var StrictTypesValidator $customValidator */
        $customValidator = $this->app->make(StrictTypesValidator::class);

        foreach (StrictTypesValidator::TYPE_MAP as $type => $nativeType) {
            Validator::extend('type' . ucfirst($type), function ($attribute, $value, $parameters, $validator) use ($type, $customValidator): bool {

                return $customValidator->validate($attribute, $value, [$type]);
            }, trans('validation.' . $nativeType));
        }
    }
}
