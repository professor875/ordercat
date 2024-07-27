<?php

function can(...$permissions): bool
{
    return auth()->user()->can($permissions);
}

function cannot($permissions): bool
{
    return !auth()->user()->can($permissions);
}
