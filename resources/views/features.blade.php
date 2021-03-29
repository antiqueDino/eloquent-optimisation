@extends('layout', ['title'=>'Features'])

@section('content')

<main class="max-w-6xl mx-auto sm:px-6 lg:px-8 py-">
    
    <div class=" row gap-8">


        <div class="bg-orange-400 shadow rounded-lg flex items-center justify-between col-sm px-8 py-5">
            <h2>
                <span class="badge badge-primary">Completed, {{ $statuses->completed }}</span>
            </h2>

        </div>

        <div class="bg-blue-400 shadow rounded-lg flex items-center justify-between col-sm px-8 py-5">
            <h2>
                <span class="badge badge-warning">Planned, {{ $statuses->planned }}</span>
            </h2>
            
        </div>

        <div class="bg-red-400 shadow rounded-lg flex items-center justify-between col-sm px-8 py-5">
            <div class="flex items-center">
                <h2>
                    <span class="badge badge-danger">Requested, {{ $statuses->requested }}</span>
                </h2>
            </div>
        </div>


        <div class="flex flex-col">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow hidden sm:rounded-lg">
                    <table class="table my-4">
                        <tr>
                            <th>Feature</th>
                            <th>Status</th>
                            <th>Commets</th>
                        </tr>
                        @foreach ($features as $feature)
                            <tr>
                                <td>{{ $feature->title }}</td>
                                <td>{{ $feature->status }}</td>
                                <td>{{ $feature->comments_count }} comments</td>
                            </tr>
                        @endforeach
                    </table>
                    
                    {{ $features->appends(request()->all())->links() }}
                    
                    
                </div>
            </div>
        </div>
    </div>


</main>

@endsection