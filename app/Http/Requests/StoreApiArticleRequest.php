<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreApiArticleRequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'article.title' => ['required', 'string', 'max:100'],
      'article.description' => ['required', 'string', 'max:255'],
      'article.body' => ['required', 'string', 'max:16384'],
      'article.tagList' => ['array', 'nullable'],
      'article.tagList.*' => ['string', 'max:20', 'nullable']
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    $res = response()->json(
      [
        'errors' => $validator->errors()
      ],
      400
    );
    throw new HttpResponseException($res);
  }
}
