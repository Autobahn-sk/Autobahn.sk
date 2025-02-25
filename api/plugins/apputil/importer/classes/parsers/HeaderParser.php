<?php namespace AppUtil\Importer\Classes\Parsers;

use AppApi\ApiException\Exceptions\BadRequestException;

class HeaderParser
{
    /*
     * Prepare header
     */
    public static function prepareHeader($reader, $aliases)
    {
        if (method_exists($reader, 'setHeaderOffset')) {
            $reader->setHeaderOffset(0);
        }
        
        $header = [];
        
        if (method_exists($reader, 'getHeader')) {
            $headerItems = $reader->getHeader();
        } else {
            $headerItems = $reader->fetchOne();
        }
        
        foreach ($headerItems as $index => $headerItem) {
            
            // If header contains empty column, end header
            if (self::checkIgnoreColumn($headerItem)) {
                $header['ignore' . $index] = 'ignore';
                continue;
            }
            
            [$modelAlias, $modelAttr] = self::getModelAliasAndAttribute($headerItem);
            
            // Check if model is allowed
            if (!array_key_exists($modelAlias, $aliases)) {
                throw new BadRequestException('Changing ' . $modelAlias . ' is not allowed');
            }
            
            // attribute and meta data from header item
            [$attr, $meta] = self::parseColumnAttr($modelAttr);
            $meta = self::parseMetaFromModel($attr, $meta, $aliases[$modelAlias]);
            
            $header[$modelAlias . '.' . $attr] = $meta;
        }
        
        return $header;
    }
    
    /*
     * Parses header attribute to [attribute, meta]
     */
    protected static function parseColumnAttr($column)
    {
        preg_match('#\[(.*?)\]#', $column, $match);
        
        return [
            trim(str_replace($match[0] ?? "", "", $column)),
            $match[1] ?? null
        ];
    }
    
    /*
     * Parse header item and get model and attribute from it
     */
    protected static function getModelAliasAndAttribute($headerItem)
    {
        // description $model.attr[meta]
        $headerItem = trim(last(explode('$', $headerItem)));
        // model.attr[meta]
        [$modelAlias, $modelAttr] = explode('.', $headerItem);
        // model , attr[meta]
    
        // more than 2x dot nesting is not allowed
        $thirdDotElement = last(explode($modelAttr, $headerItem));
        if ($thirdDotElement !== "") {
            throw new BadRequestException('3rd dot element: ' . $thirdDotElement . ' is not allowed');
        }
        
        return [$modelAlias, $modelAttr];
    }
    
    /*
     * Checks if column is ignored
     */
    protected static function checkIgnoreColumn($column)
    {
        if (empty($column)) {
            return true;
        }
        
        if (!str_contains($column, '$')) {
            return true;
        }
        
        if (str_contains($column, '[ignore]')) {
            return true;
        }
        
        return false;
    }
    
    /*
     * Parse meta from model
     */
    protected static function parseMetaFromModel($attr, $meta, $modelClass)
    {
        $modelClass = new $modelClass;
        
        if ($modelClass->isJsonable($attr)) {
            return 'jsonable';
        }
        
        if ($modelClass->hasRelation($attr)) {
            $relation = $modelClass->getRelationType($attr);
            
            if (in_array($relation, ['belongsTo', 'hasOne'])) {
                return 'relationOne';
            }
            
            if (in_array($relation, ['belonstToMany', 'hasMany'])) {
                return 'relationMany';
            }
            
            if ($relation == 'attachOne') {
                return 'file';
            }
            
            if ($relation == 'attachMany') {
                return 'files';
            }
        }
        
        return $meta;
    }
}