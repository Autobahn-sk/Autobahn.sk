<?php namespace AppAd\AdPrice\Models;

use Model;

/**
 * PriceOffer Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class PriceOffer extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'appad_adprice_price_offers';

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
