@extends('layouts.app')

@section('title', 'Детали закладки')
@section('keywords', 'Детали закладки')
@section('description', 'Детали закладки')

@section('content')

    <h1>Детали закладки</h1>

    <div class="my-4">
        <a href="{{ route('bookmark.index') }}" class="btn btn-outline-dark">Вернуться к списку</a>
    </div>

    <div class="my-4">

        <table class="table table-bordered layout-fixed">
            <tbody>

                <tr>
                    <th class="w-200px">Дата добавления</th>
                    <td class="ellipsis">{{ $bookmark->created_at_date_time }}</td>
                </tr>

                @if (!empty($bookmark->favicon))
                <tr>
                    <th class="w-200px">Иконка</th>
                    <td class="ellipsis"><img src="{{ $bookmark->favicon }}" class="mw-18px"></td>
                </tr>
                @endif

                <tr>
                    <th class="w-200px">Url</th>
                    <td class="ellipsis"><a href="{{ $bookmark->url }}" title="{{ $bookmark->url }}" target="_blank"><i class="icon icon__image icon__image--link mr-2"></i>{{ $bookmark->url }}</a></td>
                </tr>

                <tr>
                    <th class="w-200px">Заголовок</th>
                    <td class="ellipsis">{{ $bookmark->title }}</td>
                </tr>

                <tr>
                    <th class="w-200px">Keywords</th>
                    <td>{{ $bookmark->keywords }}</td>
                </tr>

                <tr>
                    <th class="w-200px">Description</th>
                    <td>
                        {{ $bookmark->description }}
                    </td>
                </tr>

            </tbody>
        </table>

    </div>

@endsection
