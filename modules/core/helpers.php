<?php

use Illuminate\Support\Facades\App;

function moduleList(): bool|array
{
    $path = base_path('modules');
    $modules = scandir($path);
    $modules = array_diff($modules, array('.', '..'));
    config()->set('app.modules', $modules);
    return $modules;
}

function addModuleProviders(): void
{
    $modules = moduleList();
    foreach ($modules as $module) {
        $providerDir = base_path('modules/' . $module . '/Providers');
        if (is_dir($providerDir)) {
            $files = scandir($providerDir);
            $files = array_diff($files, array('.', '..'));
            foreach ($files as $file) {
                $class = '\Modules\\' . $module . '\\Providers\\' . str_replace('.php', '', $file);
                if (class_exists($class) && $class !== '\Modules\core\Providers\ModuleProvider') {
                    App::register($class);
                }
            }
        }
    }
}

function addEvent($name, $object): void
{
    $events = config('app.events', []);
    if (array_key_exists($name, $events)) {
        $add = false;
        foreach ($events[$name] as $value) {
            if ($value != $object) {
                $add = true;
            }
        }
        if ($add) {
            $events[$name][] = $object;
        }
    } else {
        $events[$name] = [$object];
    }
    config()->set('app.events', $events);
}

function runEvent($name, $data, $return = false)
{
    $events = config('app.events');
    if (array_key_exists($name, $events)) {
        foreach ($events[$name] as $event) {
            $object = new $event();
            if ($return) {
                $result = $object->handle($data);
                if ($result !== null) {
                    $data = $result;
                }
            } else {
                $object->handle($data);
            }
        }
    }
    if ($return) return $data;
}
