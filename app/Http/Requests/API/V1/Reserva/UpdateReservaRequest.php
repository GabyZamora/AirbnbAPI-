<?php 

namespace App\Http\Requests\API\V1\Reserva;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservaRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'checkin' => 'required',
			'checkout' => 'required',
			'lugar_id',
			'user_id',
			'numhuesped',
			'preciototal',
			'estado',
		];
	}

	public function messages()
	{
		return [
			'checkin.required' => 'La fecha de ingreso es requerida',
			'checkout.required' => 'La fecha de salida es requerida',
		]; 
	}
}