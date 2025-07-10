<?php

// TESTING In reality testing is it's own world. like everything in programming.
// you learn something new, and you very quickly realize ohh this is it's own world.
// and there are conferences dedicated to this one thing.


// UNIT represent one unit of your codebase
// that unit could be a single class, a single function, or a small collection of classes
// still notice how they comprise a single small typically uh unit

// on the other hand FEATURE test refers to something much wider
// a feature in your application
// that feature could be i just build a referral system for laracasts. that's a feature
// we could have a feature test called ReferralTest
// within that i could describe the rules of a referral system
// what is it consists of, what you allowed to do, what you are not allowed to do
// so from that perspective we might realize that when we write tests it's not just
// to ensure the thing works even though tha's very useful
// but it's also almost like a scratch pad it's a great way to gather your thoughts
// see file ReferralTest.php

use Core\Container;

test('it can resolve something out of the container', function () {
    // Typically when you are writing tests, there will be series of steps
    // you will need to arrange the world and often that's instantiating a class building up a dependency
    // whatever you need to do we will call it arrange

    // arrange
    $container = new Container();

    // $container->bind('foo', function () {
    //     return 'bar';
    // });
    // or there is a shorthand single line arrow function
    $container->bind('foo', fn() => 'bar');

    // perform your actions do whatever it is that you are trying to test
    // act

    $result = $container->resolve('foo');


    // at the end
    // assert/expect and this is where you will confirm that whether of not it actually worked
    // that's where we write our expectations
    // expect($result)->toBe('bar'); or
    expect($result)->toEqual('bar');


    // your next thought might be but why do i need to do this? or why it is useful? i can manually check this
    // because i have written it down here and i have automated it that means i can run this test
    // hundreds of times for free
    // and i never have to manually confirm that this peace of functionality works
    // trust him, as you maintain a project over a span of potentially years
    // this thing will build up and continuously prove their usefulness
    // and further it helps us with confidence

    // and here is what he meant
    // from six months from now, i like to refactor container class i can do so
    // with confidence because i immediately knows if i make a mistake the test will fail
    // and the test will instantly inform me
    // and if i didn't have those automated tests yah, i can perform this refactors but
    // trust him, it can get little tricky it had to do lot of manual testing
    // to see did this work erectly the way it did before or have i changed it or did i break code
    // that was using container class over here it's get very very risky very very fast
    // so what ends up happening, for the projects that don't have these automated tests backing them up
    // people just don't refactor in so many cases they'll have confusing peace of code that nobody touches
    // because it's simply too risky to play with
    // but tests absolutely fix that which allows us to write a cleaner and better code
});
