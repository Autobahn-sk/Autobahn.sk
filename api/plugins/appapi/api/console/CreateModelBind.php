<?php namespace AppApi\Api\Console;

use File;
use Illuminate\Console\Command;

class CreateModelBind extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:modelbind {namespace}.{plugin} {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a ModelBind class for a specific model in a plugin.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $namespace = $this->argument('namespace');
        $plugin = $this->argument('plugin');
        $modelName = $this->argument('model');

        $routeKeyName = strtolower($modelName). 'Id';

        $formattedModelName = strtolower($modelName);

        $databaseKeyName = 'id';

        $classContent = $this->generateModelBindClass($namespace, $plugin, $modelName, $formattedModelName, $routeKeyName, $databaseKeyName);

        $pluginDirectory = base_path("plugins/" . strtolower($namespace) . "/" . strtolower($plugin));
        $directory = $pluginDirectory . "/http/modelbinds";

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $filePath = $directory . '/' . $modelName . 'ModelBind.php';

        File::put($filePath, $classContent);

        $this->info("ModelBind class created at {$filePath}");
    }

    /**
     * Generate the content for the ModelBind class.
     *
     * @param string $namespace
     * @param string $plugin
     * @param string $modelName
     * @param string $routeKeyName
     * @param string $databaseKeyName
     * @return string
     */
    protected function generateModelBindClass($namespace, $plugin, $modelName, $formattedModelName, $routeKeyName, $databaseKeyName)
    {
        $namespacePath = str_replace('.', '\\', $namespace);
        $modelNamespace = "{$namespacePath}\\{$plugin}\\Models\\{$modelName}";
        $bindNamespace = "{$namespacePath}\\{$plugin}\\Http\\ModelBinds";

        return <<<PHP
<?php

namespace {$bindNamespace};

use {$modelNamespace};
use AppApi\Api\ModelBinds\ModelBind;

class {$modelName}ModelBind extends WModelBind
{
    public string \$model = {$modelName}::class;

    public string \$modelName = '{$formattedModelName}';

    public string \$routeKeyName = '{$routeKeyName}';

    public string \$databaseKeyName = '{$databaseKeyName}';
}
PHP;
    }
}
