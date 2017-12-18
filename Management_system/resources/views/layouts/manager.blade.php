@extends('layouts.app')

@section('content')
    <div class="row-upgraded-md">
        <!--Employees block-->
        <div class="list-group add-hidden-border list-group-upgrade-lg">
            <div class="list-group-item">
                <b>Employees</b>
            </div>
            <div class="list-group-item">

                <div class="form-group" style="width: 100%">
                    <form method="post" action="/manager/search" class="navbar-form" role="search">
                        {{ csrf_field()  }}
                        <input type="text" name="name" class="form-control" style="width:75%" placeholder="Name">
                        <input type="submit" value="Search" class="btn btn-primary">
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>
                    @include('layouts.errors')
                </div>

                <table class="table table-responsive  table-hover">
                    <thead>
                    <tr>
                        <th>Risk</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>E-mail</th>
                        <th>Joined at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row"><a href="/meeting/{{$user->id}}"><img
                                            src="/images/{{$user->risk_status}}.png" width="25" height="25" alt=""></a>
                            </th>
                            <th><a href="/meeting/{{$user->id}}">{{$user->name}}</a></th>
                            <th><a href="/meeting/{{$user->id}}">{{$user->last_name}}</a></th>
                            <th><a href="/meeting/{{$user->id}}">{{$user->email}}</a></th>
                            <th><a href="/meeting/{{$user->id}}">{{$user->join_date}}</a></th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $users->render() !!}
            </div>
        </div>
        <!--/Employees block-->

        <div class="recommended row row-upgraded-md ">
            <div class="list-group-item">
                <b>Recommended meetings</b>
            </div>
            <div class="list-group-item">
                <table class="table  table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th>Risk</th>
                        <th scope="row">First Name</th>
                        <th>data</th>
                        <th>fullday</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recommended as $key=>$users)
                        @if($key <=9)
                            <tr>
                                <th scope="row"><a href="/meeting/{{$users['id']}}"><img
                                                src="/images/{{$users['risk_status']}}.png" width="25" height="25"
                                                alt=""></a></th>
                                <th scope="row"><a href="/meeting/{{$users['id']}}">{{$users['name']}}</a></th>
                                <th><a href="/meeting/{{$users['id']}}">{{$users['date']}}</a></th>
                                <th><a href="/meeting/{{$users['id']}}">{{$users['fullday']}}</a></th>
                            </tr>
                        @else
                            @break
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <div class="latest-meeting row ">
            <div class="list-group-item">
                <b>latest meetings</b>
            </div>
            <div class="list-group-item">
                <table class="table  table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th scope="row">Meeting title</th>
                        <th>date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($meetings as $meeting)
                        <tr>
                            <th scope="row">
                                <a href="/meeting/{{$meeting->user_id}}/{{$meeting->id}}">
                                    {{$meeting->title}}
                                </a>
                            </th>
                            <th><a href="#">{{$meeting->date}}</a></th>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>



@endsection


