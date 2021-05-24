@extends('layouts.dashboard', ['sub' => 'followed', 'title' => 'Followed Users'])

@section('subpage')
    <div class="container-fluid mb-4">
        <div class="my-4">
            <h2>Followed</h2>
        </div>

        <div class="container">
            @foreach ($followers as $member)
                @include('partials.user_entry', ['member' => $member, 'last' => $loop->last])
            @endforeach
        </div>
    </div>
@endsection

