<div class="complaint-details">
    <div class='row'>
        <div class='col justify-content-end d-flex'>
            <small>
                <em>Date filed: </em> {{ \Carbon\Carbon::parse($complaint->date_filed)->format('F j, Y') }}
            </small>
        </div>
    </div>
    <div class='row pt-3'>
        <div class='col-md-6 '>
            <p>
                <strong>Complaint #:</strong> {{ $complaint->id }}
            </p>
        </div>
        <div class='col-md-6'>
            <p>
                <strong>Student ID:</strong> {{ $complaint->student_id }}
            </p>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-6'>
            <p>
                <strong>Name:</strong> {{ $complaint->user_name }}
            </p>
        </div>
        <div class='col-md-6'>
            <p>
                <strong>Email:</strong> {{ $complaint->user_email }}
            </p>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-6'>
            <p>
                <strong>College:</strong> {{ $complaint->user_college }}
            </p>
        </div>
        <div class='col-md-6'>
            <p>
                <strong>Course:</strong> {{ $complaint->user_course }}
            </p>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-6'>
            <p>
                <strong>Attachment:</strong>
                <a href='{{ $complaint->user_file }}' target='_blank'>
                    <u>{{ $complaint->user_file }}</u>
                </a>
            </p>
        </div>
        <div class='col-md-6'>
            <p>
                <strong>Concern:</strong> {{ $complaint->user_message }}
            </p>
        </div>
    </div>
</div>