<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSV Import and Export page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5 text-center">
        <h2 class="mb-4">
            CSV Import and Export
        </h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                CSV Imported successfully!
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Invalid CSV, please, choose a CSV file from your local storage.

            </div>
        @endif

        <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose local CSV file</label>
                </div>
            </div>
            <button class="btn btn-primary">Import CSV</button>
            <a class="btn btn-success" href="{{ route('file-export') }}">Export CSV</a>
        </form>
    </div>

    <div class="col-md-auto mt-4">
        <table class="table table-striped">

            <thead>
            <tr>
                <th scope="col">Record number</th>
                <th scope="col">Article number</th>
                <th scope="col">Article name</th>
                <th scope="col">Manufacturer</th>
                <th scope="col">Description</th>
                <th scope="col">Article information</th>
                <th scope="col">Gender</th>
                <th scope="col">Product type</th>
                <th scope="col">Sleeves</th>
                <th scope="col">Legs</th>
                <th scope="col">Collar</th>
                <th scope="col">Manufacture</th>
                <th scope="col">Bag type</th>
                <th scope="col">Grammage</th>
                <th scope="col">Material</th>
                <th scope="col">Country of origin</th>
                <th scope="col">Image name</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $product->article_number }}</td>
                    <td>{{ $product->article_name }}</td>
                    <td>{{ $product->manufacturer }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->article_information }}</td>
                    <td>{{ $product->gender }}</td>
                    <td>{{ $product->product_type }}</td>
                    <td>{{ $product->sleeves }}</td>
                    <td>{{ $product->legs }}</td>
                    <td>{{ $product->collar }}</td>
                    <td>{{ $product->manufacture }}</td>
                    <td>{{ $product->bag_type }}</td>
                    <td>{{ $product->grammage }}</td>
                    <td>{{ $product->material }}</td>
                    <td>{{ $product->country_of_origin }}</td>
                    <td>{{ $product->image_name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="ms-1">
            {{ $products->appends(Request::except('page'))->links('pagination::bootstrap-5') }}
        </div>

    </div>

</body>

</html>
