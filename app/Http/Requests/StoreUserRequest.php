<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
	/**
	* Determine if the user is authorized to make this request.
	*
	* @return bool
	*/
	public function authorize()
	{
		return true;
	}

	/**
	* Get the validation rules that apply to the request.
	*
	* @return array
	*/
	public function rules()
	{
		return [
			'name' => 'required',
			'place' => 'required|numeric',
			'role' => 'required|numeric',
			'email' => 'required_if:role,3|required_if:role,4',
			'passw' => 'required_if:role,3|required_if:role,4',
		];
	}

	public function attributes(){
		return [
			'place' => 'ubicacion',
			'role' => 'tipo de usuario',
			'passw' => 'contraseña',
		];
	}
}
