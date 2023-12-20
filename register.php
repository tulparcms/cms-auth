<?php
/**
 * bu eklenti CMS için
 */
defined('AUTH_FOLDER') or define('AUTH_FOLDER', 'tulparcms/cms-auth-main');
defined('AUTH_LANG') or define('AUTH_LANG', 'tulparcms/cms-auth-main::localize.');

if(is_file(__DIR__.'/controller/TcmsAuthenticate.php')){
    include_once(__DIR__.'/controller/TcmsAuthenticate.php');
}
TCMS()->addAction('routing', 'cms_auth_routing', 1);
TCMS()->addAction('localize', 'cms_auth_localize', 1);
function cms_auth_localize(){
    $path = storage_path('tcms/'.AUTH_FOLDER.'/lang');
    \Lang::addNamespace(REPOSITY_FOLDER, $path);
}

function cms_auth_routing(){
    Route::group([
        'prefix'=>\Tulparstudyo\Cms\CmsLoader::ADMIN,
        'as'=>\Tulparstudyo\Cms\CmsLoader::ADMIN.'.',
        'middleware' => ['web']
    ], function () {
        Route::get('/login', ['App\\Http\\Middleware\\TcmsAuthenticate', 'login'])->name('login');
        Route::get('/logout', ['App\\Http\\Middleware\\TcmsAuthenticate', 'logout'])->name('logout');
        Route::post('/login-check', ['App\\Http\\Middleware\\TcmsAuthenticate', 'loginCheck'])->name('login-check');
    });
}
