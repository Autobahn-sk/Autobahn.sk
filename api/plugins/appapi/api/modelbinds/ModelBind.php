<?php namespace AppApi\Api\ModelBinds;

abstract class ModelBind
{
    public string $model;

    public string $modelName;

    public string $routeKeyName;

    public string $databaseKeyName;

    public function handle($request, $next)
    {
        $existingModel = $this->model::where($this->databaseKeyName, $request->route($this->routeKeyName))
            ->firstOrFail();

        $request->route()->setParameter($this->modelName, $existingModel);
        $request->route()->forgetParameter($this->routeKeyName);

        $request->merge([$this->modelName => $existingModel]);

        return $next($request);
    }
}
