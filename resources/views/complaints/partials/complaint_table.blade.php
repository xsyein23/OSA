@if(count($complaints) > 0)
<table id='complainTable' class='display cell-border'>
    <thead>
        <tr class="text-center">
            <th>Student ID Number</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($complaints as $complaint)
        <tr class="text-center">
            <td>{{ $complaint->student_id }}</td>
            <td>{{ $complaint->user_name }}</td>
            <td>{{ $complaint->user_email }}</td>
            <td>
                <button class="btn btn-sm btn-flash-border-primary bg-primary text-white view-details" data-id="{{ $complaint->id }}" data-toggle="tooltip" data-placement="top" title="View Details">
                    View Details
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="container p-2 mt-5 accordion justify-content-center d-flex">
    <h1 class="text-warning mt-5">No Recent Complaints!</h1>
</div>
@endif