<?php

namespace App\Http\Requests\API\V1\Reserva;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservaRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'checkin' => 'required|max:255',
			'checkout' => 'required|max:255',
			'lugar_id',
			'user_id',
			'numhuesped',
			'preciototal',
			'estado'
		];
	}

	public function messages()
	{
		return[
			'checkin.required' => 'La fecha es requerida',
			'checkout.required' => 'La fecha es requerida',
		];
	}
}