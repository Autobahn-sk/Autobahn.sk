<?php namespace AppService\Diagnostic\Models;

use AppOpenAI\OpenAIChat\Classes\Services\OpenAIChatService;
use Model;
use RainLab\User\Models\User;
use Illuminate\Validation\Rule;
use AppService\Diagnostic\Classes\Enums\DiagnosticStatusEnum;

/**
 * Diagnostic Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Diagnostic extends Model
{
    use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\SoftDelete;

    /**
     * @var string table name
     */
    public $table = 'appservice_diagnostic_diagnostics';

    /**
     * @var array rules for validation
     */
    public $rules = [
		'prompt'   => 'required',
		'response' => 'nullable',
		'error'    => 'nullable',
		'status'   => 'required'
	];

	/**
	 * @var array fillable fields
	 */
	protected $fillable = [
		'prompt'
	];

	/**
	 * @var array dates for serialization
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at'
	];

	/**
	 * @var array relations
	 */
	public $belongsTo = [
		'user' => User::class
	];

	// Events
	public function beforeValidate()
	{
		$this->rules['status'] = Rule::in(DiagnosticStatusEnum::values()) . '|required|string';
	}

	public function afterCreate()
	{
		$diagnostic = (new OpenAIChatService)->generateOnlineDiagnostic($this->prompt);

		if ($diagnostic['status'] == DiagnosticStatusEnum::SUCCESS->value) {
			$this->response = $diagnostic['diagnostic'];
			$this->status = DiagnosticStatusEnum::SUCCESS->value;
		} else if ($diagnostic['status'] == DiagnosticStatusEnum::ERROR->value) {
			$this->error = $diagnostic['diagnostic'];
			$this->status = DiagnosticStatusEnum::ERROR->value;
		}

		$this->save();
	}

	// Options
	public function getStatusOptions()
	{
		return DiagnosticStatusEnum::optionsForBackend();
	}
}
