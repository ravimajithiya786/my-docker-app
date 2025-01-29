@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <label for="basic-details">Basic Details</label>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="addresses">Addresses</label>
                                <table class="table table-bordered" id="address-table">
                                    <thead>
                                        <tr>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>ZIP</th>
                                            <th>Country</th>
                                            <th>Default</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="addresses[0][address]" class="form-control" required>
                                            </td>
                                            <td>
                                                <input type="text" name="addresses[0][city]" class="form-control" required>
                                            </td>
                                            <td>
                                                <input type="text" name="addresses[0][state]" class="form-control" required>
                                            </td>
                                            <td>
                                                <input type="text" name="addresses[0][zip]" class="form-control" required>
                                            </td>
                                            <td>
                                                <input type="text" name="addresses[0][country]" class="form-control" required>
                                            </td>
                                            <td>
                                                <input type="radio" class="is_default" name="addresses[0][is_default]" class="is_default" onclick="updateDefaultAddress(this)" value="1" checked>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-address" disabled>Remove</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-success btn-sm" id="add-address">Add Another Address</button>
                            </div>
                        </div>

                        @push('scripts')
                        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                        <script>
                            $(document).ready(function() {
                                let addressCount = 0;

                                $('#add-address').click(function() {
                                    addressCount++;
                                    let newRow = `
                                                <tr>
                                                    <td>
                                                        <input type="text" name="addresses[${addressCount}][address]" class="form-control" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="addresses[${addressCount}][city]" class="form-control" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="addresses[${addressCount}][state]" class="form-control" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="addresses[${addressCount}][zip]" class="form-control" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="addresses[${addressCount}][country]" class="form-control" required>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="addresses[${addressCount}][is_default]" class="is_default" value="1" onclick="updateDefaultAddress(this)">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm remove-address">Remove</button>
                                                    </td>
                                                </tr>
                                            `;
                                    $('#address-table tbody').append(newRow);

                                    // Enable remove buttons when there's more than one address
                                    if ($('#address-table tbody tr').length > 1) {
                                        $('.remove-address').prop('disabled', false);
                                    }
                                });

                                // Event delegation for remove button
                                $('#address-table').on('click', '.remove-address', function() {
                                    $(this).closest('tr').remove();

                                    // Disable remove button if only one address remains
                                    if ($('#address-table tbody tr').length === 1) {
                                        $('.remove-address').prop('disabled', true);
                                    }
                                });
                            });

                            // Move the function outside to make it globally accessible
                            function updateDefaultAddress(element) {
                                $('.is_default').prop('checked', false).val(0);
                                $(element).prop('checked', true).val(1);
                            }
                        </script>

                        @endpush
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection