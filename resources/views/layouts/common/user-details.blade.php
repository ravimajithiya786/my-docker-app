<h6 class="mt-4">Basic Details</h6>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <td>{{ Auth::user()->id }}</td>
        </tr>
        <tr>
            <th scope="row">Name</th>
            <td>{{ Auth::user()->name }}</td>
        </tr>
        <tr>
            <th scope="row">Email</th>
            <td>{{ Auth::user()->email }}</td>
        </tr>
        <tr>
            <th scope="row">Joined</th>
            <td>{{ Auth::user()->created_at->format('F j, Y') }}</td>
        </tr>
        <tr>
            <th scope="row">Last Updated</th>
            <td>{{ Auth::user()->updated_at->format('F j, Y') }}</td>
        </tr>
    </tbody>
</table>

<h6 class="mt-4">Addresses</h6>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>ZIP</th>
            <th>Country</th>
            <th>Default</th>
        </tr>
    </thead>
    <tbody>
        @foreach(Auth::user()->addresses as $address)
        <tr>
            <td>{{ $address->address }}</td>
            <td>{{ $address->city }}</td>
            <td>{{ $address->state }}</td>
            <td>{{ $address->zip }}</td>
            <td>{{ $address->country }}</td>
            <td>{!! $address->is_default ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>' !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>