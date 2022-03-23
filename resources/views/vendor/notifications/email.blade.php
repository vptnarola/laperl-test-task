@extends('emails.email-template')

@section('greetings', (! empty($greeting)) ? $greeting : '')
@section('heading', (! empty($actionText)) ? $actionText : '')

@section('content_before_button')
    @foreach ($introLines as $line)
        <p>{{ $line }}</p>
    @endforeach
@endsection

@section('content_after_button')
    @foreach ($outroLines as $line)
            <p>{{ $line }}</p>
    @endforeach
@endsection

@section('button_title', ucfirst($actionText))
@section('button_link', $actionUrl)