<?php

declare(strict_types=1);

namespace TrueIfNotFalse\LaravelStrictValidationTests\Unit;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use TrueIfNotFalse\LumenStrictValidation\Providers\StrictValidationProvider;
use TrueIfNotFalse\LumenStrictValidationTests\TestCase;

class StrictValidationProviderTest extends TestCase
{
    public function testValidatorBoots()
    {
        $provider = new StrictValidationProvider(app());
        $provider->boot();

        $passingData = [
            'test' => 5,
        ];

        $failingData = [
            'test' => '5',
        ];

        $rules = [
            'test' => 'required|type:int',
        ];

        $validator1 = Validator::make($passingData, $rules);
        $validator2 = Validator::make($failingData, $rules);

        $this->expectException(ValidationException::class);

        $this->assertFalse($validator1->fails());
        $this->assertTrue($validator2->fails());

        $this->assertEquals([
            'test' => ['The test must be of type int'],
        ], $validator2->errors()->toArray());

        $this->assertEquals([
            'test' => 5,
        ], $validator1->validated());
        $this->assertEmpty($validator2->validated());
    }
}
