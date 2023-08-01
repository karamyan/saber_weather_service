<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\WeatherRequest;
use App\Services\WeatherService\WeatherService;
use Illuminate\Http\JsonResponse;


class WeatherController extends Controller
{
    public function __construct(private readonly WeatherService $weatherService)
    {
    }

    /**
     * @OA\Post(
     * path="/api/weather/get_all",
     * operationId="weather_get_all",
     * tags={"weather_get_all"},
     * summary="Weather info",
     * description="Get weather info by city",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"city"},
     *               @OA\Property(property="city", type="text")
     *            ),
     *        ),
     *    ),
     *       @OA\Response(response=429, description="Too many requests"),
     *       @OA\Response(response=400, description="Bad request"),
     *       @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function getWeatherInfo(WeatherRequest $request): JsonResponse
    {
        $params = $request->validated();

        $data = $this->weatherService->getInfoByCity($params['city']);

        return response()->json($data);
    }

    /**
     * @OA\Post(
     * path="/api/weather/get_single",
     * operationId="weather_get_single",
     * tags={"weather_get_single"},
     * summary="Weather info",
     * description="Get weather info by city",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"provider", "city"},
     *               @OA\Property(
     *                  property="provider",
     *                  type="text",
     *                  enum={"weatherbit", "goweather"}
     *               ),
     *              @OA\Property(
     *                   property="city", type="text"
     *                )
     *            ),
     *        ),
     *    ),
     *      @OA\Response(response=429, description="Too many requests"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function getSingleWeatherInfo(WeatherRequest $request): JsonResponse
    {
        $params = $request->validated();

        $this->weatherService->loadProvider($params['provider']);
        $data = $this->weatherService->getSingleInfoByCity($params['city']);

        return response()->json($data);
    }
}
