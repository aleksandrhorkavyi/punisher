<?php

namespace app\commands;

use yii\helpers\FileHelper;

class MigrateController extends \yii\console\controllers\MigrateController
{
    public $observedFolder = 'migrations';

    public $baseDir = 'modules';

    public $modulesConfigPath = '/config/modules.php';

    public $namespaces = [];

    public $activeModules = [];

    public function __construct($id, $module, $config = [])
    {
        $this->initActiveModules();
        $this->findMigrateNamespaces();
        $config['migrationNamespaces'] = array_merge(
            $config['migrationNamespaces'],
            $this->namespaces
        );

        parent::__construct($id, $module, $config);
    }

    private function findMigrateNamespaces()
    {
        return FileHelper::findDirectories(
            $this->baseDir, [
                'filter' => function ($path) {
                    $dirs = explode('/', $path);
                    $isObservedFolder = end($dirs) == $this->observedFolder;
                    if ($isObservedFolder) {
                        $ns = 'app\\' . str_replace('/', '\\', $path);
                        in_array($ns, $this->activeModules) ?
                            $this->namespaces[] = $ns : null;
                    }
                    return true;
                }
            ]
        );
    }

    private function initActiveModules(): void
    {
        $configFile = require (\Yii::getAlias('@app') . $this->modulesConfigPath);
        $modules = array_column($configFile, 'class');

        foreach ($modules as $module) {
            $namespace = explode('\\', $module);
            $namespace[count($namespace) - 1] = $this->observedFolder;
            $this->activeModules[] = implode('\\', $namespace);
        }
    }
}