<?php

function adminer_object()
{
    class AdminerSoftware extends Adminer {
        function login($login, $password) {
            return ($login == 'admin' && $password == '');
        }
    }

    return new AdminerSoftware;
}

Route::any('adminer', '\Miroc\LaravelAdminer\AdminerAutologinController@index');
