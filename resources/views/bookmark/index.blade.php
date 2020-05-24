@extends('layouts.app')

@section('title', 'Список закладок')
@section('keywords', 'Список закладок')
@section('description', 'Список закладок')

@section('content')

    <h1>Закладки</h1>

    @include('components.message')

    <div class="my-4">
        <div class="row justify-content-between">
            <div class="col-auto">
                <a href="{{ route('bookmark.create') }}" class="btn btn-success">Добавить закладку</a>
            </div>
            <div class="col-auto">
                <a href="{{ route('bookmark.export') }}" class="btn btn-outline-success">Экпорт</a>
            </div>
        </div>
    </div>

    <div class="my-4">
        <form action="{{ route('bookmark.index') }}" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="Поиск по закладкам">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Найти</button>
                </div>
            </div>
        </form>
    </div>

    <div class="my-4">

        <table class="table table-striped table-bordered layout-fixed">
            <thead class="thead-light">
                <tr>
                    <th style="width: 120px" class="text-center">@sortablelink('created_at', 'Дата')</th>
                    <th style="width: 42px" title="Иконка"><i class="icon icon__image icon__image--favicon"></i></th>
                    <th style="width: 40%">@sortablelink('url', 'Url')</th>
                    <th>@sortablelink('title', 'Заголовок страницы')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookmarks as $item)
                    <tr>
                        <td class="text-center">{{ $item->created_at_date }}</th>
                        <td>
                            @if (!empty($item->favicon))
                                <img src="{{ $item->favicon }}" class="w-100">
                            @endif
                        </td>
                        <td class="ellipsis"><a href="{{ $item->url }}" title="{{ $item->url }}" target="_blank"><i class="icon icon__image icon__image--link mr-2"></i>{{ $item->url }}</a></td>
                        <td class="ellipsis"><a href="{{ route('bookmark.show', $item) }}" ><i class="icon icon__image icon__image--eye mr-2"></i>{{ $item->title }}</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            Закладок нет
                        </th>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $bookmarks->onEachSide(1)->links() }}

    </div>

@endsection
