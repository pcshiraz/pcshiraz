@extends('layouts.app')
@section('title', 'ویرایش مقاله ' . $article->title .' - ')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-{{ config('platform.sidebar-size') }}">
            @include('admin.sidebar')
        </div>
        <div class="col-md-{{ config('platform.content-size') }}">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">مدیریت سیستم</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.article') }}">مقاله ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{ route('admin.page.edit',['id' => $article->id]) }}">ویرایش
                            مقاله {{ $article->title }}</a></li>
                </ol>
            </nav>
            <div class="card card-default">
                <div class="card-header">ویرایش مقاله {{ $article->title }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.article.update',['id' => $article->id]) }}">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input id="title" type="text"
                                   class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                                   value="{{ old('title', $article->title) }}" required autofocus>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="title">لینک Slug</label>
                            <input id="slug" type="text"
                                   class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug"
                                   value="{{ old('slug', $article->slug) }}" required>
                            @if ($errors->has('slug'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">توضیحات</label>
                            <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                      name="description"
                                      id="description"> {{ old('description', $article->description) }}</textarea>

                            @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="text">محتوا</label>
                            <textarea class="wysiwyg form-control{{ $errors->has('text') ? ' is-invalid' : '' }}"
                                      name="text" id="text" required>{{ old('text', $article->text) }}</textarea>
                            @if ($errors->has('text'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('text') }}</strong>
                                    </span>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="category_id">دسته</label>

                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"{{ old('category_id', $article->category_id) == $category->id  ? ' selected' : '' }}>{{$category->title}}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('category_id'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('access') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tags">برچسب ها<span
                                        class="font-weight-light font-italic"> - اختیاری</span></label>
                            <select id="tags" name="tags[]" class="form-control tags" multiple="multiple">
                                @foreach($article->tags as $tag)
                                    <option value="{{ $tag->name }}" selected>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tags'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('tags') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="enabled">فعال</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="enableRadioYes" name="enabled"
                                       value="1"
                                       class="custom-control-input"{{ old('enabled', $article->enabled) == true  ? ' checked' : '' }}>
                                <label class="custom-control-label" for="enableRadioYes">بلی</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="enableRadioNo" name="enabled"
                                       value="0"
                                       class="custom-control-input"{{ old('enabled', $article->enabled) == false  ? ' checked' : '' }}>
                                <label class="custom-control-label" for="enableRadioNo">خیر</label>
                            </div>
                            @if ($errors->has('enabled'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('enabled') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            ویرایش مقاله
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
