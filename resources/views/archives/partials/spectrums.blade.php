<table id='archiveTable' class='display cell-border'>
    <thead>
        <tr class="text-center">
            <th style="width: 5%;">#</th>
            <th style="width: 10%;">Cover</th>
            <th style="width: 25%;">Title</th>
            <th style="width: 10%;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($archives as $i => $archive)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center"><img src="{{ asset('upload/newsletter/img/' . basename($archive->image)) }}" style="height: 10vh; object-fit: cover;" /></td>
                <td class="text-center">{{ $archive->title }}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-flash-border-primary bg-danger text-white" onclick="setSpecID({{ $archive->id }})" data-mdb-toggle="modal" data-mdb-target="#spectrum_unarchive">
                        <i class='fas fa-archive'></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
