<?php namespace AppOpenAI\OpenAIChat\Classes\Services;

use OpenAI;
use Exception;
use Illuminate\Support\Facades\Log;

class OpenAIChatService
{
	protected $client;

	public function __construct()
	{
		$this->client = OpenAI::client(env('OPENAI_API_KEY'));
	}

	public function generateAdDescription(array $adData): ?string
	{
		$instruction = <<<EOT
You are an assistant specialized in creating engaging, detailed, and informative descriptions for car advertisements. You will receive structured data about a vehicle, including its brand, model, year, mileage, fuel type, transmission, engine specs, condition, body type, and additional features.

Your task is to write a natural-sounding, compelling description suitable for an online car sales platform. The description should sound like it was written by a professional car seller, highlighting the key selling points, technical specifications, and condition of the car.

Output language: The final description must be written in **Slovak** language.

Avoid repeating data mechanically; instead, rephrase and contextualize features into persuasive sentences. Maintain a neutral and professional tone.

Include:
- Vehicle make, model, and year.
- Engine specifications (type, displacement, power).
- Mileage and overall condition.
- Transmission and drivetrain info.
- Standout features (e.g. infotainment, safety, comfort).
- Any details that might appeal to a buyer (e.g. well-maintained, first owner, non-smoker).

Keep the description around 100–150 words in length. If any required information is missing, skip it and do not guess. Do not include headings, formatting, or JSON—just a plain text paragraph in Slovak.
EOT;

		$prompt = 'Vytvor popis pre inzerát auta na základe údajov.';
		$parameters = ['description'];

		$messages = [
			['role' => 'system', 'content' => $instruction],
			['role' => 'user', 'content' => '$prompt = ' . $prompt . ' \n $parameters = ' . json_encode($parameters) . ' \n $adData = ' . json_encode($adData)]
		];

		try {
			$response = $this->client->chat()->create([
				'model' => 'gpt-3.5-turbo',
				'messages' => $messages,
				'temperature' => 0.7,
				'max_tokens' => 300,
				'top_p' => 1,
				'frequency_penalty' => 0,
				'presence_penalty' => 0
			]);

			return $response['choices'][0]['message']['content'] ?? null;
		} catch (Exception $e) {
			Log::error('OpenAIChatService Error: ' . $e->getMessage());
			return null;
		}
	}
}
