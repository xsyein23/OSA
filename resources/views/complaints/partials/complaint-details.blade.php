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

    <div class='row'>
        <div class='col'>
            <form method='post' action='{{ route("complaints.reply") }}'>
                @csrf
                <input type='hidden' name='complaint_id' value='{{ $complaint->id }}'>
                <input type='hidden' name='name' value='{{ $complaint->user_name }}'>
                <input type='hidden' name='email' value='{{ $complaint->user_email }}'>
                <textarea class='form-control' type='text' name='message' placeholder='Send a message'></textarea>
                <div class='justify-content-end d-flex pt-4'>
                    <button type='button' class='btn' data-bs-dismiss='modal'>Close</button>
                    <button type='submit' class='btn btn-success'>Send</button>
                </div>
            </form>
        </div>
    </div>
</div>