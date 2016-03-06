@extends('master')

@section('content')
    <div class="row">
        <div class="large-12 small-12 columns">
            <div class="alert-box success margin-top">
                There are no emergencies at this time.
            </div>
        </div>
    </div>

    <div class="row">
        <div class="large-12 small-12 columns">
            <div class="panel">
                <h4>Emergency Monitoring Panel</h4>
                <table class="width-full">
                    <thead>
                    <tr>
                        <th>Contact #</th>
                        <th>User</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    @foreach ($EmergencyUsers as $ThisUser)
                        <tr>
                            <td>{{ $ThisUser->number }}</td>
                            <td>{{ $ThisUser->name }}</td>
                            <td>{{ $ThisUser->updated_at }}</td>
                            <td>View</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection