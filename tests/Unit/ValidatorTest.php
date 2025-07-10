<?php

use Core\Validator;

it('validates a string', function () {
    // $result = \Core\Validator::string('foobar');

    // expect($result)->toBeTrue();
    // expect($result)->toBe(true);

    expect(Validator::string('foobar'))->toBeTrue();
    expect(Validator::string(false))->toBeFalse();
    expect(Validator::string(''))->toBeFalse();
});

it('validates a string with a minimum length', function () {
    expect(Validator::string('foobar', 20))->toBeFalse();
});

it('validates an email', function () {
    expect(Validator::email('foobar'))->toBeFalse();
    expect(Validator::email('foobar@example.com'))->toBeTrue();
});

// pest only call this last method and skips all the previous ones
// like i am only interested in this one test alone
it('validates that a number is greater than a given amount', function () {
    expect(Validator::greaterThan(10, 1))->toBeTrue();
    expect(Validator::greaterThan(10, 10))->toBeFalse();
})->only();