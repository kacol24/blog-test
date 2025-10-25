<?php

it('will not produce any smoke', function () {
    $routes = ['/', '/login', '/register'];

    visit($routes)->assertNoSmoke();
});
