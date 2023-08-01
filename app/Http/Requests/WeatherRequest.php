<?php

declare(strict_types=1);

namespace App\Http\Requests;


use App\Services\WeatherService\ProvidersList;
use Illuminate\Foundation\Http\FormRequest;


class WeatherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $action = $this->route()->action['as'] . '_rules';
        return $this->$action();
    }

    /**
     * @return array
     */
    private function get_weather_info_rules(): array
    {
        return [
            'city' => 'required|string',
        ];
    }

    /**
     * @return array
     */
    private function get_single_weather_info_rules(): array
    {
        return [
            'provider' => ['required', 'in:' . implode(',', array_keys(ProvidersList::PROVIDERS))],
            'city' => 'required|string',
        ];
    }
}
