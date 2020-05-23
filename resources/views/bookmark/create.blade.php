@extends('layouts.app')

@section('title', 'Новая закладка')
@section('keywords', 'Новая закладка')
@section('description', 'Новая закладка')

@section('content')

    <h1>Новая закладка</h1>

    <div class="my-4">
        <a href="{{ route('bookmark.index') }}" class="btn btn-outline-dark">Вернуться к списку</a>
    </div>

    <form action="{{ route('bookmark.store') }}" method="post">

        @csrf

        <div class="form-group">
            <label for="url">Адрес закладки</label>
            <input
                type="url"
                name="url"
                value="{{ old('url') }}"
                class="form-control @error('url') is-invalid @enderror"
                id="url"
                required
            >
            @error('url')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @else
                <small class="form-text text-muted">Укажите адрес страницы, которую хотите добавить в закладки</small>
            @enderror
        </div>

        <div class="form-row mb-2">

            <div class="col">

                <div class="form-group">
                    <label for="password">Пароль для удаления</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        autocomplete="new-password"
                    >
                    @error('password')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @else
                        <small class="form-text text-muted">Укажите пароль для удаления или оставьте пустым</small>
                    @enderror
                </div>

            </div>

            <div class="col">

                <div class="form-group">
                    <label for="password-confirm">Повторите пароль</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        id="password-confirm"
                        autocomplete="new-password"
                    >
                </div>

            </div>

        </div>

        <button class="btn btn-success" type="submit">Добавить закладку</button>

    </form>

@endsection
