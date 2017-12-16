@extends('layouts.app')

@section('content')



    <div class="container">
        @role('Manager')
        <div  id="user-status-block">
            <form method="POST" action="/manager/meeting/{{$user->id}}/choice">
                {{ csrf_field() }}
                <h5>Select risk-status:</h5>
                <button class="b-risk" value="0" name="risk" ><img  src="/images/0.png" width="25" height="25" alt="risk"></button>
                <button  class=" b-risk" value="1" name="risk" ><img  src="/images/1.png" width="25" height="25" alt="risk"></button>
                <button class=" b-risk" value="2" name="risk" ><img  src="/images/2.png" width="25" height="25" alt="risk"></button>
            </form>
        </div>
            <div class="list-group-item clearfix" >
                <a href="/manager/home" class="left">
                    <img src="/images/navigate-left-icon.png" width="15" height="15" alt="undo">
                </a>
                <img class="risk-mini left" src="/images/{{ $user->risk_status}}.png" width="25" height="25" alt="risk">
                <span class="user-name left" >{{ $user->name }}</span>
                <span class="user-email risk-middle" ><span class="click-for-show" onclick="showThat()">Select risk-status</span></span>
                <span class="user-email right" >{{ $user->email }}</span>
            </div>
            <div class="list-group-item">

                    <p>Add Meeting</p>
                    <form method="POST" action="/manager/meeting/{{$user->id}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="title" />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>

                        <div class="form-group for-date">
                            <label for="date">Date:</label>
                            <input type="text" class="form-control"  name="date" placeholder="Now by default"  />
                        </div>

                        <div class="form-group for-send" >
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>

                    </form>
                @endrole
                        @include('layouts.errors');
                   <h2>Meetings</h2>
                   <div>
                       <table class="table table-responsive  table-hover">
                           <thead>
                           <tr class="header-table" >
                               <th class="text-table" >Subject</th>
                               <th class="text-table" >Manager</th>
                               <th class="text-table" >Date</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach ($meetings as $meeting)
                               <tr>
                                   <th class="text-table" ><a href="/meeting/{{$user->id}}/{{$meeting->id}}">{{$meeting->title}}</a></th>
                                   <th class="text-table" >{{$user->withRole('manager')->find($meeting->manager_id)->name}}</th>
                                   <th class="text-table" >{{$meeting->date}}</th>
                               </tr>
                           @endforeach
                           </tbody>
                       </table>

                    </div>

            </div>
    </div>
    <!--Just a little script-->
    <script type="text/javascript">
        var visible = true;
        function showThat() {
            if(visible) {
                document.getElementById('user-status-block' ).style.display = 'block';
                visible = true;

            } else {
                document.getElementById('user-status-block' ).style.display = 'none';
                visible = false;
            }
        }
    </script>

@endsection
