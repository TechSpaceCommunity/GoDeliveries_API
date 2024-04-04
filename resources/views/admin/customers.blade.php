@extends('layouts.admindashboard')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle" style="margin-top: -4%">
            {{-- <h1>customers</h1> --}}
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Customers</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->
        @if (Auth::user()->role == 'admin')
            <section class="section">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header w-50 bg-warning fw-bolder"
                                    style="border-bottom-right-radius: 30px;border-top-right-radius: 30px">
                                    {{ __('Add Customer') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('createcustomer') }}">
                                        @csrf

                                        <div class="row mb-3 d-flex">
                                            <div class="col-6">
                                                <label for="name"
                                                    class="col-md-4 col-form-label fw-bolder">{{ __('Name') }}</label>

                                                <div class="col-md-12">
                                                    <input id="name" type="text"
                                                        class="form-control rounded-pill bg-light @error('name') is-invalid @enderror"
                                                        name="name" value="{{ old('name') }}" required
                                                        autocomplete="name" placeholder="User Name" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label for="email"
                                                    class="col-md-4 col-form-label fw-bolder">{{ __('email') }}</label>

                                                <div class="col-md-12">
                                                    <input id="email" type="email"
                                                        class="form-control rounded-pill bg-light @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email" placeholder="Email" autofocus>

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3 d-flex">

                                            <div class="col-6">
                                                <label for="number"
                                                    class="col-md-4 col-form-label fw-bolder">{{ __('Number') }}</label>

                                                <div class="col-md-12">
                                                    <input id="number" type="number"
                                                        class="form-control rounded-pill bg-light @error('number') is-invalid @enderror"
                                                        name="number" value="{{ old('number') }}" required
                                                        autocomplete="number" placeholder="Phone Number" autofocus>

                                                    @error('number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label for="password"
                                                    class="col-md-4 col-form-label fw-bolder">{{ __('Password') }}</label>

                                                <div class="col-md-12">
                                                    <input id="password" type="password"
                                                        class="form-control rounded-pill bg-light @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="current-password"
                                                        placeholder="Password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row mb-0" align="start">
                                            <div class="col-md-8 offset-md-4 d-block">
                                                <button type="submit"
                                                    class="btn btn-warning fw-bolder text-center w-25 rounded-pill"
                                                    style="box-shadow: 2px 2px 4px black">
                                                    {{ __('SAVE') }}
                                                </button><br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section class="section">
            <div class="container">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="card "
                            style="border-radius: 10p</div>
                    </div>
                    </div>x">
                            <div class="card-header bg-white fw-bolder">
                                {{ __('App Customers') }}
                            </div>
                            <div class="card-body" style="">

                                @if (count($users) >= 1)
                                    <div class="table-responsive container" style="margin-top:10px;"">
                                        <input type="text" id="search" class="form-control mb-3" style="padding: 10px"
                                            placeholder="Search">
                                        <table id="customers" class="table" style="width:100%">
                                            <thead class="fw-bolder">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <th>Joining Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr style="padding-top: 15px">
                                                        <td><a href="#"
                                                                class="text-decoration-none text-black">{{ $user->name }}</a>
                                                        </td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            @if ($user->number == '')
                                                                Null
                                                            @else
                                                                {{ $user->number }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $user->created_at }}</td>
                                                        @if (Auth::user()->role == 'admin')
                                                            <td>
                                                                <form action="{{ route('destroycustomer', $user->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger fw-bolder">Delete</button>
                                                                </form>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div>
                                        <div class="fw-bolder d-flex justify-content-center align-items-center flex-column"
                                            style="min-height: 40vh;">/
                                            <p>No Customer Found</p>
                                            <button
                                                style="border: none; background-color:#eb8334; color:#fff; padding: 12px; width:auto; border-radius:5px">Add
                                                Customer</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Select the search input
            const searchInput = document.getElementById('search');

            // Select the table rows
            const rows = document.querySelectorAll('#customers tbody tr');

            // Add event listener for the search input
            searchInput.addEventListener('keyup', function(event) {
                const searchText = event.target.value.toLowerCase();

                // Iterate through all the table rows
                rows.forEach(row => {
                    // Get the text content of each row
                    const textContent = row.textContent.toLowerCase();

                    // Check if the text content includes the search text
                    if (textContent.includes(searchText)) {
                        // If it includes, display the row
                        row.style.display = 'table-row';
                    } else {
                        // If not, hide the row
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
