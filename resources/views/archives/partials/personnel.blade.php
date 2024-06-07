<table id='archiveTable' class='display cell-border'>
    <thead>
        <tr class="text-center">
            <th style="width: 5%;">#</th>
            <th style="width: 15%;">Image</th>
            <th style="width: 35%;">Name</th>
            <th style="width: 30%;">Position</th>
            <th style="width: 15%;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($archives as $i => $archive)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center"><img src="{{ asset('upload/personnel/' . basename($archive->image)) }}" style="height: 10vh; object-fit: cover;" /></td>
                <td class="text-center">{{ $archive->name }}</td>
                <td class="text-center">{{ $archive->position }}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-flash-border-primary bg-danger text-white" onclick="setPerID({{ $archive->id }})" data-mdb-toggle="modal" data-mdb-target="#personnel_unarchive">
                        <i class='fas fa-archive'></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
