<?php namespace AppOpenAI\OpenAIChat\Classes\Services;

use OpenAI;
use Exception;
use AppUtil\Logger\Classes\Logger;

class OpenAIChatService
{
	protected OpenAI\Client $client;
	
	public function __construct()
	{
		$this->client = OpenAI::client(env('OPENAI_API_KEY'));
	}

	/**
	 * Generates a car advertisement description based on the provided data.
	 *
	 * @param array $adData Structured data about the vehicle.
	 * @return string|null The generated advertisement description or null on failure.
	 */
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

		$prompt = 'Na základe nasledujúcich údajov o vozidle vytvor popis vhodný pre online inzerát:';

		$content = implode("\n\n", [
			$prompt,
			json_encode($adData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
		]);

		$messages = [
			['role' => 'system', 'content' => $instruction],
			['role' => 'user', 'content' => $content]
		];

		try {
			$response = $this->client->chat()->create([
				'model' => 'gpt-4-turbo',
				'messages' => $messages,
				'temperature' => 0.7,
				'max_tokens' => 500,
				'top_p' => 1,
				'frequency_penalty' => 0,
				'presence_penalty' => 0
			]);

			Logger::info('OpenAIChatService Description Response: ' . json_encode($response));

			return $response['choices'][0]['message']['content'] ?? null;
		} catch (Exception $e) {
			Logger::error('OpenAIChatService Description Error: ' . $e->getMessage());
			return null;
		}
	}

	/**
	 * Generates a car diagnostic based on the provided user input.
	 *
	 * @param string $prompt User's description of the vehicle problem.
	 * @return string|null The generated diagnostic response or null on failure.
	 */
	public function generateOnlineDiagnostic(string $prompt): ?string
	{
		try {
			$instruction = <<<EOT
You are an expert automotive diagnostic assistant. Your job is to help car owners identify possible causes of technical problems based on their descriptions.

You will receive a user input in Slovak language, where the user describes a problem with their vehicle. The user may mention the brand, model, engine type, mileage, error codes, symptoms, sounds, smells, or performance issues.

Your task is to:
- Analyze the problem logically.
- Suggest the most probable causes or known issues related to the described vehicle.
- Recommend possible steps to identify or fix the issue.
- Be helpful, concise, and technically accurate.

You are allowed to format your response using basic HTML (e.g. <strong>, <ul>, <li>, <p>), so it can be displayed nicely on a website.

Always respond in **Slovak language**. Do not speculate without basis. If there’s not enough information, suggest what the user could provide to help with better diagnosis.

Avoid generic phrases and provide actionable insights whenever possible.
EOT;

			$messages = [
				['role' => 'system', 'content' => $instruction],
				['role' => 'user', 'content' => $prompt]
			];

			$response = $this->client->chat()->create([
				'model' => 'gpt-4-turbo',
				'messages' => $messages,
				'temperature' => 0.6,
				'max_tokens' => 600,
				'top_p' => 1,
				'frequency_penalty' => 0,
				'presence_penalty' => 0
			]);

			Logger::info('OpenAIChatService Diagnostic Response: ' . json_encode($response));

			return $response['choices'][0]['message']['content'] ?? null;
		} catch (Exception $e) {
			Logger::error('OpenAIChatService Diagnostic Error: ' . $e->getMessage());
			return null;
		}
	}
}
