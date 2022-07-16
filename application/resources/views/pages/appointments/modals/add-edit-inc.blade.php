<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Telecaller</th>
                    <th>Ongoing</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->total }}</td>
                    <td><input type="text" class="form-control form-control-sm " id="user_id" name="user_id{{ $user->id }}"
                    value="" placeholder="Enter Number Of Leads To Be Assigned"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
       
    </div>
</div>