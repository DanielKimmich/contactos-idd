<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|min:5|max:255',
            'description'   => 'max:255',
            'body'          => 'required|min:2',
            'category_id'   => 'required|integer',
            'author_id'     => 'required|integer',
            'posted_at'     => 'required|date',
            'status'        => 'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title'         => trans('blog.post.title'),
            'description'   => trans('blog.post.description'),
            'body'          => trans('blog.post.body'),
            'category_id'   => trans('blog.post.category'),
            'author_id'     => trans('blog.post.author'),
            'posted_at'     => trans('blog.post.posted_at'),
            'status'        => trans('blog.post.status'),
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
