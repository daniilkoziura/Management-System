@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="list-group-item clearfix">
            @role('Manager')
            <a href="/manager/home" class="left">
                <img src="/images/navigate-left-icon.png" width="15" height="15" alt="undo">
            </a>
            <img class="risk-mini left" src="/images/{{ $user->risk_status}}.png" width="25" height="25" alt="risk">
            <span class="user-name left">{{ $user->name }}</span>
            <span class="user-email right">{{ $user->email }}</span>
        </div>
        <div class="list-group-item">
            <p>Add Meeting</p>
            <form method="POST" action="/meeting/{{$user->id}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="title"/>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>

                <div class="form-group for-date">
                    <label for="date">Date:</label>
                    <input type="text" class="form-control" name="date" placeholder="Now by default"/>
                </div>

                <div class="form-group for-send">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>

            </form>
            @endrole
            @if(count($errors))
                @foreach($errors->all() as $error)
                    <p class="alert alert-warning">{{ $error}}</p>
                @endforeach
            @endif
            <h2>Meetings</h2>
            <table class="table table-responsive  ">
                <thead>
                <tr class="header-table">
                    <th class="text-table">Subject</th>
                    <th class="text-table">Manager</th>
                    <th class="text-table">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($meetings as $item)
                    @if($item->id == $meeting->id)
                        <tr class="specify-meeting-block">
                            <th class="text-table">
                                <a class="links-table" href="/meeting/{{$user->id}}/{{$item->id}}">
                                    {{$item->title}}
                                </a>
                            </th>
                            <th class="text-table">
                                {{$user->withRole('manager')->find($item->manager_id)->name}}
                            </th>
                            <th class="text-table">
                                {{$item->date}}
                            </th>
                        </tr>
                        <tr>

                            <table class="table-responsive wr-table">
                                <tr class="description-table">
                                    <th class="text-table description-th">
                                        <p class="description">Desciption</p>
                                        {{$item->description}}
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th class="description-th">
                                        <form method="POST" action="/meeting/{{$user->id}}/{{$meeting->id}}">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="description-mini" for="text">Add Comment:</label>
                                                <textarea type="text" class="form-control" name="text"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-position">
                                                    Send
                                                </button>
                                            </div>
                                        </form>
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th class="description-th">
                                        <p class="description-mini">Comments</p>
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach($comments as $comment)
                                    <tr>
                                        <th class="description-th description-table ">
                                            <span class="ur-fixed">
                                                {{$user->find($comment->creator_id)->name}}
                                            </span>
                                            <span class="ur-fixed">
                                                {{$comment->created_at}}
                                            </span>
                                            <span class="glyphicon glyphicon-edit "></span>
                                            <span class="glyphicon glyphicon-remove-circle ur-fixed-min "></span>
                                        </th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th class="description-th">
                                            <span class="description-mini">
                                                {{ $comment->text }}
                                            </span>
                                        </th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                @endforeach
                            </table>

                        </tr>
                    @else

                        <tr>
                            <p>
                            <th class="text-table">
                                <a class="links-table  link-pad-mini"
                                   href="/meeting/{{$user->id}}/{{$item->id}}">
                                    {{$item->title}}
                                </a>
                            </th>
                            <th class="text-table">
                                <a href="/meeting/{{$user->id}}/{{$item->id}}"
                                   class="links-table pad link-pad-mini pad">
                                    {{$user->withRole('manager')->find($item->manager_id)->name}}
                                </a>
                            </th>
                            <th class="text-table" style="padding-left: 100px">
                                <a href="/meeting/{{$user->id}}/{{$item->id}}"
                                   class="links-table   link-pad-mini pad2">
                                    {{$item->date}}
                                </a>
                            </th>
                            </p>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


